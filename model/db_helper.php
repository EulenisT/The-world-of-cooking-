<?php
/**
 * connexion à la base 4ipdw_tarazona
 * on retourne l'objet PDO
 */

function db_connect(){

    static $pdo;

    if( ! isset($pdo))
    {
        //premier appel
        $dsn = "mysql:host=localhost;dbname=4ipdw_tarazona;port=3306;charset=utf8mb4";
        $pdo = new PDO($dsn, "root", "");
    }

    return $pdo;
}


