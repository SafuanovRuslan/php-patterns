<?php

// Подсчитать практически количество шагов при поиске описанными в методичке алгоритмами.

$arr = [1, 3, 5, 7, 11, 13, 17];

// Линейный поиск
function LinearSearch ($myArray, $num) {
    $count = count($myArray);
    $steps = 0;
    
    for ($i=0; $i < $count; $i++) {
        $steps++;

        if ($myArray[$i] == $num) {
            echo "Линейный поиск (шагов): " . $steps . '<br>';
            return $i;
        } elseif ($myArray[$i] > $num) {
            echo "Линейный поиск (шагов): " . $steps . '<br>';
            return null;
        }
    }
}


// Бинарный поиск
function binarySearch ($myArray, $num) {
    $left = 0;
    $right = count($myArray) - 1;
    $steps = 0;
    
    while ($left <= $right) {
        $steps++;

        $middle = floor(($right + $left)/2);   
        if ($myArray[$middle] == $num) {
            echo "Бинарный поиск (шагов): " . $steps . '<br>';
            return $middle;
        } elseif ($myArray[$middle] > $num) {
            $right = $middle - 1;
        } elseif ($myArray[$middle] < $num) {
            $left = $middle + 1;
        }
    }

    return null;
}


// Интерполяционный поиск
function InterpolationSearch($myArray, $num) {
    $start = 0;
    $last = count($myArray) - 1;
    $steps = 0;

    while (($start <= $last) && ($num >= $myArray[$start]) && ($num <= $myArray[$last])) {
        $steps++;
        $pos = floor($start + ((($last - $start) / ($myArray[$last] - $myArray[$start])) * ($num - $myArray[$start])));
        
        if ($myArray[$pos] == $num) {
            echo "Бинарный поиск (шагов): " . $steps . '<br>';
            return $pos;
        }

        if ($myArray[$pos] < $num) {
            $start = $pos + 1;
        } else {
            $last = $pos - 1;
        }
    }

return null;
}


LinearSearch($arr, 17);
binarySearch($arr, 17);
InterpolationSearch($arr, 17);

// Интерполяционный самый быстрый. Для наглядности лучше запустить.