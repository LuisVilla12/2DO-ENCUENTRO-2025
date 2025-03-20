<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";  
$username = "root";
$password = "lkqaz923";
$dbname = "encuentroca";
$port = 3307;

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Verificar si se seleccionó una modalidad
$modalidad_filtro = isset($_GET['modalidad']) ? $_GET['modalidad'] : '';

// Construir la consulta con filtro si se seleccionó una modalidad
$sql = "SELECT * FROM registro_pdf";
if (!empty($modalidad_filtro)) {
    $sql .= " WHERE modalidad = '" . $conn->real_escape_string($modalidad_filtro) . "'";
}
$result = $conn->query($sql);

// Obtener todas las modalidades para el filtro
$modalidades_sql = "SELECT DISTINCT modalidad FROM registro_pdf";
$modalidades_result = $conn->query($modalidades_sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de personal</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #800020; color: white; }
        a { text-decoration: none; color: #007bff; }
        a:hover { text-decoration: underline; }
        .btn {
            display: inline-block;
            padding: 10px;
            background: #800020;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
            text-align: center;
        }
        .flex{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .filter {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="flex">
        <h2>Lista de archivos a someter</h2>
            <a href="administracion.php" class="btn">Menu principal</a>
    </div>
    <div class="flex">
    <form method="GET" class="filter">
        <label for="modalidad">Filtrar por modalidad:</label>
        <select name="modalidad" id="modalidad" onchange="this.form.submit()">
            <option value="">-- Todas --</option>
            <?php while ($modalidad = $modalidades_result->fetch_assoc()): ?>
                <option value="<?php echo $modalidad['modalidad']; ?>" <?php echo ($modalidad_filtro == $modalidad['modalidad']) ? 'selected' : ''; ?>>
                    <?php echo $modalidad['modalidad']; ?>
                </option>
            <?php endwhile; ?>
        </select>
    </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>N°</th>
                <th>Autores</th>
                <th>Institucion</th>
                <th>Modalidad</th>
                <th>Documentos</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                $id=0;
                while ($row = $result->fetch_assoc()) {
                    $id=$id+1;
                    $archivo=$row["namepdf"];
                    echo "<tr>
                        <td>" . $id. "</td>
                        <td>" . $row["autores"] . "</td>
                        <td>" . $row["institucion"] . "</td>
                        <td>" . $row["modalidad"] . "</td>
                        <td> <a href='uploads/$archivo' target='_blank'>Descargar</a> </td>
                        <td> <a href='editar_registro_pdf.php?id=" . $row["id"] . "'>Editar</a>
                        <a href='delete_registro_pdf.php?id=" . $row['id'] . "' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este registro?\");' style='color: red; text-decoration: none;'> Eliminar </a>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No hay archivos disponibles.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

