<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";  // O la IP del servidor si no es localhost
$username = "root";     // Nombre de usuario de la base de datos
$password = "lkqaz923";   // Contraseña de la base de datos
$dbname = "encuentroca";   // Nombre de la base de datos
$port = 3307;  // Puerto personalizado (en tu caso, es el 330)

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname, $port);
// Consulta para obtener los datos
$sql = "SELECT * FROM registro_academias";
$result = $conn->query($sql);
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
    </style>
</head>
<body>
    <div class="flex">
        <h2>Lista de academias</h2>
        
        <a href="administracion.php" class="btn">Menu principal</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Autores</th>
                <th>Institucion</th>
                <th>Nombre CA</th>
                <th>Clave CA</th>
                <th>Modalidad</th>
                <th>Consolidación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                $id=0;
                while ($row = $result->fetch_assoc()) {
                    $id=$id+1;  
                    echo "<tr>
                        <td>" . $id . "</td>
                        <td>" . $row["autores"] . "</td>
                        <td>" . $row["institucion"] . "</td>
                        <td>" . $row["ca_nombre"] . "</td>
                        <td>" . $row["ca_clave"] . "</td>
                        <td>" . $row["modalidad"] . "</td>
                        <td>" . $row["grado_consolidacion"] . "</td>
                        <td> <a href='editar_registro_academias.php?id=" . $row["id"] . "'>Editar</a>
                        <a href='delete_registro_academias.php?id=" . $row['id'] . "' 
               onclick='return confirm(\"¿Estás seguro de que deseas eliminar este registro?\");'
               style='color: red; text-decoration: none;'>
                    Eliminar
            </a></td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No hay archivos disponibles.</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>
