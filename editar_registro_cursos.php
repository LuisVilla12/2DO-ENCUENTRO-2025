<?php
// Configuración de base de datos
$servername = "localhost";
$username = "luisvilla";  // Cambiar si es necesario
$password = "lkqaz923";
$dbname = "encuentroca";
$port = 3306;

$conn = new mysqli($servername, $username, $password, $dbname,$port);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el ID del archivo a editar
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM registro_cursos WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        die("Registro no encontrado.");
    }
} else {
    die("ID no especificado.");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2o. Encuentro de CA's</title>
    <style>
        body {
            background-color: #f3f4f6;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 40px 30px;
        }

        
        h1 {
            font-size: 1.5rem;
            text-align: center;
            margin-bottom: 10px;
            color: #333333;
        }

        p {
            text-align: center;
            margin-bottom: 20px;
            font-size: 0.9rem;
            color: #555555;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label, option {
            line-height: 1.5;
            font-size: 0.9rem;
            font-weight: bold;
            color: #333333;
        }

        input[type="text"],
        input[type="email"],
        input[type="file"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #cccccc;
            border-radius: 4px;
            font-size: 0.9rem;
        }

        input[type="radio"] {
            margin-right: 8px;
        }

        .radio-group {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        button {
            padding: 10px;
            background-color: rgb(5,26,57);
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9rem;
            margin-top: 1rem;
        }

        button:hover {
            background-color: #333333;
        }
        .mt-2{
            margin-top: .5rem;
        }
        .mt-4{
            margin-top: 1rem;
        }
        .mt-inline{
            display: inline-block;
            margin-top: 1rem;
        }
        .block{
            display: block;
        }
        .note {
            font-size: 0.8rem;
            color: #555555;
            text-align: center;
        }
        img{
            margin-top: 1rem;
            margin-bottom: 1rem;
            width: 100%;
            object-fit: cover;
            height: 80px;
        }
        .semi-bold{
            font-weight: 400;
        }
        .flex{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .btn {
            display: inline-block;
            padding: 10px 30px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
            text-align: center;
        }
        .color{
            background: #800020;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="Encabezado_Nuevo.jpg" class="" alt="encabezado">
        <h1>Editar registro - 2o. Encuentro de CA's</h1>
        <form action="update__registro_cursos.php" id="myForm" method="POST" enctype="multipart/form-data">
            <div>
                <label>Nombre completo*</label>
                <input type="text" name="nombre" id="nombre" required placeholder="Nombre completo"  value="<?= htmlspecialchars($row['nombre']) ?>">
            </div>

            <div>
                <label>Institución de procedencia *</label>
                <input type="text" name="institucion" id="institucion" required placeholder="Nombre de la institución"  value="<?= htmlspecialchars($row['institucion']) ?>">
            </div>

            <div>
                <label>Correo electrónico institucional *</label>
                <input type="email" name="correo" id="correo" required placeholder="Correo electrónico institucional"  value="<?= htmlspecialchars($row['correo']) ?>">
            </div>
            <div>
                <label>Pertenece a un Cuerpo Académico*</label>
                <div class="radio-group" >
                    <label><input type="radio" name="pertenece_cuerpo" id="si" value="1" <?= ($row['pertenece_cuerpo'] == '1') ? 'checked' : '' ?>>Si</label>
                    <label><input type="radio" name="pertenece_cuerpo" id="no" value="0" <?= ($row['pertenece_cuerpo'] == '0') ? 'checked' : '' ?> >No</label>
                </div>
            </div>
            <!-- SI pertenece -->
            <div id="campos_cuerpo_academico">
                <div>
                    <label class="mt-2">Nombre del cuerpo académico*</label>
                    <input class="mt-2" type="text" name="ca_nombre" id="ca_nombre"  placeholder="Nombre del cuerpo académico"  value="<?= htmlspecialchars($row['ca_nombre']) ?>">
                </div>
                <div class="mt-2">
                    <label class="mt-2">Clave del cuerpo académico *</label>
                    <input class="mt-2" type="text" name="ca_clave" id="ca_clave"  placeholder="Clave del cuerpo académico"  value="<?= htmlspecialchars($row['ca_clave']) ?>">
                </div>
                <div class="mt-2">
                    <label class="">Grado de consolidación:*</label>
                    <div class="radio-group mt-2">
                        <label><input type="radio" name="grado_consolidacion" id="consolidado"  value="Consolidado" <?= ($row['grado_consolidacion'] == 'Consolidado') ? 'checked' : '' ?> >Consolidado</label>
                        <label><input type="radio" name="grado_consolidacion" id="En_consolidación" value="En consolidación"<?= ($row['grado_consolidacion'] == 'En consolidación') ? 'checked' : '' ?> >En consolidación</label>
                        <label><input type="radio" name="grado_consolidacion" id="En_formación" value="En formación" <?= ($row['grado_consolidacion'] == 'En formación') ? 'checked' : '' ?>>En formación</label>
                    </div>
                </div>
            </div>
            <div>
                <label class="mt-4">Curso al que se inscribo*</label>
                <input type="text" name="cursos" id="cursos" value="<?= htmlspecialchars($row['curso']) ?>">
            </div>
            <!-- Contenedor donde se mostrarán los enlaces -->
            <section id="linkContainer"></section>
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="flex">
                <button type="submit" class="btn">Regresar</button>
                <a href="consulta_registro_cursos.php" class="btn color">Actualizar</a>
            </div>
        </form>
    </div>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const perteneceSi = document.getElementById("si");
    const perteneceNo = document.getElementById("no");
    const camposCuerpoAcademico = document.getElementById("campos_cuerpo_academico");

    function toggleCampos() {
        if (perteneceSi.checked) {
            camposCuerpoAcademico.style.display = "block";
        } else {
            camposCuerpoAcademico.style.display = "none";
        }
    }

    perteneceSi.addEventListener("change", toggleCampos);
    perteneceNo.addEventListener("change", toggleCampos);

    // Ejecutar una vez al inicio para ajustar el estado inicial
    toggleCampos();

    const checkboxes = document.querySelectorAll("input[name='cursos[]']");
    const linkContainer = document.createElement("div");
    linkContainer.id = "linkContainer";
    
    // Insertar el contenedor de enlaces después de los checkboxes pero antes del botón
    const checkboxContainer = document.querySelector("label[for='']").parentNode;
    checkboxContainer.appendChild(linkContainer);

    function updateLinks() {
        linkContainer.innerHTML = "";
        
        if (document.querySelector("input[value='Huella']").checked) {
            const link1 = document.createElement("a");
            link1.href = "https://teams.microsoft.com/l/team/19%3A17iLljeoaCEOb8guxeXGCmKY5UUGoVw2RNIEkRFJw881%40thread.tacv2/conversations?groupId=c29acf85-2ba4-4bd3-bc50-c22ee26c4c6a&tenantId=7aab5429-e8cd-4d83-b304-328b36175600";
            link1.textContent = "Unirse al equipo de teams: Monitoreo y calidad del agua";
            link1.target = "_blank";
            link1.classList.add('mt-inline');
            linkContainer.appendChild(link1);
            linkContainer.appendChild(document.createElement("br"));
        }
        
        if (document.querySelector("input[value='IA']").checked) {
            const link2 = document.createElement("a");
            link2.href = "https://teams.microsoft.com/l/team/19%3ArCrH_F6xV0rMcyIE46DtlPYgICwuOMfQjo1-kSuA2ig1%40thread.tacv2/conversations?groupId=ec54da4e-4574-477c-ba6f-976ec7b6cbdf&tenantId=7aab5429-e8cd-4d83-b304-328b36175600";
            link2.textContent = "Unirse al equipo de teams: Uso ético de la IA en la educación";
            link2.target = "_blank";
            link2.classList.add('mt-inline');
            linkContainer.appendChild(link2);
            linkContainer.appendChild(document.createElement("br"));
        }
    }

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener("change", updateLinks);
    });

    updateLinks();

});
</script>
</html>

<?php
$conn->close();
?>
