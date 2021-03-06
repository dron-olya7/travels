<?php
function connect(
    $host = 'localhost',
    $user = 'root',
    $pass = 'dron0702',
    $dbname = 'travelsdb'
)
{
    $link = mysqli_connect($host, $user, $pass) or die('conection error');
    mysqli_select_db($link, $dbname) or die('DB open error');
    mysqli_query($link, "set names 'utf8'");
    return $link;
}

function register($login, $pass, $email)
{
    $login = trim(htmlspecialchars($login));
    $pass = trim(htmlspecialchars($pass));
    $email = trim(htmlspecialchars($email));

    if($login == "" || $pass == "" || $email == ""){
        echo "<h3><span style='color: red;'>Fill all requiretd fields! </span></h3>";
        return false;
    }

    if (strlen($login) < 3 || strlen($login) > 30 || strlen($pass) < 3 || strlen($pass) > 30){
        echo "<h3><span style='color: red;'>Values length must be between 3 and 30</span></h3>";
        return false;
    }

    $queryInsertUser = 'INSERT INTO users (login, pass, email, roleid) values ("'.$login.'","'.md5($pass).'","'.$email.'", 2)';
    $link = connect();
    mysqli_query($link, $queryInsertUser);
    $error = mysqli_errno($link);
    if ($error) {
        if($error == 1062){
            echo "<h3><span style='color: red;'>This login is already taken</span></h3>";
        } else {
            echo "<h3><span style='color: red;'>Error code : {$error}!</span></h3>";
        }
        return false;
    }
    return true;
}