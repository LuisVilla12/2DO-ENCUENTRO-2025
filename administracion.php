<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración</title>
    <link rel="stylesheet" href="{{ asset('build/assets/app-B6Ri00gb.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            width: 100%;
            max-width: 500px;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: #800020;
            padding: 20px;
            color: white;
            text-align: left;
        }

        .header h1 {
            margin: 0;
            font-size: 20px;
        }

        .option {
            border-bottom: 1px solid #ddd;
            padding: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
        }

        .option:hover {
            background: #f1f1f1;
        }

        .icon {
            margin-right: 15px;
            font-size: 18px;
            color: #800020;
        }

        .content {
            display: none;
            padding: 10px;
            font-size: 14px;
            color: #444;
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
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>ADMINISTRACIÓN</h1>
            <p>Seleccione una opción para gestionar</p>
        </div>
        <!-- UNO -->
        <div class="option" onclick="toggleSection('asistencias')">
            <div><i class="fa-regular fa-calendar icon"></i> Gestión de asistencias</div>
        </div>
        <div id="section-asistencias" class="content">
            <p>Administre las asistencias al evento.</p>
            <a href="consulta_registro_asistencia.php" class="btn">Acceder</a>
        </div>
        <!-- DOS -->
        <div class="option" onclick="toggleSection('academias')">
            <div><i class="fa-solid fa-user-group icon"></i> Gestión de academias</div>
        </div>
        <div id="section-academias" class="content">
            <p>Gestione las academias registradas.</p>
            <a href="consulta_registro_academias.php" class="btn">Acceder</a>
        </div>
        <!-- TRES -->
        <div class="option" onclick="toggleSection('cursos')">
            <div><i class="fa-solid fa-book icon"></i> Gestión de cursos</div>
        </div>
        <div id="section-cursos" class="content">
            <p>Gestione las personas registradas al curso.</p>
            <a href="consulta_registro_cursos.php" class="btn">Acceder</a>
        </div>
        <!-- Cuatro -->
        <div class="option" onclick="toggleSection('archivos')">
            <div><i class="fa-solid fa-file icon"></i> Gestión de archivos</div>
        </div>
        <div id="section-archivos" class="content">
            <p>Gestione los archivos a someter.</p>
            <a href="consulta_registro_archivos.php" class="btn">Acceder</a>
        </div>
    </div>

    <script>
        function toggleSection(id) {
            var section = document.getElementById('section-' + id);
            if (section.style.display === 'block') {
                section.style.display = 'none';
            } else {
                section.style.display = 'block';
            }
        }
    </script>
</body>

</html>

