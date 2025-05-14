<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nuevo mensaje de contacto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .content {
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #6c757d;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Nuevo mensaje de contacto</h2>
    </div>
    
    <div class="content">
        <p><strong>De:</strong> {{ $email }}</p>
        <p><strong>Mensaje:</strong></p>
        <p>{{ $mensaje }}</p>
    </div>

    <div class="footer">
        <p>Este es un mensaje automático del sistema CAD. Por favor, no responda a este correo.</p>
    </div>
</body>
</html> 