<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">


    <title>Reporte CAD</title>
    <style>
        body, blockquote {
            font-size: 12px !important;
        }
        
        /* Estilos adicionales para el header */
        .header-table {
            width: 100%;
            margin-bottom: 0.2rem;
            border-collapse: collapse;
        }
        
        .header-table td {
            padding: 0.2rem;
            vertical-align: middle;
            border: none;
        }
        
        .header-logos {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            justify-content: center;
        }
        
        .header-text {
            text-align: right;
            line-height: 1;
            padding-right: 1rem;
        }
        
        .header-text div {
            margin-bottom: 0.1rem;
        }
        
        /* Estilos mejorados para la tabla principal */
        .table {
            width: 100%;
            margin-bottom: 0.8rem;
            color: #212529;
            border-collapse: collapse;
            font-size: 10px;
        }
        
        .table th {
            background-color: #2c3e50;
            color: white;
            font-weight: 600;
            padding: 0.3rem 0.4rem;
            text-align: left;
            border: 1px solid #34495e;
            font-size: 10px;
        }
        
        .table td {
            padding: 0.25rem 0.4rem;
            vertical-align: middle;
            border: 1px solid #dee2e6;
            line-height: 1.2;
        }
        
        .table tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        .table tr:hover {
            background-color: #f1f3f5;
        }
        
        .text-center {
            text-align: center !important;
        }
        
        .alert {
            position: relative;
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.25rem;
        }
        
        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
        
        .alert-info {
            color: #0c5460;
            background-color: #d1ecf1;
            border-color: #bee5eb;
        }
        
        .badge {
            padding: 0.2em 0.4em;
            font-size: 80%;
            font-weight: 600;
            border-radius: 2px;
            text-transform: uppercase;
            line-height: 1;
        }
        
        .badge-success {
            background-color: #28a745;
            color: white;
        }
        
        .badge-danger {
            background-color: #dc3545;
            color: white;
        }
        
        .mt-3 {
            margin-top: 1rem !important;
        }
        
        .mt-4 {
            margin-top: 1.5rem !important;
        }
        
        .text-primary {
            color: #007bff !important;
        }
        
        .text-right {
            text-align: right !important;
        }
        
        .mb-0 {
            margin-bottom: 0 !important;
        }
        
        .blockquote {
            margin-bottom: 1rem;
            font-size: 1.25rem;
        }
        
        .blockquote-footer {
            display: block;
            font-size: 80%;
            color: #6c757d;
        }
        
        /* Estilos para la sección de agradecimiento */
        .agradecimiento {
            background-color: #f8f9fa;
            border-left: 4px solid #2c3e50;
            padding: 0.8rem 1.2rem;
            margin: 1rem 0;
            font-size: 11px;
            line-height: 1.4;
            color: #2c3e50;
        }
        
        .agradecimiento strong {
            color: #1a252f;
            font-weight: 600;
        }
        
        /* Estilos para el footer */
        .footer {
            margin-top: 1.5rem;
            padding-top: 0.8rem;
            border-top: 1px solid #dee2e6;
            font-size: 10px;
            color: #6c757d;
        }
        
        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1.5rem;
        }
        
        .footer-qr {
            flex: 0 0 auto;
            text-align: center;
        }
        
        .footer-qr img {
            width: 80px;
            height: 80px;
            margin-bottom: 0.3rem;
        }
        
        .footer-qr i {
            font-size: 9px;
            color: #495057;
            display: block;
            margin: 0.2rem 0;
        }
        
        .footer-info {
            flex: 1;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }
        
        .footer-contact {
            flex: 1;
            padding-right: 1.5rem;
        }
        
        .footer-contact div {
            margin-bottom: 0.2rem;
            line-height: 1.2;
        }
        
        .footer-quote {
            flex: 0 0 auto;
            text-align: right;
            min-width: 200px;
        }
        
        .footer-quote p {
            color: #2c3e50;
            font-size: 10px;
            font-style: italic;
            margin: 0;
            line-height: 1.2;
        }
        
        .footer-quote footer {
            font-size: 9px;
            color: #6c757d;
            margin-top: 0.1rem;
        }
        
        /* Estilos para la sección de profesores */
        .seccion-profesores {
            margin: 1.5rem 0;
        }
        
        .titulo-seccion {
            color: #2c3e50;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 0.8rem;
            padding-bottom: 0.4rem;
            border-bottom: 2px solid #2c3e50;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .info-alumno {
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 4px;
            padding: 0.8rem 1rem;
            margin-bottom: 1rem;
            font-size: 11px;
            line-height: 1.4;
        }
        
        .info-alumno strong {
            color: #2c3e50;
            font-weight: 600;
        }
        
        .info-alumno div {
            margin-bottom: 0.3rem;
        }
        
        .info-alumno div:last-child {
            margin-bottom: 0;
        }
    </style>
  </head>
  <body>

    <table class="header-table">
        <tr>
            <td width="50%" style="border-bottom: 1px solid #dee2e6;">
                <div class="header-logos">
                    <img src="{{ public_path('img/unam.svg') }}" alt="UNAM" width="40" />
                    <img src="{{ public_path('img/cch.svg') }}" alt="CCH" width="40" />
                    <img src="{{ public_path('img/seplan_logo.png') }}" alt="CAD" width="40" />
                </div>
            </td>
            <td width="50%" style="border-bottom: 1px solid #dee2e6; text-align: right;">
                <div class="header-text">
                    <div>Universidad Nacional Autónoma de México</div>
                    <div>Escuela Nacional Colegio de Ciencias y Humanidades</div>
                    <div>Dirección General</div>
                    <div>Secretaría de Planeación</div>
                </div>
            </td>
        </tr>
    </table>

    <div class="text-center" style="margin: 0.1rem 0;">
        <h4 style="margin: 0;">Cuestionario de Actividad Docente (CAD) {{$periodo->clave}}</h4>
    </div>

    <div style="margin: 0.4rem 0; padding: 0.4rem 0.6rem; background-color: #f8f9fa; border-left: 3px solid #2c3e50;">
        <div style="display: flex; gap: 1.5rem; font-size: 10px; color: #495057; align-items: baseline;">
            <div style="flex: 1;">
                <span style="color: #6c757d; margin-right: 0.3rem;">Alumno(a):</span>
                <span style="color: #2c3e50; font-weight: 600;">{{$alumno->user->name}}</span>
            </div>
            <div style="flex: 1;">
                <span style="color: #6c757d; margin-right: 0.3rem;">No. Cuenta:</span>
                <span style="color: #2c3e50; font-weight: 600;">{{$alumno->numero_cuenta}}</span>
            </div>
            <div style="flex: 1;">
                <span style="color: #6c757d; margin-right: 0.3rem;">Plantel:</span>
                <span style="color: #2c3e50; font-weight: 600;">{{$alumno->plantel[0]->nombre}}</span>
            </div>
        </div>
    </div>

    <table class="table">
        <thead>
          <tr>
            <th style="width: 28%">Profesor</th>
            <th style="width: 37%">Asignatura</th>
            <th style="width: 10%">Grupo</th>
            <th style="width: 10%">Sección</th>
            <th style="width: 15%">Estado</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($inscripciones as $inscripcion)
            <tr>
                <td style="font-weight: 500; font-size: 10px;">{{ $inscripcion->grupo->profesor->user->name }}</td>
                <td style="font-size: 10px;">{{ $inscripcion->grupo->asignatura->nombre }}</td>
                <td class="text-center" style="font-size: 10px;">{{ $inscripcion->grupo->nombre }}</td>
                <td class="text-center" style="font-size: 10px;">{{ $inscripcion->grupo->seccion ?: '-' }}</td>
                <td class="text-center">
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

    @if($semestre == 6)
    <div class="text-center mt-3 alert alert-info" role="alert">
        <h5>CLAVE:</h5>
        <strong>{{ $alumno->numero_cuenta }}</strong>
    </div>
    @endif

    <div style="margin: 0.8rem 0; padding: 0.5rem 0;">
        <div style="text-align: center; font-family: 'Times New Roman', Times, serif; font-size: 11px; color: #495057; line-height: 1.3;">
            <strong style="color: #2c3e50;">La Secretaría de Planeación</strong> agradece su valiosa participación, 
            la cual contribuye al mejoramiento de la calidad educativa del Colegio.
        </div>
    </div>

    <div class="footer">
        <div class="footer-content">
            <div class="footer-qr">
                <img src="{{$qrImagen}}" alt="">
                <i>Escanea para validar</i>
                <div style="font-size: 9px; color: #495057;">{{$linkvalidacion}}</div>
            </div>

            <div class="footer-info">
                <div class="footer-contact">
                    <div>Reporte generado automáticamente por el sistema CAD</div>
                    <div>Soporte: <strong>cad@cch.unam.mx</strong></div>
                    <div>Fecha: {{ now()->format('d-m-Y H:i:s') }}</div>
                </div>
                
                <div class="footer-quote">
                    <p>"Aprender a aprender, aprender a hacer y aprender a ser"</p>
                    <footer>Colegio de Ciencias y Humanidades</footer>
                </div>
            </div>
        </div>
    </div>
  </body>
</html>
