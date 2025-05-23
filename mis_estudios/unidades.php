<?php
require_once 'app/Configuracion.php';

if((isset($_GET['asignatura']) && is_numeric($_GET['asignatura']))){
    $_SESSION['asignatura'] = $_GET['asignatura'];
} else if (!isset($_SESSION['asignatura'])){
    header('Location: index.php');
}

if(isset($_GET['clave']) && $_GET['operacion'] == 'eliminar'){
    $u = new Unidad();
    $u->setClave($_GET['clave']);
    $u->eliminar();
    unset($u);
}

$asignatura = new Asignatura();
$asignatura->setCodigo($_SESSION['asignatura']);

if($asignatura->validarCodigo()){
    unset($_SESSION['asignatura']);
    header('Location: index.php');
}

$asignatura->obtenerDetalles();

if(isset($_POST['unidades'])){
    foreach ($_POST['unidades'] as $u){
        $unidad = new Unidad();
        $unidad->setNombre($u['nombre']);
        $unidad->setPorcentaje($u['porcentaje']);
        $unidad->setNumero($u['numero']);
        $unidad->setAsignatura($asignatura->obtenerCodigo());
        if(isset($u['clave'])){
            //La unidad ya existe
            $unidad->setClave($u['clave']);
            if(!$unidad->actualizar()){
                echo "Error al actualizar la unidad";
            }
        } else if (!empty($unidad->numero) && !empty($unidad->nombre) && !empty($unidad->porcentaje)){
            //La unidad todavía no existe
            if(!$unidad->crear()){
                echo "Error al crear la unidad";
            }
        }
    }
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
        <div class="alineado-izq">
            <a href="index.php">< Volver</a>
        </div>
        <div class="centrado">
            <h2>Asignatura <?php echo $asignatura->obtenerCodigo().': '.$asignatura->obtenerNombre(); ?></h2>
            <h1><img src="img/tarta.png"/>UNIDADES</h1>
        </div>
        <div class="centrado">
            <form method="post" action="">
                <table>
                    <tr>
                        <th></th>
                        <th>Núm</th>
                        <th>Nombre</th>
                        <th>Peso (%)</th>
                    </tr>
                    <?php $asignatura->mostrarUnidades(); ?>
                </table>
                <input type="submit" value="Guardar cambios"/>
                <input type="reset" value="Descartar cambios"/>
            </form>
        </div>
    </body>
</html>
