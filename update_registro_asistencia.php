<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";  // O la IP del servidor si no es localhost
$username = "luisvilla";     // Nombre de usuario de la base de datos
$password = "lkqaz923";   // Contraseña de la base de datos
$dbname = "encuentroca";   // Nombre de la base de datos
$port = 3306;  // Puerto personalizado (en tu caso, es el 330)

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si los datos han sido enviados por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    // Recoger los datos del formulario
    $confirmar_asistencia = $_POST['confirmar_asistencia'];
    $institucion =  $_POST['institucion'];
    $ca_nombre = $_POST['ca_nombre'];
    $ca_clave = $_POST['ca_clave'];
    $autores = $_POST['autores'];
    $grado_consolidacion = $_POST['grado_consolidacion'];
    $mesa = $_POST['mesa'];
    $modalidad = $_POST['modalidad'];
    $modo_informacion = $_POST['modo_informacion'];

    // Actualizar los datos en la base de datos
    $sql = "UPDATE registro_asistencias SET 
    confirmar_asistencia= '$confirmar_asistencia',
    institucion='$institucion',
    ca_nombre='$ca_nombre',
    ca_clave='$ca_clave',
    autores='$autores',
    grado_consolidacion='$grado_consolidacion',
    mesa='$mesa',
    modalidad='$modalidad',
    modo_informacion='$modo_informacion'
    WHERE id= $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: consulta_registro_asistencia.php");
        exit(); 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Cerrar la conexión
$conn->close();
?>
