<?php

$page_data = file_get_contents('../labSeven_basket.html');

$result = 'Order is processed';

if (isset($_COOKIE['things'])) {
    foreach($_COOKIE['things'] as $key => $value){
        setcookie("things[$key]", '', time() - 10000);
    } 
    
} else{
    $result = 'Empty...';
}

$page_data = preg_replace("/{ORDER}/U", $result, $page_data);

echo $page_data;

