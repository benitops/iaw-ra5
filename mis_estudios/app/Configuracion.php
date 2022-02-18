<?php
// DB CREDENCIALES DE USUARIO.
//$db_host = "localhost";
//$db_user = "root";
//$db_pass = "";
//$db_name = "mis_estudios";
// DB PLESK
$db_host = "localhost";
$db_user = "ra5";
$db_pass = "w62cC8p!";

// Ahora, establecemos la conexión.
try {
    // Ejecutamos las variables y aplicamos UTF8
    $db = new PDO("mysql:host=" . $db_host , $db_user, $db_pass);
} catch (PDOException $e) {
    // Si existiera algún problema en la conexión, lo veríamos aquí:
    exit("Error: " . $e->getMessage());
}

// Comprobamos si existe la base de datos

$check = $db->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'bps_mis_estudios'");
if ($check->fetchColumn()){
    // Existe
    $db->query("USE bps_mis_estudios;");
    $db->exec('SET NAMES utf8'); //Establecemos que usaremos caracteres en UTF-8 para no tener problemas con los caracteres especiales
} else {
    $sql = file_get_contents(__DIR__.'/mis_estudios.sql');
    $db->exec($sql);
}

session_start();

require_once 'Unidad.php';
require_once 'Instrumento.php';
require_once 'Asignatura.php';
require_once 'Funciones.php';
