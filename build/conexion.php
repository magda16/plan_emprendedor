<?php
$servidor ="mysql:dbname=plan_emprendedores_db;host=127.0.0.1";
$usuario ="root";
//$password="root123456";
$password="";

try {
    $pdo = new PDO($servidor,$usuario,$password);
    //echo "conectado";
} catch (PDOException $e) {
    echo "Conexion mala :( ".$e->getMessage(); 
}
?>