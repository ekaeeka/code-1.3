<?php
session_start();

require('connection.php');

$email = $_POST['email'];
$password = $_POST['password'];
$result = $link->prepare("SELECT `email`, `password`, `name`, `admin` FROM users WHERE `email` = :email");
$params = [':email' => $email];
$result->execute($params);
if ($result->rowCount() > 0) {
    while ($res = $result->fetch(PDO::FETCH_ASSOC)) {
        if ($res['admin'] == '0') {
            if ($res['password'] === $password) {

                $_SESSION['profile'] = $res['email'];
                header('Location: index.php');
            }

        } else if ($res['admin'] == '1') {
            if ($res['password'] === $password) {

                $_SESSION['profile'] = $res['admin'];
                header('Location: ../AdminPanel/admin.php');
            }

        } else {
            echo '
    <h2>Логин не существует</h2>';
        }
    }
}
