<?php

function is_email($email){
    if(preg_match('/^((([0-9A-Za-z]{1}[-0-9A-z\.]{1,}[0-9A-Za-z]{1})|([0-9А-Яа-я]{1}[-0-9А-я\.]{1,}[0-9А-Яа-я]{1}))@([-0-9A-Za-z]{1,}\.){1,2}[-A-Za-z]{2,})$/u' ,$email)){
        return true;
    }
    return false;
}

if(isset($_POST['email'])){
    $file = 'emailsBase.txt';
    $email = trim(htmlspecialchars($_POST['email']));
    $emailsList = file($file, FILE_IGNORE_NEW_LINES);
    if(is_email($email)){
        if(array_search($email, $emailsList) !== FALSE){
            unset($emailsList[array_search($email, $emailsList)]);
            file_put_contents($file, '');
            foreach ($emailsList as $value) {
                file_put_contents($file, $value.PHP_EOL, FILE_APPEND);
            }
            echo "You're successful unsubscribe";
        }else{
            echo "You aren't subscribed";
        }
        
    }else{
        echo "Incorrect Email!";
    }
    
}else{
    echo "Something wrong...";
}


