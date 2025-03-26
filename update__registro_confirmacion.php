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
    $name = $_POST['name'];
    $lastname_p = $_POST['lastname_p'];
    $lastname_m = $_POST['lastname_m'];
    $institucion = $_POST['institucion'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['email'];
    $ca_clave = $_POST['ca_clave'];
    $ca_nombre = $_POST['ca_nombre'];
       // Actualizar los datos en la base de datos
    $sql = "UPDATE registro_confirmacion SET 
    name_= '$name',
    lastname_p= '$lastname_p',
    lastname_m= '$lastname_m',
    telefono= '$telefono',
    email= '$email',
    institucion='$institucion',
    email='$correo',
    ca_clave='$ca_clave',
    ca_nombre='$ca_nombre'
    WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    header("Location: consulta_registro_confirmacion.php");
    exit(); 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
// Cerrar la conexión
$conn->close();
?>
