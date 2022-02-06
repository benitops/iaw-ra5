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
                <td><input type="hidden" name="asignatura[<?php echo $i; ?>][id]" value="<?php echo $asignatura['codigo'] ?>" /></td>
                <td><input type="text" name="asignatura[<?php echo $i; ?>][codigo]" value="<?php echo $asignatura['codigo'] ?>" /></td>
                <td><input type="text" name="asignatura[<?php echo $i; ?>][nombre]" value="<?php echo $asignatura['nombre'] ?>" /></td>
                <td><input type="number" name="asignatura[<?php echo $i; ?>][horas_semana]" value="<?php echo $asignatura['horas_semana'] ?>" /></td>
                <td><input type="profesor" name="asignatura[<?php echo $i; ?>][profesor]" value="<?php echo $asignatura['profesor'] ?>" /></td>
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
            <td><input type="text" name="asignatura[<?php echo $i; ?>][codigo]" value="" /></td>
            <td><input type="text" name="asignatura[<?php echo $i; ?>][nombre]" value="" /></td>
            <td><input type="number" name="asignatura[<?php echo $i; ?>][horas_semana]" value="" /></td>
            <td><input type="profesor" name="asignatura[<?php echo $i; ?>][profesor]" value="" /></td>
        </tr>
        <?php

    }

}