@extends('inicio.layouts.app')

@section('content')
<div class="w-full max-w-lg max-w-screen-md mx-auto pt-10 animate-fade animate-ease-in-out animate-duration-1000">
    <h3 class="animate-fade-left">Preguntas Frecuentes</h3>

    <div id="accordion-flush" data-accordion="collapse" data-active-classes="bg-white dark:bg-gray-900 text-gray-900 dark:text-white" data-inactive-classes="text-gray-500 dark:text-gray-400">
      <h2 id="accordion-flush-heading-1">
        <button type="button" class="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 gap-3" data-accordion-target="#accordion-flush-body-1" aria-expanded="true" aria-controls="accordion-flush-body-1">
          <span>¿Qué aspectos evalúa el CAD?</span>
          <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
          </svg>
        </button>
      </h2>
      <div id="accordion-flush-body-1" class="hidden" aria-labelledby="accordion-flush-heading-1">
        <div class="py-5 border-b border-gray-200 dark:border-gray-700">
          <p>Este instrumento, aplicado a los alumnos, permite obtener información valiosa sobre diversos aspectos del desempeño del profesor en el aula, tales como:</p>
          <ul class="ul-disc">
            <li>Asistencia y cumplimiento de horario </li>
            <li>Planeación y organización de las clases </li>
            <li>Dominio del contenido y desarrollo del curso </li>
            <li>Desarrollo de habilidades transversales </li>
            <li>Evaluación del aprendizaje </li>
            <li>Interacción profesor alumno, Habilidades de comunicación</li>
          </ul>
        </div>
      </div>
      <h2 id="accordion-flush-heading-2">
        <button type="button" class="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 gap-3" data-accordion-target="#accordion-flush-body-2" aria-expanded="false" aria-controls="accordion-flush-body-2">
          <span>¿Cómo se utilizan los resultados?</span>
          <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
          </svg>
        </button>
      </h2>
      <div id="accordion-flush-body-2" class="hidden" aria-labelledby="accordion-flush-heading-2">
        <div class="py-5 border-b border-gray-200 dark:border-gray-700">
          <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Iure quae, voluptatibus at delectus doloremque incidunt placeat in odio maiores eum fugiat sed! Exercitationem culpa impedit amet doloremque ut, id voluptates!</p>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam cumque explicabo itaque vitae. Repellendus, illo quas! Voluptate adipisci temporibus saepe tempore voluptates nisi! Excepturi id quisquam mollitia quae nostrum culpa.</p>
        </div>
      </div>
      <h2 id="accordion-flush-heading-3">
        <button type="button" class="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 gap-3" data-accordion-target="#accordion-flush-body-3" aria-expanded="false" aria-controls="accordion-flush-body-3">
          <span>Casos comúnes en los que no se responde el cuestionario CAD.</span>
          <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
          </svg>
        </button>
      </h2>
      <div id="accordion-flush-body-3" class="hidden" aria-labelledby="accordion-flush-heading-3">
        <div class="py-5 border-b border-gray-200 dark:border-gray-700">
          <ol class="ol-number">
            <li>Alumnos sin inscripción en el semestre en curso (2023-2).			</li>
            <li>Alumnos que solo cursaron materias correspondientes a semestres impares. Ej. 2023-1.		</li>
            <li>Alumnos que estén cursando su 4° año (o más), excepto alumnos inscritos de forma ordinaria. Ej. Materias pares (Historia Universal II, Matemáticas IV, Cálculo II, etc).</li>
            <li>Alumnos que estuvieron inscritos en cursos PAE, último esfuerzo e intensivos.	</li>
            <li>Alumnos que se dieron de baja hace 1 año o más y realizarán su inscripción para el siguiente semestre (2024-1). En este caso te recomendamos acudir a la Unidad de Planeación y/o Control Escolar correspondiente a tu plantel para recibir una mejor orientación. 									</li>
            <li>Alumnos con 100% de créditos que en el periodo correspondiente no tramitaron su pase reglamentado.</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
@endsection
