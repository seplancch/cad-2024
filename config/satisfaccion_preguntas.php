<?php
return [
    [
        'id' => 1,
        'pregunta' => '¿El sistema fue fácil de usar?',
        'tipo' => 'radio',
        'opciones' => [
            ['texto' => 'Muy fácil', 'valor' => 5],
            ['texto' => 'Fácil', 'valor' => 4],
            ['texto' => 'Regular', 'valor' => 3],
            ['texto' => 'Difícil', 'valor' => 2],
            ['texto' => 'Muy difícil', 'valor' => 1],
        ],
    ],
    [
        'id' => 2,
        'pregunta' => '¿El sistema funcionó sin errores ni interrupciones?',
        'tipo' => 'radio',
        'opciones' => [
            ['texto' => 'Siempre', 'valor' => 5],
            ['texto' => 'Casi siempre', 'valor' => 4],
            ['texto' => 'A veces', 'valor' => 3],
            ['texto' => 'Rara vez', 'valor' => 2],
            ['texto' => 'Nunca', 'valor' => 1],
        ],
    ],
    [
        'id' => 3,
        'pregunta' => '¿Te sentiste seguro/a usando el sistema para tus evaluaciones?',
        'tipo' => 'radio',
        'opciones' => [
            ['texto' => 'Totalmente de acuerdo', 'valor' => 5],
            ['texto' => 'De acuerdo', 'valor' => 4],
            ['texto' => 'Neutral', 'valor' => 3],
            ['texto' => 'En desacuerdo', 'valor' => 2],
            ['texto' => 'Totalmente en desacuerdo', 'valor' => 1],
        ],
    ],
    [
        'id' => 4,
        'pregunta' => '¿Recomendarías este sistema a otros estudiantes?',
        'tipo' => 'radio',
        'opciones' => [
            ['texto' => 'Sí', 'valor' => 1],
            ['texto' => 'No', 'valor' => 0],
        ],
    ],
    [
        'id' => 5,
        'pregunta' => '¿Qué mejorarías del sistema? (opcional)',
        'tipo' => 'textarea',
        'opciones' => [],
    ],
];
