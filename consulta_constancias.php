<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";  // O la IP del servidor si no es localhost
$username = "root";     // Nombre de usuario de la base de datos
$password = "lkqaz923";   // Contraseña de la base de datos
$dbname = "encuentroca";   // Nombre de la base de datos
$port = 3307;  // Puerto personalizado (en tu caso, es el 330)

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname, $port);
// Consulta para obtener los datos
$sql = "SELECT * FROM registro_constancias";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descarga de Constancias</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            padding: 20px;
        }

        .container {
            max-width: 90%;
            margin: auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .header {
            background-color: #800020;
            color: white;
            padding: 20px;
            border-radius: 10px 10px 0 0;
            text-align: left;
        }

        .header h2 {
            font-size: 20px;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 14px;
            opacity: 0.8;
        }


        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background: white;
            border-radius: 5px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f1f1f1;
            font-size: 14px;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .btn-descargar {
            color: #008000;
            font-weight: bold;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .btn-descargar img {
            width: 16px;
            height: 16px;
            margin-right: 5px;
        }

        .footer {
            margin-top: 10px;
            font-size: 14px;
            color: #666;
        }

        .search-container {
    position: relative;
    width: 100%;
    margin-top: 1rem;
}

.search-container i {
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: #888;
}

.search-container input {
    width: 100%;
    padding: 10px 10px 10px 35px; /* Espacio para el ícono */
    border: 1px solid #ccc;
    border-radius: 5px;
}
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Descarga tu constancia del evento</h2>
        <p>Busca y descarga tu certificado de participación</p>
    </div>

    <!-- Barra de búsqueda -->
    <div class="search-container">
    <i class="fa fa-search"></i>
    <input type="text" id="searchInput" placeholder="Buscar por Clave CA o Institución..." onkeyup="filterTable()">
</div>
    <!-- Tabla de registros -->
    <table id="dataTable">
        <thead>
            <tr>
                <th>N°</th>
                <th>Nombre completo</th>
                <th>Modalidad</th>
                <th>Descargar ahora</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            $id = 0;
            while ($row = $result->fetch_assoc()) {
                $id++;
                $archivo = $row["path_constancia"];
                echo "<tr>
                    <td>" . $id . "</td>
                    <td>" . $row["name_constancia"] . "</td>
                    <td>" . $row["tipo_constancia"] . "</td>
                    <td> 
                        <a href='constancias/$archivo' target='_blank' class='btn-descargar'>
                            <img src='download-icon.png' alt='Descargar'> Descargar
                        </a> 
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No hay registros disponibles.</td></tr>";
        }
        ?>
        </tbody>
    </table>

    <!-- Pie de página -->
    <div class="footer">
        Mostrando <?php echo $result->num_rows; ?> certificados
    </div>
</div>

<!-- JavaScript para filtrar la tabla -->
<script>
function filterTable() {
    var input, filter, table, tr, td, i, j, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toLowerCase();
    table = document.getElementById("dataTable");
    tr = table.getElementsByTagName("tr");

    for (i = 1; i < tr.length; i++) { // Empieza desde 1 para evitar el encabezado
        tr[i].style.display = "none"; // Oculta todas las filas por defecto
        td = tr[i].getElementsByTagName("td");
        
        for (j = 1; j < 4; j++) { // Buscar en Nombre, Institución y Nombre CA
            if (td[j]) {
                txtValue = td[j].textContent || td[j].innerText;
                if (txtValue.toLowerCase().indexOf(filter) > -1) {
                    tr[i].style.display = ""; // Muestra la fila si coincide con la búsqueda
                    break;
                }
            }
        }
    }
}
</script>

</body>
</html>
