<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";  // O la IP del servidor si no es localhost
$username = "root";     // Nombre de usuario de la base de datos
$password = "lkqaz923";   // Contraseña de la base de datos
$dbname = "encuentroca";   // Nombre de la base de datos
$port = 3307;  // Puerto personalizado (en tu caso, es el 330)

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si los datos han sido enviados por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $autores = $_POST['autores'];
    $institucion =  $_POST['institucion'];
    $ca_nombre = $_POST['ca_nombre'];
    $ca_clave = $_POST['ca_clave'];
    $modalidad = $_POST['modalidad'];
    $grado_consolidacion = $_POST['grado_consolidacion'];
    // $asistencia = $_POST['asistencia'];

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO registro_academias (autores, institucion, ca_nombre,ca_clave,modalidad,grado_consolidacion) VALUES ('$autores', '$institucion', '$ca_nombre','$ca_clave','$modalidad','$grado_consolidacion')";

    if ($conn->query($sql) === TRUE) {
        header("Location: gracias_por_registrarte.html");
        exit(); 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Cerrar la conexión
$conn->close();
?>
