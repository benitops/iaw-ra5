<?php
require_once 'app/Configuracion.php';

if (isset($_POST)){
    for ($i = 1; $i <= substr(array_key_last($_POST), 0, 1); $i++ ){
        $a = new Asignatura();
        $a->setNombre($_POST[$i.'_nombre']);
        $a->setHorasSemana(intval($_POST[$i.'_horas_semana']));
        $a->setProfesor($_POST[$i.'_profesor']);

        if (!isset($_POST[$i.'_id']) && $_POST[$i.'_codigo'] !== 0){
            $a->setCodigo(intval($_POST[$i.'_codigo']));
            if (!$a->crear()){
                echo "Error al actualizar los datos";
                exit();
            }
        } else {
            $a->setCodigo(intval($_POST[$i.'_id']));
            if ($a->actualizar()){
                if ($_POST[$i.'_id'] !== $_POST[$i.'_codigo']){
                    if(!$a->actualizarCodigo(intval($_POST[$i.'_codigo']))){
                        echo "Error al actualizar los datos.";
                        exit();
                    }
                }
            } else {
                echo "Error al actualizar los datos";
                exit();
            }
        }
    }
}


?>
<html lang="es">
<head>
    <title>Asignaturas - Mis Estudios</title>
    <meta charset="UTF-8">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
    </style>
    <link rel="stylesheet" href="estilos.css">
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
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Horas/Sem</th>
                <th>Profesor</th>
            </tr>
            <?php getAsignaturas(); ?>
        </table>
        <input type="submit" value="Guardar cambios"/>
    </form>
</div>
</body>
</html>