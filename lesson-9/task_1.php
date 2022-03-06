<?php

// Создать массив на миллион элементов и отсортировать его различными способами. Сравнить скорости

// Генератор массива
function mkArr($length) {
    $arr = [];

    for ($i = 0; $i < $length; $i++) {
        $arr[] = rand(1, 10000);
    }

    return $arr;
}


// Функция подсчёта времени выполнения
function calculateTime($func, $arr) {
    $start = microtime(true);
    $func($arr);
    $end = microtime(true);

    $total = $end - $start;

    echo "$func: " . $total . '<br>';
}


// Пузырьковая сортировка
function bubbleSort($array){
    for($i=0; $i<count($array); $i++){
        
        $count = count($array);
        
        for($j=$i+1; $j<$count; $j++){
            if($array[$i]>$array[$j]){
                $temp = $array[$j];
                $array[$j] = $array[$i];
                $array[$i] = $temp;
            }
        }         
    
    }

    return $array;
}


// Шейкерная сортировка
function shakerSort ($array) {
    $n = count($array);
    $left = 0;
    $right = $n - 1;
    
    do {
        for ($i = $left; $i < $right; $i++) {
            if ($array[$i] > $array[$i + 1]) {
                list($array[$i], $array[$i + 1]) = array($array[$i + 1], $array[$i]);
            }
        }

        $right -= 1;

        for ($i = $right; $i > $left; $i--) {
            if ($array[$i] < $array[$i - 1]) {
                list($array[$i], $array[$i - 1]) = array($array[$i - 1], $array[$i]);
            }
        }
    
        $left += 1;

    } while ($left <= $right);

    return $array;
}
    

// Быстрая сортировка
function quickSort(&$arr, $low = null, $high = null) {
    $low = is_null($low) ? 0 : $low;
    $high = is_null($high) ? count($arr) - 1 : $high;

    $i = $low;                
    $j = $high;
    $middle = $arr[ ( $low + $high ) / 2 ];

    do {
        while($arr[$i] < $middle) ++$i;
        while($arr[$j] > $middle) --$j;
            
        if($i <= $j){           
            $temp = $arr[$i];
            $arr[$i] = $arr[$j];
            $arr[$j] = $temp;

            $i++; $j--;
        }
    }
    while ($i < $j);
    
    if($low < $j){
        quickSort($arr, $low, $j);
    }

    if($i < $high){
        quickSort($arr, $i, $high);
    }

    return $arr;
}


// Пирамидальная сортировка
function heapify(&$arr, $countArr, $i) {
    $largest = $i;
    $left = 2*$i + 1;
    $right = 2*$i + 2;

    if ($left < $countArr && $arr[$left] > $arr[$largest]) {
        $largest = $left;
    }
 
    if ($right < $countArr && $arr[$right] > $arr[$largest]) {
        $largest = $right;
    }

    if ($largest != $i) {
        $swap = $arr[$i];
        $arr[$i] = $arr[$largest];
        $arr[$largest] = $swap;

        heapify($arr, $countArr, $largest);
    }
}


function heapSort(&$arr) {
    $countArr = count($arr);

    for ($i = $countArr / 2 - 1; $i >= 0; $i--) {
        heapify($arr, $countArr, $i);
    }

    for ($i = $countArr-1; $i >= 0; $i--) {
        $temp = $arr[0];
        $arr[0] = $arr[$i];
        $arr[$i] = $temp;

        heapify($arr, $i, 0);
    }

    return $arr;
}



// Запуск сортировок и подсчёта времени
calculateTime('bubbleSort', mkArr(10000));
calculateTime('shakerSort', mkArr(10000));
calculateTime('quickSort', mkArr(10000));
calculateTime('heapSort', mkArr(10000));

// quickSort работает быстрее всего, для наглядности можно запустить