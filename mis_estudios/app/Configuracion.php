<?php
// DB CREDENCIALES DE USUARIO.
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "mis_estudios";

// Ahora, establecemos la conexión.
try {
    // Ejecutamos las variables y aplicamos UTF8
    $db = new PDO("mysql:host=" . $db_host , $db_user, $db_pass);
} catch (PDOException $e) {
    // Si existiera algún problema en la conexión, lo veríamos aquí:
    exit("Error: " . $e->getMessage());
}

// Comprobamos si existe la base de datos

$check = $db->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'mis_estudios'");
if ($check->fetchColumn()){
    // Existe
    $db->query("USE mis_estudios;");
    $db->exec('SET NAMES utf8'); //Establecemos que usaremos caracteres en UTF-8 para no tener problemas con los caracteres especiales
} else {
    //TODO Terminar la creación de tablas si no existen
    //$db->query("");
    echo "Error, no existe la base de datos";
    exit();
}

require_once 'Unidades.php';
require_once 'Instrumentos.php';
require_once 'Asignatura.php';
require_once 'Funciones.php';
