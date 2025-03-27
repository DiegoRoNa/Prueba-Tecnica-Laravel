<?php

function processNumbers($nums): array|string
{
    if (!is_array($nums)) {
        return 'Sólo se aceptan arreglos';
    }

    if (empty($nums)) {
        return 'El array está vacío';
    }

    $arrayNumeric = count($nums) === count(array_filter($nums, 'is_numeric'));
    if (!$arrayNumeric) {
        return 'Alguno de los elementos del array no es un número';
    }

    $result = [];

    foreach ($nums as $key => $num) {
        $result[$key] = $num % 2 == 0 ? $num * 2 : $num * 3;
    }

    return $result;

}

// $entrada = 'Prueba con un string';
// $entrada = [];
// $entrada = [2, 4, 'hola', 323, 3.4, false];
$entrada = [2, 4, '80', 323, 3.4, 70];
echo '<pre>';
var_dump(processNumbers($entrada));
echo '</pre>';
