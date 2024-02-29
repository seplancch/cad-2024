<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Preguntas extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('preguntas')->insert([
            [
                'cuestionario_id' => 1,
                'rubro_id' => 1,
                'titulo' => '¿Asistí a clase?',
                'opcion_1' => 'Siempre',
                'opcion_2' => 'Casi siempre',
                'opcion_3' => 'A veces',
                'opcion_4' => 'Casi nunca',
                'opcion_5' => 'Nunca',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],[
                'cuestionario_id' => 1,
                'rubro_id' => 1,
                'titulo' => '¿Participé en las actividades y trabajos realizados en las clases?',
                'opcion_1' => 'Siempre',
                'opcion_2' => 'Casi siempre',
                'opcion_3' => 'A veces',
                'opcion_4' => 'Casi nunca',
                'opcion_5' => 'Nunca',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],[
                'cuestionario_id' => 1,
                'rubro_id' => 1,
                'titulo' => ' ¿Cumplí con las tareas? (actividades en casa o fuera de clase).',
                'opcion_1' => 'Siempre',
                'opcion_2' => 'Casi siempre',
                'opcion_3' => 'A veces',
                'opcion_4' => 'Casi nunca',
                'opcion_5' => 'Nunca',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],[
                'cuestionario_id' => 1,
                'rubro_id' => 1,
                'titulo' => 'Mi desempeño en la asignatura fue:',
                'opcion_1' => 'Excelente',
                'opcion_2' => 'Bueno',
                'opcion_3' => 'Regular',
                'opcion_4' => 'Malo',
                'opcion_5' => 'Deficiente',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'cuestionario_id' => 1,
                'rubro_id' => 2,
                'titulo' => ' ¿Asistió a clase?',
                'opcion_1' => 'Nunca',
                'opcion_2' => 'Casi Nunca',
                'opcion_3' => 'A veces',
                'opcion_4' => 'Casi siempre',
                'opcion_5' => 'Siempre',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],[
                'cuestionario_id' => 1,
                'rubro_id' => 2,
                'titulo' => '¿Cumplió con el tiempo asignado a cada clase?',
                'opcion_1' => 'Nunca',
                'opcion_2' => 'Casi Nunca',
                'opcion_3' => 'A veces',
                'opcion_4' => 'Casi siempre',
                'opcion_5' => 'Siempre',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'cuestionario_id' => 1,
                'rubro_id' => 3,
                'titulo' => 'Al inicio del curso, la explicación de tu profesor o profesora sobre los aprendizajes y temáticas de la asignatura fue:',
                'opcion_1' => 'Muy clara',
                'opcion_2' => 'Clara',
                'opcion_3' => 'Poco clara',
                'opcion_4' => 'Confusa',
                'opcion_5' => 'No los explicó',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'cuestionario_id' => 1,
                'rubro_id' => 3,
                'titulo' => 'Al inicio del curso, la explicación de tu profesor o profesora sobre las formas de evaluación fue:',
                'opcion_1' => 'Muy clara',
                'opcion_2' => 'Clara',
                'opcion_3' => 'Poco clara',
                'opcion_4' => 'Confusa',
                'opcion_5' => 'No los explicó',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'cuestionario_id' => 1,
                'rubro_id' => 3,
                'titulo' => 'Durante el curso, ¿tu profesor(a) programó las actividades con anticipación?',
                'opcion_1' => 'Siempre',
                'opcion_2' => 'Casi siempre',
                'opcion_3' => 'A veces',
                'opcion_4' => 'Casi nunca',
                'opcion_5' => 'Nunca',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'cuestionario_id' => 1,
                'rubro_id' => 3,
                'titulo' => '¿En las clases se estudiaron las temáticas del programa de la asignatura?',
                'opcion_1' => 'Siempre',
                'opcion_2' => 'Casi siempre',
                'opcion_3' => 'A veces',
                'opcion_4' => 'Casi nunca',
                'opcion_5' => 'Nunca',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'cuestionario_id' => 1,
                'rubro_id' => 3,
                'titulo' => '¿Tu profesor(a) te explicó la finalidad de las actividades que realizaron?',
                'opcion_1' => 'Siempre',
                'opcion_2' => 'Casi siempre',
                'opcion_3' => 'A veces',
                'opcion_4' => 'Casi nunca',
                'opcion_5' => 'Nunca',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'cuestionario_id' => 1,
                'rubro_id' => 4,
                'titulo' => '¿Te indicó con precisión cómo elaborar las actividades (tareas, reportes, trabajos o investigaciones)? ',
                'opcion_1' => 'Nunca',
                'opcion_2' => 'Casi Nunca',
                'opcion_3' => 'A veces',
                'opcion_4' => 'Casi siempre',
                'opcion_5' => 'Siempre',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'cuestionario_id' => 1,
                'rubro_id' => 4,
                'titulo' => '¿Explicó los temas de manera clara y comprensible?',
                'opcion_1' => 'Nunca',
                'opcion_2' => 'Casi Nunca',
                'opcion_3' => 'A veces',
                'opcion_4' => 'Casi siempre',
                'opcion_5' => 'Siempre',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'cuestionario_id' => 1,
                'rubro_id' => 4,
                'titulo' => '¿Utilizó ejemplos que facilitaron tu aprendizaje?',
                'opcion_1' => 'Nunca',
                'opcion_2' => 'Casi Nunca',
                'opcion_3' => 'A veces',
                'opcion_4' => 'Casi siempre',
                'opcion_5' => 'Siempre',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'cuestionario_id' => 1,
                'rubro_id' => 4,
                'titulo' => '¿Resolvió tus dudas?',
                'opcion_1' => 'Nunca',
                'opcion_2' => 'Casi Nunca',
                'opcion_3' => 'A veces',
                'opcion_4' => 'Casi siempre',
                'opcion_5' => 'Siempre',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'cuestionario_id' => 1,
                'rubro_id' => 4,
                'titulo' => '¿Estableció la relación entre un tema y otro?',
                'opcion_1' => 'Nunca',
                'opcion_2' => 'Casi Nunca',
                'opcion_3' => 'A veces',
                'opcion_4' => 'Casi siempre',
                'opcion_5' => 'Siempre',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'cuestionario_id' => 1,
                'rubro_id' => 4,
                'titulo' => '¿Motivó actitudes de colaboración entre compañeros?',
                'opcion_1' => 'Nunca',
                'opcion_2' => 'Casi Nunca',
                'opcion_3' => 'A veces',
                'opcion_4' => 'Casi siempre',
                'opcion_5' => 'Siempre',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'cuestionario_id' => 1,
                'rubro_id' => 4,
                'titulo' => '¿Estimuló tu interés por el aprendizaje de la asignatura?',
                'opcion_1' => 'Nunca',
                'opcion_2' => 'Casi Nunca',
                'opcion_3' => 'A veces',
                'opcion_4' => 'Casi siempre',
                'opcion_5' => 'Siempre',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ], [
                'cuestionario_id' => 1,
                'rubro_id' => 4,
                'titulo' => '¿Motivó actitudes de colaboración entre compañeros?',
                'opcion_1' => 'Definitivamente no',
                'opcion_2' => 'Quizás',
                'opcion_3' => 'Definitivamente sí',
                'opcion_4' => '',
                'opcion_5' => '',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'cuestionario_id' => 1,
                'rubro_id' => 5,
                'titulo' => ' ¿Promovió que fundamentaras tus opiniones?',
                'opcion_1' => 'Siempre',
                'opcion_2' => 'Casi siempre',
                'opcion_3' => 'A veces',
                'opcion_4' => 'Casi nunca',
                'opcion_5' => 'Nunca',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'cuestionario_id' => 1,
                'rubro_id' => 5,
                'titulo' => '¿Promovió la búsqueda e identificación de diferentes fuentes de información?',
                'opcion_1' => 'Siempre',
                'opcion_2' => 'Casi siempre',
                'opcion_3' => 'A veces',
                'opcion_4' => 'Casi nunca',
                'opcion_5' => 'Nunca',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'cuestionario_id' => 1,
                'rubro_id' => 5,
                'titulo' => '¿Fomentó el uso de recursos tecnológicos para apoyar tu aprendizaje?',
                'opcion_1' => 'Siempre',
                'opcion_2' => 'Casi siempre',
                'opcion_3' => 'A veces',
                'opcion_4' => 'Casi nunca',
                'opcion_5' => 'Nunca',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'cuestionario_id' => 1,
                'rubro_id' => 6,
                'titulo' => '¿Evaluó las actividades académicas a lo largo del curso?',
                'opcion_1' => 'Nunca',
                'opcion_2' => 'Casi Nunca',
                'opcion_3' => 'A veces',
                'opcion_4' => 'Casi siempre',
                'opcion_5' => 'Siempre',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'cuestionario_id' => 1,
                'rubro_id' => 6,
                'titulo' => 'Al entregar las evaluaciones de las actividades, tareas, exámenes y trabajos, ¿comentó los resultados con el grupo?',
                'opcion_1' => 'Nunca',
                'opcion_2' => 'Casi Nunca',
                'opcion_3' => 'A veces',
                'opcion_4' => 'Casi siempre',
                'opcion_5' => 'Siempre',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'cuestionario_id' => 1,
                'rubro_id' => 6,
                'titulo' => '¿Respetó las formas de evaluación establecidas al inicio del curso?',
                'opcion_1' => 'Nunca',
                'opcion_2' => 'Casi Nunca',
                'opcion_3' => 'A veces',
                'opcion_4' => 'Casi siempre',
                'opcion_5' => 'Siempre',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'cuestionario_id' => 1,
                'rubro_id' => 6,
                'titulo' => '¿Evaluó los aprendizajes y temáticas de la asignatura?',
                'opcion_1' => 'Nunca',
                'opcion_2' => 'Casi Nunca',
                'opcion_3' => 'A veces',
                'opcion_4' => 'Casi siempre',
                'opcion_5' => 'Siempre',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'cuestionario_id' => 1,
                'rubro_id' => 6,
                'titulo' => '¿Asignó calificaciones con base en las actividades realizadas?',
                'opcion_1' => 'Nunca',
                'opcion_2' => 'Casi Nunca',
                'opcion_3' => 'A veces',
                'opcion_4' => 'Casi siempre',
                'opcion_5' => 'Siempre',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'cuestionario_id' => 1,
                'rubro_id' => 7,
                'titulo' => '¿Promovió que escucharas y respetaras la opinión de los demás?',
                'opcion_1' => 'Siempre',
                'opcion_2' => 'Casi siempre',
                'opcion_3' => 'A veces',
                'opcion_4' => 'Casi nunca',
                'opcion_5' => 'Nunca',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'cuestionario_id' => 1,
                'rubro_id' => 7,
                'titulo' => '¿Demostró respeto y tolerancia?',
                'opcion_1' => 'Siempre',
                'opcion_2' => 'Casi siempre',
                'opcion_3' => 'A veces',
                'opcion_4' => 'Casi nunca',
                'opcion_5' => 'Nunca',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
        ]);
    }
}
