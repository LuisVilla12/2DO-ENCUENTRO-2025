<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";  
$username = "root";
$password = "lkqaz923";
$dbname = "encuentroca";
$port = 3307;

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Verificar si hay errores en la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener todos los archivos de la base de datos
$sql = "SELECT namepdf FROM registro_pdf";
$result = $conn->query($sql);

// Directorio donde están almacenados los archivos
$uploadDir = "uploads/";

if ($result->num_rows > 0) {
    // Deshabilitar el buffer de salida para evitar problemas con múltiples descargas
    ob_end_clean();

    // Configurar headers para múltiples descargas
    header("Content-Type: application/octet-stream");
    
    while ($row = $result->fetch_assoc()) {
        $filePath = $uploadDir . $row["namepdf"];
        if (file_exists($filePath)) {
            // Configurar encabezados para cada archivo
            header("Content-Disposition: attachment; filename=" . basename($filePath));
            header("Content-Length: " . filesize($filePath));

            // Leer y enviar el archivo al navegador
            readfile($filePath);

            // Pequeña pausa para evitar sobrecarga en el servidor
            flush();
            usleep(500000); // 0.5 segundos
        }
    }
} else {
    echo "No hay archivos para descargar.";
}

$conn->close();
?>

