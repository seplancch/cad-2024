<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mantenimiento Programado</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3498db; /* Azul primario */
            --secondary-color: #2c3e50; /* Azul oscuro/gris para texto */
            --background-color: #f4f7f9; /* Fondo gris claro */
            --card-background-color: #ffffff; /* Fondo de la tarjeta */
            --text-color-light: #7f8c8d; /* Texto gris claro */
            --shadow-color: rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--background-color);
            color: var(--secondary-color);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            text-align: center;
            line-height: 1.6;
        }

        .maintenance-container {
            background-color: var(--card-background-color);
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px var(--shadow-color);
            max-width: 600px;
            width: 90%;
            margin: 20px;
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .maintenance-icon {
            width: 80px;
            height: 80px;
            margin-bottom: 25px;
            color: var(--primary-color);
            animation: bounce 2s infinite ease-in-out;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {transform: translateY(0);}
            40% {transform: translateY(-20px);}
            60% {transform: translateY(-10px);}
        }

        .maintenance-title {
            font-size: 2.2em;
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 15px;
        }

        .maintenance-message {
            font-size: 1.1em;
            color: var(--secondary-color);
            margin-bottom: 20px;
        }

        .custom-message {
            font-size: 0.95em;
            color: var(--text-color-light);
            margin-top: 20px;
            padding: 15px;
            background-color: #f9fafb; /* Un fondo ligeramente diferente para el mensaje personalizado */
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }

        .progress-bar-container {
            width: 100%;
            background-color: #e0e0e0;
            border-radius: 5px;
            margin-top: 30px;
            overflow: hidden; /* Para que la barra de progreso no se salga */
        }

        .progress-bar {
            width: 0%; /* Se animará con JS o CSS */
            height: 10px;
            background-color: var(--primary-color);
            border-radius: 5px;
            animation: progressBarAnimation 20s linear infinite; /* Ajusta la duración según sea necesario */
        }

        @keyframes progressBarAnimation {
            0% { width: 0%; }
            25% { width: 50%; }
            50% { width: 75%; }
            75% { width: 90%; }
            100% { width: 100%; } /* O puedes hacer que se reinicie o se detenga en un punto */
        }


        .footer-text {
            margin-top: 30px;
            font-size: 0.9em;
            color: var(--text-color-light);
        }

        a {
            color: var(--primary-color);
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Responsive adjustments */
        @media (max-width: 600px) {
            .maintenance-title {
                font-size: 1.8em;
            }
            .maintenance-message {
                font-size: 1em;
            }
            .maintenance-icon {
                width: 100px;
                height: 100px;
            }
            .maintenance-container {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="maintenance-container">
        <svg class="maintenance-icon" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 321.78 144"><defs><style>.cls-1,.cls-3{fill:#4d869c;stroke-width:0}.cls-3{fill:#cde8e5}</style></defs>
            <path class="cls-3" d="M53.15 97.74c-6.61-6.16-9.92-14.96-9.92-26.39s3.31-20.22 9.92-26.39c6.62-6.16 15.56-9.25 26.84-9.25l43.67 7.89-23 62-20.67 1.38c-11.28 0-20.22-3.08-26.84-9.25Z"></path>
            <path class="cls-1" d="M8.5 34.6c5.67-10.93 13.77-19.43 24.3-25.5C43.33 3.03 55.73 0 70 0c12.27 0 23.23 2.3 32.9 6.9 9.67 4.6 17.53 11.1 23.6 19.5s10.1 18.2 12.1 29.4H91.8c-2.13-4.67-5.17-8.3-9.1-10.9-3.93-2.6-8.43-3.9-13.5-3.9-7.47 0-13.37 2.8-17.7 8.4C47.17 55 45 62.53 45 72s2.17 17 6.5 22.6c4.33 5.6 10.23 8.4 17.7 8.4 5.07 0 9.57-1.3 13.5-3.9 3.93-2.6 6.97-6.23 9.1-10.9h46.8c-2 11.2-6.03 21-12.1 29.4-6.07 8.4-13.93 14.9-23.6 19.5-9.67 4.6-20.63 6.9-32.9 6.9-14.27 0-26.67-3.03-37.2-9.1-10.53-6.07-18.63-14.57-24.3-25.5C2.83 98.47 0 86 0 72s2.83-26.47 8.5-37.4ZM287.08 10.4c11.13 6 19.7 14.33 25.7 25s9 22.8 9 36.4-3 25.6-9 36.4c-6 10.8-14.57 19.3-25.7 25.5-11.13 6.2-24.1 9.3-38.9 9.3h-79l31-141.6h48c14.8 0 27.77 3 38.9 9Zm-19.1 84.8c5.87-5.47 8.8-13.27 8.8-23.4s-2.93-17.93-8.8-23.4c-5.87-5.46-13.8-8.2-23.8-8.2h-10.6v63.2h10.6c10 0 17.93-2.73 23.8-8.2Z"></path>
            <path d="M186.62 121.6h-47.2l-7 21.4h-46.6l51.8-141.6h51.2l51.6 141.6h-46.8l-7-21.4Zm-10.8-33.4-12.8-39.4-12.8 39.4h25.6Z" style="fill:#7ab2b2;stroke-width:0"></path>
            <path class="cls-3" d="m161.66 43.61 20 44-44.94 4.71 24.94-48.71zM270.73 97.74c6.61-6.16 9.92-14.96 9.92-26.39s-3.31-20.22-9.92-26.39c-6.62-6.16-15.56-9.25-26.84-9.25h-11.95v71.27h11.95c11.28 0 20.22-3.08 26.84-9.25Z"></path>
            <path class="cls-1" d="M127.4 27.68c5.56 8.11 9.3 17.48 11.2 28.12h-21.68"></path>
        </svg>

        <h1 class="maintenance-title">¡Estamos Mejorando!</h1>
        <p class="maintenance-message">
            Nuestro sitio web se encuentra temporalmente en mantenimiento para ofrecerte una mejor experiencia.
            Agradecemos tu paciencia y comprensión.
        </p>

        @isset($exception)
            @if($exception->getMessage() && $exception->getMessage() !== 'Service Unavailable')
                <div class="custom-message">
                    <p><strong>Información Adicional:</strong></p>
                    <p>{{ $exception->getMessage() }}</p>
                </div>
            @endif
        @endisset

        <div class="progress-bar-container">
            <div class="progress-bar"></div>
        </div>

        <p class="footer-text">
            Volveremos a estar en línea lo antes posible.
            Si necesitas asistencia urgente, puedes <a href="mailto:cad@cch.unam.mx">contactarnos</a>.
            </p>
    </div>
</body>
</html>
