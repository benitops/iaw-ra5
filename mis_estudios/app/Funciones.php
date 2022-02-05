<?php

function getAsignaturas(){
    global $db;
    $query = "SELECT * FROM asignaturas";

    $consulta = $db->prepare($query);

    if ($consulta->execute()){
        $i = 1;
        foreach ($consulta->fetchAll(PDO::FETCH_ASSOC) AS $asignatura){
            ?>
            <tr>
                <td><input type="hidden" name="<?php echo $i; ?>_id" value="<?php echo $asignatura['codigo'] ?>" /></td>
                <td><input type="text" name="<?php echo $i; ?>_codigo" value="<?php echo $asignatura['codigo'] ?>" /></td>
                <td><input type="text" name="<?php echo $i; ?>_nombre" value="<?php echo $asignatura['nombre'] ?>" /></td>
                <td><input type="number" name="<?php echo $i; ?>_horas_semana" value="<?php echo $asignatura['horas_semana'] ?>" /></td>
                <td><input type="profesor" name="<?php echo $i; ?>_profesor" value="<?php echo $asignatura['profesor'] ?>" /></td>
                <td><a href="?operacion=eliminar&asignatura=<?php ?>"><img src="img/remove32.png"></a></td>
                <td><a href="unidades.php?asignatura=<?php ?>"><img src="img/tarta.png"></a></td>
                <td><a href="instrumentos.php?asignatura=<?php ?>"><img src="img/smile.png"></a></td>
                <td><a href="expediente.php"><img src="img/birrete.png"></a></td>
            </tr>
            <?php
            $i++;
        }
        ?>
        <tr>
            <td></td>
            <td><input type="text" name="<?php echo $i; ?>_codigo" value="" /></td>
            <td><input type="text" name="<?php echo $i; ?>_nombre" value="" /></td>
            <td><input type="number" name="<?php echo $i; ?>_horas_semana" value="" /></td>
            <td><input type="profesor" name="<?php echo $i; ?>_profesor" value="" /></td>
        </tr>
        <?php

    }

}