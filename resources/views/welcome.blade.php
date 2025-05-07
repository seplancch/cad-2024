{{-- En resources/views/cad_unam.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuestionario de Actividad Docente - CCH UNAM</title>

    {{-- Enlaza tu archivo CSS original --}}
    <link rel="stylesheet" href="{{ asset('css/nombre_de_tu_archivo.css') }}">

    {{-- Si tienes múltiples archivos CSS, añádelos también --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/otro_archivo_estilo.css') }}"> --}}

    {{-- Laravel también puede venir con CSS compilado (ej. si usas Vite) --}}
    {{-- Asegúrate de que no haya conflictos o decide cuál usar --}}
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>
<body>
    {{-- ... (resto de tu estructura HTML como se discutió antes) ... --}}

    <header>
        <h1>Cuestionario de Actividad Docente</h1>
        <nav>
            <ul>
                <li><a href="#">Inicio</a></li>
                <li><a href="#">¿Qué es?</a></li>
                <li><a href="#">Preguntas</a></li>
                <li><a href="#">Contacto</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="fechas-importantes">
            <h2>Fechas para completar el CAD</h2>
            <p>Alumnos de 6to semestre: 13 al 24 de Mayo</p>
            <p>Alumnos de 2do y 4to semestre: 3 al 21 de Junio</p>
        </section>

        <section id="descripcion-cad">
            <h2>Cuestionario de Actividad Docente (CAD)</h2>
            <p>Es un instrumento que tiene como propósito "recabar la opinión de los alumnos sobre algunos indicadores del desempeño docente en los cursos ordinarios", tales como: la asistencia y cumplimiento del horario asignado a cada clase; la planeación de los propósitos, aprendizajes y formas de evaluación de la asignatura.</p>
        </section>
    </main>

    <footer>
        <nav>
            <ul>
                <li><a href="#">Reporte de Profesores</a></li>
                <li><a href="#">Alumnos</a></li>
                <li><a href="#">Recursos</a></li>
                <li><a href="#">Créditos</a></li>
            </ul>
        </nav>
        <p>Escuela Nacional Colegio de Ciencias y Humanidades | Hecho en México | © Todos los derechos reservados.</p>
        <p>Esta página electrónica puede ser reproducida...</p>
    </footer>

</body>
</html>
