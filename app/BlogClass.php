<?php
include_once "Ablog.php";
class BlogClass implements Ablog
{
    const HOST = "localhost";
    const USER = "root";
    const PWD = "";
    const DB_NAME = "DB_blog";
    private $_db;

    function __get($name)
    {
        if($name == "db");
        return $this->_db;
        throw new Exception("Ошибка!");
    }
    function __construct()
    {   $this->_db = new mysqli(self::HOST, self::USER, self::PWD)
        or die("нет соеденения");
        $sql = "CREATE DATABASE DB_blog";
        $this ->_db->query($sql);
        $this->_db = new mysqli(self::HOST, self::USER, self::PWD, self::DB_NAME)
        or die("БД не создана");
        $this->_db->select_db(self::DB_NAME) or die("БД не выбрана");
        $sql_users = "CREATE TABLE `users`( 
                `user_id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
                `user_name` VARCHAR (20) NOT NULL,
                `user_age` INT (100) NOT NULL,
                `user_email` VARCHAR (20) NOT NULL,
                `user_pwd` INT NOT NULL
                                      )ENGINE=InnoDB CHARACTER SET=UTF8";
        $this->_db->query($sql_users);

        $sql_news = "CREATE TABLE `news`(
                `news_id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
                `tittle` VARCHAR (20) NOT NULL,
                `text` TEXT NOT NULL,
                `date` DATETIME NOT NULL,
                `user_id` INT NOT NULL,
                 FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) 
                 ON UPDATE CASCADE 
                 ON DELETE RESTRICT
                 )ENGINE=InnoDB CHARACTER SET=UTF8";

        $this->_db->query($sql_news);
    }
    function saveUsers($name, $age, $email, $pwd)
    {
        $sql_save_users = "INSERT INTO users
                          (user_name, user_age, user_email, user_pwd)
                          VALUES ('$name', '$age', '$email', '$pwd')";
        return $this->_db->query($sql_save_users);
    }
    function savePosts($tittle, $text, $date, $user_id)
    {
        $sql_save_posts = "INSERT INTO news
                          (tittle, text, date, user_id )
                          VALUES ('$tittle', '$text', '$date', '$user_id')";
        return $this->_db->query($sql_save_posts);
    }
    function getPosts()
    {
        $mysql_get_posts = "SELECT * FROM users, news WHERE users.user_id = news.user_id ORDER BY date DESC ";
        return $this->_db->query($mysql_get_posts);
    }
    function getUsers(){
        $mysql_get_users = "SELECT * FROM users ORDER BY user_id DESC";
        return $this->_db->query($mysql_get_users);
    }
    function clearStr($val)
    {
        return trim(strip_tags($val));
    }
    function clearInt($val)
    {
        return abs((int)$val);
    }
    function clearPWD($val)
    {
        return md5($val);
    }
    function ses($log_name, $log_email){
        $sql = "SELECT * FROM users WHERE user_name = '$log_name' AND user_email = '$log_email'";
        return $this->_db->query($sql);
    }
    function __destruct()
    {
        unset($this->_db);
    }


}