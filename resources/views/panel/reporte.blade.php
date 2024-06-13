<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Reporte CAD</title>
    <style>
        body, blockquote {
            font-size: 12px !important;
        }
    </style>
  </head>
  <body>

    <div class="text-center">
        <img src="https://upload.wikimedia.org/wikipedia/commons/c/ca/Escudo-UNAM-escalable.svg" alt="UNAM" width="50">&nbsp;&nbsp;
        <img src="https://portalacademico.cch.unam.mx/themes/pacch/img/logo-cch-color.svg" alt="" width="50"> &nbsp;&nbsp;
        <img src="https://cad.cch.unam.mx/seplan_logo.png" alt="" width="50">
    </div>
    <div class="text-center">
                <p>Universidad Nacional Autónoma de México <br/>
                Escuela Nacional Colegio de Ciencias y Humanidades <br/>
                Dirección General <br/>
                Secretaría de Planeación</p>
    </div>

    <div class="text-center">
        <h4>Cuestionario de Actividad Docente (CAD) {{$periodo->clave}}</h4>

    </div>

    <div>
        <p>Alumno(a): <strong>{{$alumno->user->name}}</strong><br />
        No. Cuenta: <strong>{{$alumno->numero_cuenta}}</strong><br />
        Plantel: <strong>{{$alumno->plantel[0]->nombre}}</strong>
    </p>
    </div>
    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Profesor</th>
            <th scope="col">Asignatura</th>
            <th scope="col">Grupo</th>
            <th scope="col">Sección</th>
            <th scope="col">Estado</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($inscripciones as $inscripcion)
            <tr>
                <td class="">{{ $inscripcion->grupo->profesor->user->name }}</td>
                <td class="">{{ $inscripcion->grupo->asignatura->nombre }}</td>
                <td class="">{{ $inscripcion->grupo->nombre }}</td>
                <td class="">{{ $inscripcion->grupo->seccion }}</td>
                <td class="">
                    @if( $inscripcion->estado )
                        <span class="badge badge-success">Completado</span>
                    @else
                        <span class="badge badge-danger">Pendiente</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>


    <!--<div class="row">
        <div class="col-md-4 offset-md-4">-->
            <div class="text-center mt-3 alert alert-info" role="alert">
                <h5>CLAVE:</h5>
                <strong>{{ $alumno->numero_cuenta }}</strong>
            </div>
    <!--    </div>
    </div>-->


    <div class="alert alert-success text-center mt-4" role="alert">
        La Secretaría de Planeación agradece tu participación en esta evaluación institucional.
    </div>

    <p class="text-center"><img src="{{$qrImagen}}" alt="" width="100" height="100"><br>
    <i>Escanea este código QR para validar tu reporte de evaluación.</i><br/>{{$linkvalidacion}}</p>

    <p>Este reporte es generado automáticamente por el sistema. Si tienes alguna duda, por favor contacta a soporte: cad@cch.unam.mx<br />
    Fecha de generación: {{ now()->format('d-m-Y H:i:s') }}</p>

    <blockquote class="blockquote align-bottom text-right">
        <p class="text-primary mb-0">"Aprender a aprender, aprender a hacer y aprender a ser"</p>
        <footer class="blockquote-footer">Colegio de Ciencias y Humanidades</footer>
    </blockquote>
  </body>
</html>
