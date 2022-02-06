<?php
require_once 'app/Configuracion.php';
if(!isset($_GET['asignatura']) || !is_numeric($_GET['asignatura'])){
    header('Location: index.php');
}
$asignatura = new Asignatura();
$asignatura->setCodigo($_GET['asignatura']);
$asignatura->obtenerDetalles();

if(isset($_POST['unidades'])){
    foreach ($_POST['unidades'] as $u){
        $unidad = new Unidad();
    }

}

if(isset($_GET['asignatura']) && $_GET['operacion'] == 'eliminar'){
    $a = new Asignatura();
    $a->setCodigo($_GET['asignatura']);
    $a->eliminar();
    unset($a);
}

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
                <th>Núm</th>
                <th>Nombre</th>
                <th>Peso</th>
            </tr>
            <?php $asignatura->obtenerUnidades(); ?>
        </table>
        <input type="submit" value="Guardar cambios"/>
    </form>
</div>
</body>
</html>
