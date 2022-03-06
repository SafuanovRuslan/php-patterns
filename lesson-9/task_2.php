<?php

// Реализовать удаление элемента массива по его значению. Обратите внимание на возможные дубликаты!

function mkArr($length, $min, $max) {
    $arr = [];

    for ($i = 0; $i < $length; $i++) {
        $arr[] = rand($min, $max);
    }

    return $arr;
}


function clean($arr, $target) {
    for ($i = 0; $i < count($arr); $i++) {
        if ($arr[$i] == $target) {
            unset($arr[$i]);
        }
    }

    return $arr;
}


$arr = mkArr(10, 0, 3);
print_r($arr);
echo '<br>';

$arr = clean($arr, 0);
print_r($arr);