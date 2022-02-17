<?php

class Asignatura
{
    private int         $codigo;
    private string      $nombre;
    private int         $horas_semana;
    private string      $profesor;


    /**
     * @param int|string $codigo
     */
    public function setCodigo(mixed $codigo): void
    {
        $this->codigo = (int)$codigo;
    }

    /**
     * @return int
     */
    public function obtenerCodigo(): int
    {
        return $this->codigo;
    }

    /**
     * @param string $nombre
     */
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return string
     */
    public function obtenerNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @param string|int $horas_semana
     */
    public function setHorasSemana(mixed $horas_semana): void
    {
        $this->horas_semana = (int)$horas_semana;
    }

    /**
     * @param string $profesor
     */
    public function setProfesor(string $profesor): void
    {
        $this->profesor = $profesor;
    }

    public function validarCodigo($codigo){
        global $db;
        $query = "SELECT nombre FROM asignaturas WHERE CODIGO = :codigo;";
        $con = $db->prepare($query);
        $con->bindParam(":codigo", $codigo);
        $con->execute();
        if ($con->rowCount() == 0){
            return true;
        } else {
            return false;
        }
    }

    public function crear()
    {
        // Usamos la variable $db que hemos definido en el archivo de configuración, la cual contiene la conexión a la base de datos.

        if ($this->validarCodigo($this->codigo)) {

            global $db;
            $query = "INSERT INTO mis_estudios.asignaturas (`codigo`, `nombre`, `horas_semana`, `profesor`) VALUES (:codigo, :nombre, :horas_semana, :profesor);";
            $consulta = $db->prepare($query);
            $consulta->bindParam(':codigo', $this->codigo);
            $consulta->bindParam(':nombre', $this->nombre);
            $consulta->bindParam(':horas_semana', $this->horas_semana);
            $consulta->bindParam(':profesor', $this->profesor);

            if ($consulta->execute()) {
                // Si se ejecuta correctamente, devuelve TRUE
                return true;
            } else {
                // Si no se ejecuta correctamente, devuelve FALSE
                return false;
            }

        } else {
            return false;
        }
    }

    public function eliminar(){
        global $db;
        $query = "DELETE FROM mis_estudios.asignaturas WHERE codigo = :codigo;";
        $consulta = $db->prepare($query);
        $consulta->bindParam(':codigo', $this->codigo);

        if($consulta->execute()){
            // Si se ejecuta correctamente, devuelve TRUE
            return true;
        } else {
            // Si no se ejecuta correctamente, devuelve FALSE
            return false;
        }
    }

    public function actualizar(): bool
    {
        global $db;
        $query = "UPDATE mis_estudios.asignaturas t
                    SET t.nombre       = :nombre,
                        t.horas_semana = :horas_semana,
                        t.profesor     = :profesor
                    WHERE t.codigo = :codigo;";
        $consulta = $db->prepare($query);
        $consulta->bindParam(":codigo", $this->codigo);
        $consulta->bindParam(":nombre", $this->nombre);
        $consulta->bindParam(":horas_semana", $this->horas_semana);
        $consulta->bindParam(":profesor", $this->profesor);

        if ($consulta->execute()) {
            // Se ha actualizado correctamente
            return true;
        } else {
            // Ha habido un error al actualizar los datos
            return false;
        }
    }

