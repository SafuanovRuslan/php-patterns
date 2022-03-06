<?php

// Реализовать построение и обход дерева для математического выражения

$expression = "6+2*10+8/2"; // 30


// Разбиваес строку на массив
function expToArray(string $input) {
    $expression = str_split($input);
    $expArray = [];

    $temp = '';
    foreach ($expression as $v) {
        if ( $v != '+' && $v != '-' && $v != '*' && $v != '/') {
            $temp .= $v;
        } else {
            $expArray[] = $temp;
            $temp = '';

            $expArray[] = $v;
        }
    }
    $expArray[] = $temp;

    return $expArray;
}


// Функция возвращает позицию оператора в соответствии с обратным приоритетом
function getOperatorPosition($exp) {
    if (in_array('+', $exp)) return array_search('+', $exp);
    if (in_array('-', $exp)) return array_search('-', $exp);
    if (in_array('*', $exp)) return array_search('*', $exp);
    if (in_array('/', $exp)) return array_search('/', $exp);
    return false;
}


// Считаем
function calculate(array $exp) {
    $pos = getOperatorPosition($exp);

    // Если нет операторов, то это число, а не выражение, возвращаем
    if (!$pos) return $exp[0];

    // Разбиваем выражение на ветви
    $left = array_slice($exp, 0, $pos);
    $right = array_slice($exp, $pos + 1);

    // Проводим математические операции с ветвями
    switch ($exp[$pos]) {
        case '+':
            return calculate($left) + calculate($right);
        case '-':
            return calculate($left) - calculate($right);
        case '*':
            return calculate($left) * calculate($right);
        case '/':
            return calculate($left) / calculate($right);
    }
}


// Клиентский код
$expArray = expToArray($expression);
echo calculate($expArray);