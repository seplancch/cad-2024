<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Reporte CAD</title>
  </head>
  <body>

    <div class="text-center">
        <img src="https://upload.wikimedia.org/wikipedia/commons/c/ca/Escudo-UNAM-escalable.svg" alt="UNAM" width="50">&nbsp;&nbsp;
        <img src="https://herramientastic.cch.unam.mx/img/logo-cch.svg" alt="" width="50"> &nbsp;&nbsp;
        <img src="data:image/jpeg;base64,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" alt="" width="50">
    </div>
    <div class="text-center">
                <p>Universidad Nacional Autónoma de México <br/>
                Escuela Nacional Colegio de Ciencias y Humanidades <br/>
                Dirección General <br/>
                Secretaría de Planeación</p>
    </div>

    <div class="text-center">
        <h3>Cuestionario de Actividad Docente</h3>
        <p>Periodo: 2024-2</p>
    </div>

    <div><p>Alumno(a): <strong>{{$usuario->name}}</strong></p></div>
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
  </body>
</html>
