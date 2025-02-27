<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "luisvilla";
$password = "lkqaz923";
$dbname = "encuentroca";
$port = 3306;

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


// Límites de inscripción
$limite_huella = 50;
$limite_ia = 30;

// Contar registros de cada curso
$sql_count = "SELECT curso FROM registro_cursos";
$result = $conn->query($sql_count);

$contadorHuella = 50;
$contadorIA = 30;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cursos = explode(',', $row['curso']); // Convertir el string en arreglo
        if (in_array("Huella", $cursos)) {
            $contadorHuella++;
        }
        if (in_array("IA", $cursos)) {
            $contadorIA++;
        }
    }
}

// Verificar si los datos han sido enviados por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $nombre = $_POST['nombre'];
    $institucion = $_POST['institucion'];
    $correo = $_POST['correo'];
    $ca_clave = $_POST['ca_clave'];
    $ca_nombre = $_POST['ca_nombre'];
    $cursos = isset($_POST['cursos']) ? $_POST['cursos'] : [];
    $pertenece_cuerpo = $_POST['pertenece_cuerpo'];
    $grado_consolidacion = $_POST['grado_consolidacion'];

    // Validar si los cursos están disponibles
    if (in_array("Huella", $cursos) && $contadorHuella >= $limite_huella) {
        header("Location: excedio-limite-registros.html");
        // die("Lo sentimos, el curso 'Monitoreo y calidad del agua' ha alcanzado su límite de inscripciones.");
    }
    if (in_array("IA", $cursos) && $contadorIA >= $limite_ia) {
        header("Location: excedio-limite-registros.html");
        // die("Lo sentimos, el curso 'Uso ético de la IA en la educación' ha alcanzado su límite de inscripciones.");
    }

    // Convertir el array de cursos en string para almacenar en la BD
    $cursos_string = implode(",", $cursos);

    // Insertar los datos en la base de datos usando consulta preparada
    $sql = $conn->prepare("INSERT INTO registro_cursos (nombre, institucion, correo, ca_nombre, ca_clave, curso, grado_consolidacion, pertenece_cuerpo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $sql->bind_param("ssssssss", $nombre, $institucion, $correo, $ca_nombre, $ca_clave, $cursos_string, $grado_consolidacion, $pertenece_cuerpo);

    if ($sql->execute()) {
        header("Location: gracias_por_registrarte.html");
        exit();
    } else {
        echo "Error en el registro: " . $conn->error;
    }
}

// Cerrar la conexión
$conn->close();
?>