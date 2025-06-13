<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobante del Profesor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
        }
        .details {
            margin-bottom: 20px;
        }
        .details p {
            margin: 5px 0;
        }
        .groups {
            margin-top: 20px;
        }
        .group {
            margin-bottom: 20px;
        }
        .group h2 {
            margin: 0 0 10px 0;
        }
        .rubros {
            margin-top: 10px;
        }
        .rubros h3 {
            margin: 0 0 5px 0;
        }
        .rubros ul {
            list-style-type: none;
            padding: 0;
        }
        .rubros li {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Comprobante del Profesor</h1>
            <p>Fecha: {{ $fecha }}</p>
        </div>
        <div class="details">
            <p><strong>Nombre:</strong> {{ $nombre }}</p>
            <p><strong>Email:</strong> {{ $email }}</p>
        </div>
        <div class="groups">
            @foreach ($grupos as $grupo)
                <div class="group">
                    <h2>Grupo: {{ $grupo->nombre }} (Sección: {{ $grupo->seccion }})</h2>
                    <p><strong>Promedio General:</strong> {{ $grupo->promedio_general ?? '-' }}</p>
                    <div class="rubros">
                        <h3>Promedios por Rubro:</h3>
                        <ul>
                            @foreach ($grupo->rubros as $rubro)
                                <li>
                                    <strong>{{ $rubro->titulo }}:</strong> {{ $rubro->promedio ?? '-' }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
    </div>
</body>
</html>
