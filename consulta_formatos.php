<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar PDFs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .pdf-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .pdf-card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 10px;
            width: 250px;
            text-align: center;
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
        }
        .pdf-card a {
            text-decoration: none;
            color: #007BFF;
        }
        .pdf-card a:hover {
            text-decoration: underline;
        }
        .pdf-card p {
            margin: 10px 0 0;
            font-size: 14px;
            color: #555;
        }
    </style>
</head>
<body>
    <h1>Lista de academias registradas</h1>
    <div class="pdf-list">
        <?php
        // Configuración de la conexión a la base de datos
        $servername = "localhost";  // O la IP del servidor si no es localhost
        $username = "luisvilla";     // Nombre de usuario de la base de datos
        $password = "lkqaz923";   // Contraseña de la base de datos
        $dbname = "encuentroca";   // Nombre de la base de datos
        $port = 3307;  // Puerto personalizado (en tu caso, es el 330)
        
        // Crear conexión
        $conn = new mysqli($servername, $username, $password, $dbname, $port);
        

        // Verificar conexión
        if ($conn->connect_error) {
            die("<p>Error al conectar a la base de datos: " . $conn->connect_error . "</p>");
        }

        // Consulta para obtener los datos
        $query = "SELECT autores, namepdf FROM registro_pdf";
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            // Mostrar los resultados
            while ($row = $result->fetch_assoc()) {
                $archivo = htmlspecialchars($row['namepdf']);
                $usuario = htmlspecialchars($row['autores']);
                echo "<div class='pdf-card'>";
                echo "<a href='uploads/$archivo' target='_blank'>$archivo</a>";
                echo "<p>Guardado por: $usuario</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No hay archivos PDF registrados en la base de datos.</p>";
        }

        // Cerrar conexión
        $conn->close();
        ?>
    </div>
</body>
</html>
