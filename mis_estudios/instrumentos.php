<?php

require_once 'app/Configuracion.php';
session_start();

if((isset($_GET['asignatura']) && is_numeric($_GET['asignatura']))){
    $_SESSION['asignatura'] = $_GET['asignatura'];
} else if (!isset($_SESSION['asignatura'])){
    header('Location: index.php');
}

if(isset($_GET['clave']) && $_GET['operacion'] == 'eliminar'){
    //$u = new Instrumento();
    //$u->setClave($_GET['clave']);
    //$u->eliminar();
    unset($u);
}

$asignatura = new Asignatura();
$asignatura->setCodigo($_SESSION['asignatura']);
$asignatura->obtenerDetalles();

?>
<html lang="es">
<head>
    <title>Unidades - Mis Estudios</title>
    <meta charset="UTF-8">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
    </style>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<div class="encabezado centrado">
    <h1>Asignatura <?php echo $asignatura->obtenerCodigo().': '.$asignatura->obtenerNombre(); ?></h1>
</div>
<div class="contenido">
    <form method="post" action="">
        <table>
            <tr>
                <th></th>
                <th>Unidad</th>
                <th>Nombre del Instrumento</th>
                <th>Peso</th>
                <th>Calificación</th>
            </tr>
            <?php $asignatura->mostrarInstrumentos(); ?>
        </table>
        <input type="submit" value="Guardar cambios"/>
    </form>
</div>
</body>
</html>
