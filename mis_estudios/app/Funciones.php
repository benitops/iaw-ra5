<?php
/**
 * Obtenemos todas las asignaturas
 * @return bool|array|string
 */
function obtenerAsignaturas(): bool|array|string
{
    global $db;
    $query = "SELECT * FROM asignaturas";
    $consulta = $db->prepare($query);

    if ($consulta->execute()){
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } else {
        return "Ha habido un error al realizar la consulta";
        exit();
    }
}

/**
 * Renderizamos el código HTML formateado para crear filas por cada asignatura y para añadir una nueva.
 * @return void
 */
function mostrarAsignaturas(){
    $asignaturas = obtenerAsignaturas();
    if ($asignaturas){
        $i = 1;
        foreach ($asignaturas AS $asignatura){
            ?>
            <tr>
                <td><input type="hidden" name="asignatura[<?php echo $i; ?>][id]" value="<?php echo $asignatura['codigo'] ?>" /></td>
                <td><input type="text" name="asignatura[<?php echo $i; ?>][codigo]" value="<?php echo $asignatura['codigo'] ?>" /></td>
                <td><input type="text" name="asignatura[<?php echo $i; ?>][nombre]" value="<?php echo $asignatura['nombre'] ?>" /></td>
                <td><input type="number" name="asignatura[<?php echo $i; ?>][horas_semana]" value="<?php echo $asignatura['horas_semana'] ?>" /></td>
                <td><input type="profesor" name="asignatura[<?php echo $i; ?>][profesor]" value="<?php echo $asignatura['profesor'] ?>" /></td>
                <td><a href="?operacion=eliminar&asignatura=<?php echo $asignatura['codigo'] ?>"><img src="img/remove32.png"></a></td>
                <td><a href="unidades.php?asignatura=<?php echo $asignatura['codigo'] ?>"><img src="img/tarta.png"></a></td>
                <td><a href="instrumentos.php?asignatura=<?php echo $asignatura['codigo'] ?>"><img src="img/smile.png"></a></td>
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

/**
 * Muestra el cálculo de las notas medias de cada asignatura
 * @return void
 */
function mostrarAsignaturasNotas(){
    $asignaturas = obtenerAsignaturas();
    if ($asignaturas){
        $i = 1;
        foreach ($asignaturas AS $a){
            $asignatura = new Asignatura();
            $asignatura->setCodigo($a['codigo']);
            ?>
            <tr>
                <td><input disabled type="text" name="expediente[<?php echo $i; ?>][id]" value="<?php echo $a['codigo'] ?>" /></td>
                <td><input style="width:50%;" disabled type="text" name="expediente[<?php echo $i; ?>][nombre]" value="<?php echo $a['nombre'] ?>" /></td>
                <td><input disabled type="text" name="expediente[<?php echo $i; ?>][notaMedia]" value="<?php echo $asignatura->obtenerNotaMedia(); ?>" /></td>
            </tr>
            <?php
            $i++;
        }
    }
}