<?php
if (empty($_POST['email']) && empty($_POST['password'])) {
    echo "Логин или пароль не верный <a href=\"index.html\"> вернитесь назад</a>";
    $error = 1;
}

if (mb_strlen($_POST['email']) < 15 ){
    echo"Email слишком короткий, <a href=\"index.html\">попробуйте другой </a>";
    $error = 1;
}

if (mb_strlen($_POST['password']) < 4 ){
    echo"Пароль слишком короткий, <a href=\"index.html\">попробуйте другой </a>";
    $error = 1;
}

if(mb_strlen($_POST['name'])<1){
    echo"Имя не введено, <a href=\"index.html\"> заполните все поля </a>";
    $error = 1;
}


if (isset($_POST['email'])) {
    $email = $_POST['email'];
    if ($email == '') {
        unset($email);
    }
}
if (isset($_POST['password'])) {
    $password = $_POST['password'];
    if ($password == '') {
        unset($password);
    }
}

if (empty($email) && empty($password) && empty($name) && empty($last_name)) {
    exit("Вы ввели не всю информацию");
}
$email = stripslashes($email);
$email = htmlspecialchars($email);
$password = stripslashes($password);
$password = htmlspecialchars($password);

$email = trim($email);
$password = trim($password);


if ($error == 0)
{
    include("connection.php");
    $result = mysqli_query("SELECT id FROM users WHERE email= '$email'", $link);

    $myrow=mysqli_fetch_array($result);
    if (!empty($myrow ['id'])){
        exit("Введенный вами логин уже существует");
    }
    $result2=mysqli_query("INSERT INTO users(email,password,name,last_name) VALUES ('$email' , '$password', '$name', )");

    if ($result2='TRUE'){
        echo"Вы успешно зарегистрированны!";
    }
    else{
        echo "Ошибка! Вы не зарегистрированны";
    }

}


