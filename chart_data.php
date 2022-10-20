<?php
header('Content-Type: application/json; charset=utf-8');

$payload = json_decode(file_get_contents("php://input"));
$label = "aantal stemmen";
$backgroundcolor = 'rgba(54, 162, 235, 0.2)';

if(isset($payload->action)) {
    $label = $payload->action;
}

if(isset($payload->backgroundcolor)) {
    $backgroundcolor = $payload->backgroundcolor;
}

$data = ["labels" => ['Amersfoort', 'Amsterdam', 'Rotterdam', 'Utrecht', 'Almere', 'Haarlem'],
    "datasets" => [
        "label" => [$label],
        "data" => [rand(1, 15), rand(1, 15), rand(1, 15), rand(1, 15), rand(1, 15), rand(1, 15)],
        "backgroundColor" => [
            $backgroundcolor,
            $backgroundcolor,
            $backgroundcolor,
            $backgroundcolor,
            $backgroundcolor,
            $backgroundcolor
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