<?php

interface Ablog
{
    function saveUsers($name, $age, $email, $pwd);
    function savePosts($tittle, $text, $date, $log_id);
    function getPosts();
    function getUsers();

}