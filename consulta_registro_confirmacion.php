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
$sql = "SELECT * FROM registro_confirmacion";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asistencia</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #800020; color: white; }
        a { text-decoration: none; color: #007bff; }
        a:hover { text-decoration: underline; }
        .bg-verde{
            background-color: #d4edda;
        }
        .bg-gris{
            background-color: #f1f1f1;
        }
        .btn {
            display: inline-block;
            padding: 10px;
            background: #800020;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
            text-align: center;
        }
        .flex{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="flex">
        <h2>Lista de asistencia al evento</h2>
        
        <a href="administracion.php" target="_blank" class="btn">Menu principal</a>
    </div>
<!-- Barra de búsqueda -->
 <div class="flex">
     <input type="text" id="searchInput" placeholder="Buscar..." onkeyup="filterTable()">
 </div>
<br><br>

<table id="dataTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre completo</th>
            <th>Correo</th>
            <th>Teléfono</th>
            <th>Institución</th>
            <th>Nombre CA</th>
            <th>Clave CA</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            $id = 0;
            while ($row = $result->fetch_assoc()) {
                $id++;
                echo "<tr class='" . ($row['confirmar_datos'] ? 'bg-verde' : 'bg-gris') . "'>
                <td>" . $id . "</td>
                <td>" . $row["name_"] . " " . $row["lastname_p"] . " " . $row["lastname_m"] . "</td>
                <td>" . $row["email"] . "</td>
                <td>" . $row["telefono"] . "</td>
                <td>" . $row["institucion"] . "</td>
                <td>" . $row["ca_nombre"] . "</td>
                <td>" . $row["ca_clave"] . "</td>
                <td>
                    <a href='editar_registro_confirmacion.php?id=" . $row["id"] . "'>Editar</a>
                    <a href='delete_registro_confirmacion.php?id=" . $row['id'] . "' 
                       onclick='return confirm(\"¿Estás seguro de que deseas eliminar este registro?\");'
                       style='color: red; text-decoration: none;'>
                        Eliminar
                    </a>
                </td>
            </tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No hay registros disponibles.</td></tr>";
        }
        ?>
    </tbody>
</table>

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
        
        for (j = 0; j < td.length; j++) { // Recorre todas las columnas
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

<!-- CSS opcional para mejorar el diseño -->
<style>
#searchInput {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}
</style>
