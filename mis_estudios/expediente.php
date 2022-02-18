<?php
require_once 'app/Configuracion.php';

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
        <div class="centrado">
            <h1><img src="img/birrete.png"/> EXPEDIENTE</h1>
        </div>
        <div class="centrado">
            <form>
                <table>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Nota media</th>
                    </tr>
                    <?php mostrarAsignaturasNotas(); ?>
                </table>
            </form>
        </div>
    </body>
</html>
