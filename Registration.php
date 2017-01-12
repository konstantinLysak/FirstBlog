<?php
include "app/BlogClass.php";
$blog = new BlogClass();
if($_SERVER["REQUEST_METHOD"]=="POST") {
    require "app/save_users.php";
};
include "index.php";
?>
<div class="left">
    <div class="reg_form" xmlns="http://www.w3.org/1999/html">
        <form method="POST" name="reg_form">
            <h3>Зарегистрируйтесть</h3>
            <p>Введите имя</p>
            <input type="text" name="user_name">
            <p>Введите возвраст</p>
            <input type="text" name="user_age">
            <p>Введите email</p>
            <input type="email" name="user_email">
            <p>Введите пароль</p>
            <input type="text" name="user_pwd">
            <input type="submit" name="Reg" value="Зарегистрироваться">
        </form>
    </div>
    </div>
<div class="right">
    <?php
    $all_users = $blog->getUsers();
    mysqli_fetch_assoc($all_users);
    ?>
    <h3>Список юзеров</h3>
    <?php
    while($row = mysqli_fetch_assoc($all_users))
    {?>
        <p>Номер:<?php echo $row['user_id'];?>
        <?php echo $row['user_name'];?>
        <?php echo $row['user_email'];?></p>
    <?php } ?>
</div>

