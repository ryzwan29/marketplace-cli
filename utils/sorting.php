<?php

function divideAndConquerSort($arr, $key) {
    if (count($arr) <= 1) return $arr;

    $mid = intdiv(count($arr), 2);
    $left = divideAndConquerSort(array_slice($arr, 0, $mid), $key);
    $right = divideAndConquerSort(array_slice($arr, $mid), $key);

    return mergeDivideConquer($left, $right, $key);
}

function mergeDivideConquer($left, $right, $key) {
    $result = [];

    while (!empty($left) && !empty($right)) {
        if ($left[0]->$key <= $right[0]->$key) {
            $result[] = array_shift($left);
        } else {
            $result[] = array_shift($right);
        }
    }

    return array_merge($result, $left, $right);
}
