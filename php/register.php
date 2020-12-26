<?php
require('../connection.php');
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$name = trim($_POST['name']);
$last_name = trim($_POST['last_name']);
$admin = trim($_POST['admin']);

if (!(empty($email) && !empty($password) && !empty($name) && !empty($last_name))) {
    $result = $link->prepare("SELECT 'email', 'password' FROM users WHERE 'email'=:email");
//    $params = [':email' => $email, ':password' => $password];
//    $result->execute($params);
    if ($result->rowCount() > 0) {
        while ($res = $result->fetch(PDO::FETCH_ASSOC)) {
            if ($res['email'] === $email) {
                echo 'Такой email уже используется';
            }
        }
    } else {
        $sql = 'INSERT INTO users(`email`, `password`, `name`, `last_name`, `admin`) VALUES(:email, :password, :name, :last_name, :admin )';
        $params = [':email' => $email, ':password' => $password, 'name' => $name, ':last_name' => $last_name, ':admin'=> $admin];
        $stmt = $link->prepare($sql);
        $stmt->execute($params);
        session_start();
        $_SESSION["profile"] = $link->lastInsertId();
        header('Location: ../php/my_article.php');
    }
} else {
    echo 'Не все поля заполнены <a href="../index.php">вернитесь и попробуйте снова</a>';
}




