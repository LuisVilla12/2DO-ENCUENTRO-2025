<?php
// Configuración de base de datos
$servername = "localhost";
$username = "luisvilla";  // Cambiar si es necesario
$password = "lkqaz923";
$dbname = "encuentroca";
$port = 3306;

$conn = new mysqli($servername, $username, $password, $dbname,$port);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el ID del archivo a editar
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM registro_academias WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        die("Registro no encontrado.");
    }
} else {
    die("ID no especificado.");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2o. Encuentro de CA's</title>
    <style>
        body {
            background-color: #f3f4f6;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 40px 30px;
        }
        h1 {
            font-size: 1.5rem;
            text-align: center;
            margin-bottom: 10px;
            color: #333333;
        }
        p {
            text-align: center;
            margin-bottom: 20px;
            font-size: 0.9rem;
            color: #555555;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        label, option {
            line-height: 1.5;
            font-size: 0.9rem;
            font-weight: bold;
            color: #333333;
        }
        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #cccccc;
            border-radius: 4px;
            font-size: 0.9rem;
        }
        input[type="radio"] {
            margin-right: 8px;
        }
        .radio-group {
            display: flex;
            gap: 15px;
            align-items: center;
        }
        button {
            padding: 10px;
            background-color: rgb(5,26,57);
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9rem;
            margin-top: 1rem;
        }

        button:hover {
            background-color: #333333;
        }

        .note {
            font-size: 0.8rem;
            color: #555555;
            text-align: center;
        }
        img{
            margin-top: 1rem;
            margin-bottom: 1rem;
            width: 100%;
            object-fit: cover;
            height: 80px;
        }
        .inline-block{
            display: inline-block;
            width: 100%;
        }
        .mt-4{
            margin-top: .5rem;
        }
        .object-fit{
            width: full;
            height: auto;
            object-fit: cover;
        }
        .flex{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .btn {
            display: inline-block;
            padding: 10px 30px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
            text-align: center;
        }
        .color{
            background: #800020;
        }
    </style>
    </head>
<body>
    <div class="container">
        <img src="Encabezado_Nuevo.jpg" class="object-fit" alt="encabezado">
        <h1>Editar registro - 2o. Encuentro de CA's</h1>

        <form action="update_registro_academias.php" id="myForm" method="POST" enctype="multipart/form-data">
            <div>
                <label>Modalidad de participación *</label>
                <div class="radio-group" >
                    <label><input type="radio" name="modalidad" id="cartel" <?= ($row['modalidad'] == 'Cartel') ? 'checked' : '' ?> value="Cartel">Cartel</label>
                    <label><input type="radio" name="modalidad" id="prototipo" <?= ($row['modalidad'] == 'Prototipo') ? 'checked' : '' ?> value="Prototipo">Prototipo</label>
                    <label><input type="radio" name="modalidad" id="capitulo" <?= ($row['modalidad'] == '⁠Capítulo') ? 'checked' : '' ?> value="⁠Capítulo">⁠Capítulo de libro</label>
                </div>
            </div>

            <div>
                <label>Indica los nombres de los autores *</label>
                <input type="text" name="autores" id="autores" required value="<?= htmlspecialchars($row['autores']) ?>">
            </div>

            <div>
                <label>Institución de procedencia *</label>
                <input type="text" name="institucion" id="institucion" required value="<?= htmlspecialchars($row['institucion']) ?>">
            </div>

            <div>
                <label>Nombre del cuerpo académico*</label>
                <input type="text" name="ca_nombre" id="ca_nombre" required value="<?= htmlspecialchars($row['ca_nombre']) ?>">
            </div>
            <div>
                <label>Clave del cuerpo académico *</label>
                <input type="text" name="ca_clave" id="ca_clave" required value="<?= htmlspecialchars($row['ca_clave']) ?>">
            </div>
            <div>
                <label>Grado de consolidación:*</label>
                <div class="radio-group">
                <label><input type="radio" name="grado_consolidacion" id="consolidado"  value="Consolidado" <?= ($row['grado_consolidacion'] == 'Consolidado') ? 'checked' : '' ?> >Consolidado</label>
                        <label><input type="radio" name="grado_consolidacion" id="En_consolidación" value="En consolidación"<?= ($row['grado_consolidacion'] == 'En consolidación') ? 'checked' : '' ?> >En consolidación</label>
                        <label><input type="radio" name="grado_consolidacion" id="En_formación" value="En formación" <?= ($row['grado_consolidacion'] == 'En formación') ? 'checked' : '' ?>>En formación</label>
                </div>
            </div>
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="flex">
                <button type="submit" class="btn">Regresar</button>
                <a href="consulta_registro_academias.php" class="btn color">Actualizar</a>
            </div>
        </form>

    </div>
</body>

</html>

<?php
$conn->close();
?>
