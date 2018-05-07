<?php

if ((htmlspecialchars($_POST['login']) === "") || (htmlspecialchars($_POST['pass']) === "") || (htmlspecialchars($_POST['confirm']) === "")) {
    echo "Введите все данные, пожалуйста.";
} else {
    $pass = htmlspecialchars($_POST['pass']);
    $confirm = htmlspecialchars($_POST['confirm']);

    if ($pass !== $confirm){
        echo "Пароли не совпадают";
    } else {
        $host = 'localhost'; // адрес сервера 
        $database = 'users'; // имя базы данных
        $user = 'root'; // имя пользователя
        $password = ''; // пароль

        $link = mysqli_connect($host, $user, $password, $database) 
            or die("Ошибка " . mysqli_error($link));

        $login = htmlentities(mysqli_real_escape_string($link, $_POST['login']));
        $pass = htmlentities(mysqli_real_escape_string($link, $_POST['pass']));

        $query ="SELECT * FROM users_info";

        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
        if($result){
            $rows = mysqli_num_rows($result); // количество полученных строк
            for ($i = 0 ; $i < $rows ; ++$i)
            {
                $row = mysqli_fetch_row($result);
                if($row[0] === $login){
                    $pass = sha1($pass);

                    $query ="UPDATE users_info SET login='$login', pass='$pass' WHERE login='$login'";
                    $result1 = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
                
                    if($result1)
                        echo "Данные обновлены<br>";
                }

            }
            // очищаем результат
            mysqli_free_result($result);
        }

        
            
        mysqli_close($link);
    }

    
}