    public function actualizarCodigo($nuevoCodigo): bool
    {
        if ($this->validarCodigo($nuevoCodigo)){
            global $db;
            $query = "UPDATE mis_estudios.asignaturas t
                    SET t.codigo = :nuevoCodigo
                    WHERE t.codigo = :codigo; ";
            $consulta = $db->prepare($query);
            $consulta->bindParam(":nuevoCodigo", $nuevoCodigo);
            $consulta->bindParam(":codigo", $this->codigo);

            if ($consulta->execute()){
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function obtenerDetalles(){
        global $db;
        $query = "SELECT * FROM asignaturas WHERE codigo = :codigo;";
        $consulta = $db->prepare($query);
        $consulta->bindParam(':codigo', $this->codigo);

        if ($consulta->execute()){
            $datos = $consulta->fetch(PDO::FETCH_ASSOC);
            $this->nombre = $datos['nombre'];
            $this->horas_semana = $datos['horas_semana'];
            $this->profesor = $datos['profesor'];
            return true;
        } else {
            return false;
        }

    }

    public function obtenerUnidades(){
        global $db;
        $query = "SELECT * FROM unidades WHERE asignatura = :codigo;";
        $consulta = $db->prepare($query);
        $consulta->bindParam(':codigo', $this->codigo);
        $consulta->execute();
        return var_dump($consulta->fetchAll(PDO::FETCH_ASSOC));
    }

    public function mostrarUnidades(){
        $unidades = $this->obtenerUnidades();
        var_dump($unidades);
        if ($unidades){
            $i = 1;
            foreach ($unidades AS $unidad){
                ?>
                <tr>
                    <td><input type="hidden" name="unidades[<?php echo $i; ?>][clave]" value="<?php echo $unidad['clave'] ?>" /></td>
                    <td><input type="text" name="unidades[<?php echo $i; ?>][numero]" value="<?php echo $unidad['numero'] ?>" /></td>
                    <td><input type="text" name="unidades[<?php echo $i; ?>][nombre]" value="<?php echo $unidad['nombre'] ?>" /></td>
                    <td><input type="number" name="unidades[<?php echo $i; ?>][porcentaje]" value="<?php echo $unidad['porcentaje'] ?>" /></td>
                    <td><a href="?operacion=eliminar&clave=<?php echo $unidad['clave'] ?>"><img src="img/remove32.png"></a></td>
                </tr>
                <?php
                $i++;
            }
            ?>
            <tr>
                <td></td>
                <td><input type="text" name="unidades[<?php echo $i; ?>][numero]" value="" /></td>
                <td><input type="text" name="unidades[<?php echo $i; ?>][nombre]" value="" /></td>
                <td><input type="number" name="unidades[<?php echo $i; ?>][porcentaje]" value="" /></td>
            </tr>
            <?php
        } else {
            echo "Ha habido un error al ejecutarse la consulta";
        }
    }

    public function obtenerInstrumentos(){
        global $db;
        $query = "SELECT instrumentos.*, unidades.numero, unidades.nombre AS 'unidadesNombre' 
                    FROM instrumentos INNER JOIN unidades on unidades.clave = instrumentos.unidad 
                    WHERE unidades.asignatura = :codigo;";
        $consulta = $db->prepare($query);
        $consulta->bindParam(':codigo', $this->codigo);

        //TODO obtenerInstrumentos() devuelva los datos para la WEB de forma visual.
        if ($consulta->execute()){
            //var_dump($consulta->fetchAll(PDO::FETCH_ASSOC));
            if ($consulta->execute()){
                $i = 1;
                foreach ($consulta->fetchAll(PDO::FETCH_ASSOC) AS $instrumento){
                    ?>
                    <tr>
                        <td><input type="hidden" name="unidades[<?php echo $i; ?>][clave]" value="<?php echo $instrumento['clave'] ?>" /></td>
                        <td><input type="text" name="unidades[<?php echo $i; ?>][numero]" value="<?php echo $instrumento['numero'] ?>" /></td>
                        <td><input type="text" name="unidades[<?php echo $i; ?>][nombre]" value="<?php echo $instrumento['nombre'] ?>" /></td>
                        <td><input type="number" name="unidades[<?php echo $i; ?>][porcentaje]" value="<?php echo $instrumento['porcentaje'] ?>" /></td>
                        <td><a href="?operacion=eliminar&clave=<?php echo $instrumento['clave'] ?>"><img src="img/remove32.png"></a></td>
                    </tr>
                    <?php
                    $i++;
                }
                ?>
                <tr>
                    <td></td>
                    <td><input type="text" name="unidades[<?php echo $i; ?>][numero]" value="" /></td>
                    <td><input type="text" name="unidades[<?php echo $i; ?>][nombre]" value="" /></td>
                    <td><input type="number" name="unidades[<?php echo $i; ?>][porcentaje]" value="" /></td>
                </tr>
                <?php
            } else {
                echo "Ha habido un error al ejecutarse la consulta";
            }
        } else {
            echo "Ha habido un error al ejecutarse la consulta";
        }
    }

}