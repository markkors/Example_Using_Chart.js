<?php
header('Content-Type: application/json; charset=utf-8');

$data = ["labels" => ['Amersfoort', 'Amsterdam', 'Rotterdam', 'Utrecht', 'Almere', 'Haarlem'],
    "datasets" => [
        "label" => ['Aantal stemmen'],
        "data" => [rand(1, 15), rand(1, 15), rand(1, 15), rand(1, 15), rand(1, 15), rand(1, 15)],
        "backgroundColor" => [
            'rgba(54, 162, 235, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(54, 162, 235, 0.2)'
        ],
        "borderColor" => [
            'rgba(54, 162, 235, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(54, 162, 235, 1)'
        ],
        "borderWidth" => 1
    ]
];

$json_data = json_encode($data);
echo $json_data;