<?php
session_start();
include "BlogClass.php";
$blog = new BlogClass();
if(isset($_POST["log_name"])){
    $log_name = $_POST["log_name"];
}
if(isset($_POST["log_email"])){
    $log_email = $_POST["log_email"];
}
if(isset($_POST["login"])){
    $login = $_POST["login"];
};

    $res = $blog->ses($log_name, $log_email);
    if ($res < 1) {
        $row = mysqli_fetch_array($res);
        $_SESSION['id'] = $row['user_id'];
        $_SESSION['user_name'] = $log_name;
        $_SESSION['user_email'] = $log_email;
        echo"Авторизация прошла успешно, можете оставить новость перейдя на вкладку <u>Оставить сообщение</u> или нажав <a href = 'Post.php'>Здесь</a>";
        } else {
            echo "Неправильный логин или пароль. Возможно вы не зарегистрированы, для регистрации перейдите на вкладку <u>Регистрация</u> или нажмите <a href = 'Registration.php'>здесь</a> для регистрации";
    };