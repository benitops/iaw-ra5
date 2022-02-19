<?php

/**
 * Incluimos la configuración general de la aplicación:
 * - Conexión a la base de datos
 * - Variable global $db
 * - Clases
 */
require_once 'app/Configuracion.php';

//Comprueba si se ha enviado el formulario
if(isset($_POST['asignatura'])){
    // En caso de que se haya enviado el formulario, procesa el array
    foreach ($_POST['asignatura'] as $a){
        // Creamos una nueva clase asignatura para cada una de ellas y así establecer sus atributos.
        $asignatura = new Asignatura();
        $asignatura->setNombre($a['nombre']);
        $asignatura->setProfesor($a['profesor']);
        $asignatura->setHorasSemana($a['horas_semana']);

        // Comprobamos si tiene establecida una 'id'.
        // De esta manera, sabemos si es una nueva asignatura.
        // Si es una nueva asignatura, la crea y de lo contrario, la actualiza.

        if(isset($a['id'])){ // Tiene una 'id', por lo tanto existe y se actualiza.
            $asignatura->setCodigo($a['id']);
            $asignatura->actualizar();
            if ($a['id'] !== $a['codigo']){ // Comprobamos si ha habido una modificación en el código de la asignatura
                // Si el código es distinto a la id, se actualiza.
                $asignatura->actualizarCodigo($a['codigo']);
            }
        } else if (strlen($a['codigo'] >= 1)){
            // Esta asignatura es nueva, por lo tanto establecemos el código y la creamos.
            $asignatura->setCodigo($a['codigo']);
            $asignatura->crear();
        }
    }
}

// Comprobamos la URL para ver que acción se quiere realizar.
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
        <link rel="stylesheet" href="estilos.css">
    </head>
    <body>
        <div class="centrado">
            <h1>ASIGNATURAS</h1>
        </div>
        <div class="centrado">
            <form method="post" action="">
                <table>
                    <tr>
                        <th></th>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Horas/Sem</th>
                        <th>Profesor</th>
                    </tr>
                    <?php mostrarAsignaturas(); // Imprimimos la tabla con el formulario ?>
                </table>
                <input type="submit" value="Guardar cambios"/>
                <input type="reset" value="Descartar cambios"/>
            </form>
        </div>
    </body>
</html>