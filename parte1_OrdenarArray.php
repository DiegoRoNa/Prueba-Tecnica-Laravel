<?php

function primeros3Altos($arr): array|string
{
    $len = count($arr);

    // no permite array con menos de 3 elementos (ej. [1,2] [1] [])
    // permite 3 elementos o mas (ej. [1,2,3] [1,2,3,4] [1,2,3,4, ...n])
    if ($len < 3) {
        return 'El array no puede contener menos de 3 elementos';
    }

    // primer for para hiterar todos los nuevos estados del array
    for ($i=0; $i < $len - 1; $i++) {

        // segundo for para modificar el array
        for ($j=0; $j < $len - 1; $j++) {

            // validar si j es menor a j + 1, elemento actual menor al siguiente elemento
            if ($arr[$j] < $arr[$j + 1]) {
                $num = $arr[$j]; // elemento actual

                // intercambiar valores
                $arr[$j] = $arr[$j + 1];
                $arr[$j + 1] = $num;
            }

        }

    }

    return [$arr[0], $arr[1], $arr[2]];
}

$entrada = [10, 4, 3, 50, 23, 90];
$salida = primeros3Altos($entrada);

echo '<pre>';
var_dump($salida);
echo '</pre>';
