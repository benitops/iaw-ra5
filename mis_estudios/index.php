<?php
require_once 'app/Configuracion.php';

if(isset($_POST['asignatura'])){
    foreach ($_POST['asignatura'] as $a){
        $asignatura = new Asignatura();
        $asignatura->setNombre($a['nombre']);
        $asignatura->setProfesor($a['profesor']);
        $asignatura->setHorasSemana($a['horas_semana']);
        if(isset($a['id'])){
            $asignatura->setCodigo($a['id']);
            $asignatura->actualizar();
            if ($a['id'] !== $a['codigo']){
                $asignatura->actualizarCodigo($a['codigo']);
            }
        } else if (strlen($a['codigo'] >= 1)){
            $asignatura->setCodigo($a['codigo']);
            $asignatura->crear();
        }
    }
}
if(isset($_GET['asignatura']) && $_GET['operacion'] == 'eliminar'){
    $a = new Asignatura();
    $a->setCodigo($_GET['asignatura']);
    $a->eliminar();
    unset($a);
}

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Asignaturas - Mis Estudios</title>

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
        </style>
    </head>
    <body>
        <div class="encabezado centrado">
            <h1>ASIGNATURAS</h1>
        </div>
        <div class="contenido">
            <form method="post" action="">
                <table>
                    <tr>
                        <th></th>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Horas/Sem</th>
                        <th>Profesor</th>
                    </tr>
                    <?php mostrarAsignaturas(); ?>
                </table>
                <input type="submit" value="Guardar cambios"/>
            </form>
        </div>
    </body>
</html>