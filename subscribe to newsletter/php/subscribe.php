<?php

function is_email($email){
    if(preg_match('/^((([0-9A-Za-z]{1}[-0-9A-z\.]{1,}[0-9A-Za-z]{1})|([0-9А-Яа-я]{1}[-0-9А-я\.]{1,}[0-9А-Яа-я]{1}))@([-0-9A-Za-z]{1,}\.){1,2}[-A-Za-z]{2,})$/u' ,$email)){
        return true;
    }
    return false;
}

function is_subscribe($email, $list){
    if(array_search($email, $list) !== FALSE){
        return true;
    }
    return false;
}

if(!isset($_POST['email'])){
    echo "Something wrong!";
} else{
    $email = trim(htmlspecialchars($_POST['email']));
    $emailFile = 'emailsBase.txt';
    

    if(is_file($emailFile)){
        $emailList = file($emailFile, FILE_IGNORE_NEW_LINES);
        if(is_email($email)){
            if(!is_subscribe($email, $emailList)){
                file_put_contents($emailFile, $email.PHP_EOL, FILE_APPEND);
                echo "Successfuly subscribe";
            } else{
                header("Location: ../subscribed.html");
            }
        }else{
            echo "Incorrect email";
        }
    }
    
}