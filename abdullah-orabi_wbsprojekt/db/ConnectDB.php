<?php


function connectToDatabase()
{
  $host = "localhost";
  $port = 3306;
  $charset = "utf8mb4";
  $dbName = "smartziel";
  $username = "root";
  $password = "";

  $dsn = "mysql:host=$host; dbname=$dbName; charset=$charset;port=$port";

  $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ];


    $db = new PDO($dsn, $username, $password, $options);
    return $db;
}