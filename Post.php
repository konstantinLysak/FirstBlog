<?php
include "app/session.php";
session_start();
$tittle = $blog->clearStr(($_POST['tittle']));
$text = $blog->clearStr($_POST['text']);
$date = date("Y-m-d H:i:s");
$user_id = $_SESSION['id'];
print_r($user_id);

if ($_POST['Go']){
    if (empty($tittle) || empty($text)) {
        echo "<h3>Заполните все поля формы!!</h3>";
    } else {
        if (!$blog->savePosts($tittle, $text, $date, $user_id) || empty($user_id)) {
            echo "Вы не можете оставить сообщение. Возможно вы не авторизованы, для авторизации нажмите <a href ='About.php'>Здесь</a>";
        } else {
            header('Location: AllPosts.php');
            exit;
        };
    };
};
include "index.php";
?>
<div class="reg_form">
    <form method="POST" name="post_form">
        <h3>Оставить сообщение</h3>
        <p>Заголовок</p>
        <input type="text" name="tittle">
        <p>Текст новости</p>
        <textarea cols="40" rows="10" name="text"></textarea>
        <input type="hidden" name="date" value="<?php echo date("Y-m-d H:i:s");?>">
        <input type="hidden" name="user_id" value ="<?php print_r($user_id);?>">
        <input type="submit" name="Go" value="Опубликовать">
    </form>
</div>

