<?php
include "index.php";
include "app/BlogClass.php";
$blog = new BlogClass();
$all_news = $blog->getPosts();
$row = mysqli_fetch_assoc($all_news);
    while($row = mysqli_fetch_assoc($all_news))
        {?>
            <div>
             <h3>Заголовок:<?php echo $row['tittle'];?></h3>
             <p><?php echo $row['text'];?></p>
             <small>Автор:<?php echo $row['user_name'];?></small>
             <small>Дата публикации:<?php echo $row['date'];?></small>
             <hr>
             </div>
<?php };?>