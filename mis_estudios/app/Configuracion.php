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

$check = $db->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = {$db_name}");
if ($check->fetchColumn()){
    // Existe

} else {
    // No existe

}