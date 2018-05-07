<?php


if(isset($_POST['things']) && isset($_POST['num'])){
    $things = $_POST['things'];
    $count = $_POST['num'];

    if (isset($_COOKIE['things'])) {
        foreach ($_COOKIE['things'] as $value) {
            $things[] = $value;
        }
    }
    

    for ($i=0; $i < count($things); $i++) { 
        if(strpos($things[$i], ' ') === false){
            setcookie("things[$i]", "$things[$i] "."$count", time()+3600);
        }else{
            setcookie("things[$i]", "$things[$i]", time()+3600);
        }
        
    }
} else{
    echo "Nothing is got";
}

header("Location: ../labSeven.html");