<?php


function connectionDB()
{
    try {

        $serverName = 'localhost';
        $userName = 'root';
        $password = '';
        $bd = 'tp2_web_2';

        $conn = new PDO("mysql:host=$serverName;dbname=$bd", $userName, $password);
        return $conn;
    } catch (Exception $e) {
        die($e->getMessage());
    }
}
