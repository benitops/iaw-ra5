<?php
require_once 'app/Configuracion.php';

if((isset($_GET['asignatura']) && is_numeric($_GET['asignatura']))){
    $_SESSION['asignatura'] = $_GET['asignatura'];
} else if (!isset($_SESSION['asignatura'])){
    header('Location: index.php');
}

if(isset($_GET['clave']) && $_GET['operacion'] == 'eliminar'){
    $ins = new Instrumento();
    $ins->setClave($_GET['clave']);
    $ins->eliminar();
    unset($ins);
}

$asignatura = new Asignatura();
$asignatura->setCodigo($_SESSION['asignatura']);

if($asignatura->validarCodigo()){
    unset($_SESSION['asignatura']);
    header('Location: index.php');
}

$asignatura->obtenerDetalles();

if(isset($_POST['instrumentos'])){
    foreach ($_POST['instrumentos'] as $i){

        if (!empty($i['unidad']) && !empty($i['nombre']) && !empty($i['peso'])){
            $ins = new Instrumento();
            $ins->setUnidad($i['unidad']);
            $ins->setNombre($i['nombre']);
            $ins->setPeso($i['peso']);

            if(!strlen($i['calificacion'])){
                $ins->setCalificacion(NULL);
            } else {
                $ins->setCalificacion($i['calificacion']);
            }

            if(isset($i['clave'])){
                $ins->setClave($i['clave']);
                if(!$ins->actualizar()){
                    echo "Error al actualizar el instrumento";
                    exit();
                }
            } else {
                if (!$ins->crear()){
                    echo "Error al crear el instrumento";
                    exit();
                }
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
        <div class="centrado">
            <h1>Asignatura <?php echo $asignatura->obtenerCodigo().': '.$asignatura->obtenerNombre(); ?></h1>
        </div>
        <div class="centrado">
            <form method="post" action="">
                <table>
                    <tr>
                        <th></th>
                        <th>Unidad</th>
                        <th>Nombre del Instrumento</th>
                        <th>Peso (%)</th>
                        <th>Calificación</th>
                    </tr>
                    <?php $asignatura->mostrarInstrumentos(); ?>
                </table>
                <input type="submit" value="Guardar cambios"/>
                <input type="reset" value="Descartar cambios"/>
            </form>
        </div>
    </body>
</html>
