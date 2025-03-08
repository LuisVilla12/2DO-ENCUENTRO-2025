<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";  // O la IP del servidor si no es localhost
$username = "luisvilla";     // Nombre de usuario de la base de datos
$password = "lkqaz923";   // Contraseña de la base de datos
$dbname = "encuentroca";   // Nombre de la base de datos
$port = 3306;  // Puerto personalizado (en tu caso, es el 330)

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname, $port);
// Consulta para obtener los datos
$sql = "SELECT * FROM registro_asistencias";
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
        <h2>Lista de asistencia al evento</h2>
        <a href="administracion.php" class="btn">Menu principal</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>N°</th>
                <th>Nombres(s)</th>
                <th>Asistencia</th>
                <th>Institucion</th>
                <th>Nombre CA</th>
                <th>Clave CA</th>
                <th>Grado CA</th>
                <th>Mesa tematica</th>
                <th>Modalidad</th>
                <th>Modo de información</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                $id=0;
                while ($row = $result->fetch_assoc()) {
                    if($row["confirmar_asistencia"]==1){
                        $asistencia='Si';
                    }else{
                        $asistencia='No';
                    }
                    $id=$id+1;
                    switch($row["mesa"]){
                        case '1':
                            $tematica='Tecnología y Manejo Integral de los recursos hídricos';
                            break;
                        case '2':
                            $tematica='Medio Ambiente, Biotecnología y Sustentabilidad';
                            break;
                        case '3':
                            $tematica='Sistema de Gestión Económico Administrativo y Sociedad';
                            break;
                        case '4':
                            $tematica='Tecnología de la información y comunicación.';
                            break;
                        case '5':
                            $tematica='Nutrición y bienestar';
                            break;
                    }
                    switch($row["modo_informacion"]){
                        case '1':
                            $modo_informacion='Sitio Web';
                            break;
                        case '2':
                            $modo_informacion='Conocido';
                            break;
                        case '3':
                            $modo_informacion='Invitación';
                            break;
                        case '4':
                            $modo_informacion='Redes sociales';
                            break;
                    }
                    echo "<tr>
                        <td>" . $id. "</td>
                        <td>" . $row["autores"] . "</td>
                        <td>" . $asistencia . "</td>
                        <td>" . $row["institucion"] . "</td>
                        <td>" . $row["ca_nombre"] . "</td>
                        <td>" . $row["ca_clave"] . "</td>
                        <td>" . $row["grado_consolidacion"] . "</td>
                        <td>" . $tematica . "</td>
                        <td>" . $row["modalidad"] . "</td>
                        <td>" . $modo_informacion. "</td>
                        <td> <a href='editar_registro_asistencias.php?id=" . $row["id"] . "'>Editar</a>
                        <a href='delete_registro_asistencia.php?id=" . $row['id'] . "' 
               onclick='return confirm(\"¿Estás seguro de que deseas eliminar este registro?\");'
               style='color: red; text-decoration: none;'>
                    Eliminar
            </a>
                        
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
