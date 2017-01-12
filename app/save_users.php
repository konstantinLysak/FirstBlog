<?php
$name = $blog->clearStr(($_POST['user_name']));
$age = $blog->clearInt($_POST['user_age']);
$email = $blog->clearStr($_POST['user_email']);
$pwd = $blog->clearPWD(($_POST['user_pwd']));

if(empty($name) || empty($email) || empty($pwd)){
    echo "<h3>Заполните все поля формы!!</h3>";
}else {
    if (!$blog->saveUsers($name, $age, $email, $pwd)) {
        echo "<h3>Форма не отправлена!</h3>";
    } else {
        header('Location: Post.php');
        exit;
    };
};