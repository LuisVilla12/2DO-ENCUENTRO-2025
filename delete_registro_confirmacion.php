<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "luisvilla";  // Cambiar si es necesario
$password = "lkqaz923";
$dbname = "encuentroca";
$port = 3306;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si se recibe el ID
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);  // Convertir a número entero para seguridad

    // Consulta para eliminar
    $sql = "DELETE FROM  registro_confirmacion WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: consulta_registro_confirmacion.php");
    } else {
        echo "Error al eliminar: " . $conn->error;
    }
} else {
    echo "ID no especificado.";
}

$conn->close();
?>
