<?php

function autocompleteDivideConquer($words, $prefix) {
    if (empty($words)) return [];

    $mid = floor(count($words) / 2);
    $midWord = $words[$mid];

    if (str_starts_with($midWord, $prefix)) {
        // Cari ke kiri dan kanan
        $left = autocompleteDivideConquer(array_slice($words, 0, $mid), $prefix);
        $right = autocompleteDivideConquer(array_slice($words, $mid + 1), $prefix);
        return array_merge($left, [$midWord], $right);
    } elseif ($midWord < $prefix) {
        return autocompleteDivideConquer(array_slice($words, $mid + 1), $prefix);
    } else {
        return autocompleteDivideConquer(array_slice($words, 0, $mid), $prefix);
    }
}
function mergeSortBy($array, $key, $asc = true) {
    if (count($array) <= 1) return $array;
    $mid = floor(count($array) / 2);
    $left = mergeSortBy(array_slice($array, 0, $mid), $key, $asc);
    $right = mergeSortBy(array_slice($array, $mid), $key, $asc);
    return merge($left, $right, $key, $asc);
}

function merge($left, $right, $key, $asc) {
    $result = [];
    while (!empty($left) && !empty($right)) {
        $cond = $asc ? $left[0][$key] <= $right[0][$key] : $left[0][$key] >= $right[0][$key];
        $result[] = $cond ? array_shift($left) : array_shift($right);
    }
    return array_merge($result, $left, $right);
}

?>
