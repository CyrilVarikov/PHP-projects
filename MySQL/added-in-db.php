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

        $user_info = "CREATE TABLE IF NOT EXISTS users_info
        (
            login VARCHAR(200) NOT NULL PRIMARY KEY,
            pass VARCHAR(255) NOT NULL
        )";


        $result = mysqli_query($link, $user_info) or die("Ошибка " . mysqli_error($link)); 
        if($result){
            echo "Создание/открытие
             таблицы прошло успешно<br>";
            $login = htmlentities(mysqli_real_escape_string($link, $_POST['login']));
            $pass = htmlentities(mysqli_real_escape_string($link, $_POST['pass']));

            $query ="SELECT * FROM users_info";
 
            $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
            if($result){
                $rows = mysqli_num_rows($result); // количество полученных строк
                $isExist = false;
                for ($i = 0 ; $i < $rows ; ++$i)
                {
                    $row = mysqli_fetch_row($result);
                    if($row[0] === $login){
                        $pass = sha1($pass);
                        if($row[1] === $pass){
                            $isExist = true;
                        }else{
                            die("Неверный пароль!<br>");
                            break;
                        }
                    }

                }
                // очищаем результат
                mysqli_free_result($result);
            }

            if($isExist){
                echo "Вы успешно вошли...";
            }else {
                $pass = sha1($pass);
                $query ="INSERT INTO users_info VALUES('$login', '$pass')";
     
                // выполняем запрос
                $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
                if($result)
                {
                    echo "Данные добавлены<br>";
                }
            }
        }
            
        mysqli_close($link);
    }

    
}