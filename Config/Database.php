<?php


class Database
{
    function getPDO()
    {
        $user = "root";
        $pass = "";
        try {
            $db = new PDO("mysql:host=localhost;dbname=chat_ajax;chartset=utf8;", $user, $pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (PDOException $e) {
            echo "<p class='notification is-danger'>Errereur de connexion à PDO MySQL</p>" . $e->getMessage();
        }

    }
}