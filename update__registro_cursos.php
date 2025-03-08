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
    $nombre = $_POST['nombre'];
    $institucion = $_POST['institucion'];
    $correo = $_POST['correo'];
    $ca_clave = $_POST['ca_clave'];
    $ca_nombre = $_POST['ca_nombre'];
    $cursos = $_POST['cursos'] ;
    $pertenece_cuerpo = $_POST['pertenece_cuerpo'];
    $grado_consolidacion = $_POST['grado_consolidacion'];
       // Actualizar los datos en la base de datos
    $sql = "UPDATE registro_cursos SET 
    nombre= '$nombre',
    institucion='$institucion',
    correo='$correo',
    ca_clave='$ca_clave',
    ca_nombre='$ca_nombre',
    pertenece_cuerpo='$pertenece_cuerpo',
    curso='$cursos',
    grado_consolidacion='$grado_consolidacion'
    WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    header("Location: consulta_registro_cursos.php");
    exit(); 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
// Cerrar la conexión
$conn->close();
?>
