<?php   
    require_once("connect.php");

    $dsn = "mysql:host=${DB_HOST};dbname=${DB_NAME}";

    try {
        $pdo = new PDO($dsn, $DB_USER, $DB_PASS);
    } catch (PDOExeption $e){
        echo $e->getMessage();
        exit;
    }

?>