<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";  // O la IP del servidor si no es localhost
$username = "luisvilla";     // Nombre de usuario de la base de datos
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
    $modalidad = $_POST['modalidad'];
    
    // Directorio de almacenamiento
    $upload_dir = "uploads/";

// Verificar si la carpeta "uploads/" existe, si no, crearla
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true);  // 0777 permite acceso de escritura, lectura y ejecución
}


    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $file_name = basename($_FILES["file"]["name"]);
        $unique_name = uniqid(time() . "_", true) . "." . pathinfo($file_name, PATHINFO_EXTENSION);
        $file_path = $upload_dir . $unique_name;
        $file_type = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));

        // Validar tipo de archivo (PDF o Word)
        $allowed_types = ['pdf', 'docx'];  // Extensiones permitidas
        if (!in_array($file_type, $allowed_types)) {
            echo "Error: Solo se permiten archivos PDF o Word.";
            exit();
        }

        // Validar tamaño del archivo (ejemplo: máximo 5MB)
        $max_size = 5 * 1024 * 1024; // 5MB
        if ($_FILES["file"]["size"] > $max_size) {
            echo "Error: El archivo es demasiado grande. El tamaño máximo permitido es 5MB.";
            exit();
        }

        // Mover el archivo al directorio de destino
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $file_path)) {
            // Usar declaraciones preparadas para evitar inyección SQL
            $stmt = $conn->prepare("INSERT INTO registro_pdf (autores, institucion, modalidad, pahtpdf, namepdf) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $autores, $institucion, $modalidad, $file_path, $unique_name);
            
            if ($stmt->execute()) {
                // Redirigir al usuario a una página de éxito
                header("Location: gracias_por_registrarte.html");
                exit();  // Asegurarse de detener el script después de la redirección
            } else {
                echo "Error al insertar en la base de datos: " . $stmt->error;
            }
            
            // Cerrar la declaración preparada
            $stmt->close();
        } else {
            echo "Error al subir el archivo.";
        }
    } else {
        echo "No se ha seleccionado ningún archivo.";
    }
}

// Cerrar la conexión
$conn->close();
?>
