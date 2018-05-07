<?php

$page_data = file_get_contents('../labSeven_basket.html');

$result = '';

if (isset($_COOKIE['things'])) {
    foreach ($_COOKIE['things'] as $value) {
        $result = $result . htmlspecialchars($value) . "<br>";
    }
} else{
    $result = 'Empty...';
}

$page_data = preg_replace("/{ORDER}/U", $result, $page_data);

echo $page_data;