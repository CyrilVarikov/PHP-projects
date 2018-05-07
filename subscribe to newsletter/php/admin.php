<?php

$myPassword = '123';

if(isset($_POST['pass'])){
    if(trim(htmlspecialchars($_POST['pass'] === $myPassword))){
        $html = file_get_contents('../send.html');
        $emailList = file("emailsBase.txt", FILE_IGNORE_NEW_LINES);
        $html = preg_replace("/{COUNT}/", count($emailList), $html);
        echo $html;
    }else{
        echo "Wrong password. Try again!";
    }
}else{
    echo 'Something wrong...';
}