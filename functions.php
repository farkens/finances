<?php

function debug($arr) {
    echo '<pre>' . print_r($arr, true) . '</pre>';
}

function search_array($array, $value, $cost = false) {
    $content = '';
    for ($i = 0; $i <= count($array) - 1; $i++) {
        if (array_search($value, $array[$i])) {
            $content .= "<li class='sortable_item " . ($cost ? 'sortable_item-cost' : 'sortable_item-income') . "' id='{$array[$i]['id']}'" . ($cost ? 'cost="1"' : null) . ">{$array[$i]['name']}<div>{$array[$i]['sum']}</div></li>";
        }
    }
    return $content;
}
