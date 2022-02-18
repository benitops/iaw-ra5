<?php

class Asignatura
{
    private int         $codigo;
    private string      $nombre;
    private int         $horas_semana;
    private string      $profesor;


    /**
     * Establece el valor de código
     * @param int|string $codigo
     */
    public function setCodigo(mixed $codigo): void
    {
        $this->codigo = (int)$codigo;
    }

    /**
     * Obtener el valor del código
     * @return int
     */
    public function obtenerCodigo(): int
    {
        return $this->codigo;
    }

    /**
     * Establece el valor del nombre
     * @param string $nombre
     */
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * Obtener el valor del nombre
     * @return string
     */
    public function obtenerNombre(): string
    {
        return $this->nombre;
    }

    /**
     * Establece el valor de horas_semana
     * @param string|int $horas_semana
     */
    public function setHorasSemana(mixed $horas_semana): void
    {
        $this->horas_semana = (int)$horas_semana;
    }

    /**
     * Establece el valor de profesor
     * @param string $profesor
     */
    public function setProfesor(string $profesor): void
    {
        $this->profesor = $profesor;
    }

    /**
     * Comprueba si el código de la asignatura es valido.
     * Para que sea válido, el código debe no estar siendo usado.
     * @param $codigo
     * @return bool
     */
    public function validarCodigo($codigo = NULL){
        global $db;
        // Ponemos el valor por defecto NULL para permitir que se pueda usar la función fuera de la clase
        if(is_null($codigo)){
            $codigo = $this->codigo; // Si el valor es NULL, se coge el valor del objeto. Si no lo es, se usa el argumento.
        }

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

    /**
     * Inserta en la tabla todos los valores de la Asignatura.
     * @return bool
     */
    public function crear()
    {
        // Se comprueba si el código de la asignatura es válido para evitar que se use uno ya en uso.
        if ($this->validarCodigo($this->codigo)) {
            // Usamos la variable $db que hemos definido en el archivo de configuración, la cual contiene la conexión a la base de datos.
            global $db;
            $query = "INSERT INTO asignaturas (`codigo`, `nombre`, `horas_semana`, `profesor`) VALUES (:codigo, :nombre, :horas_semana, :profesor);";
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
            // Si está en uso el código, se devuelve false.
            return false;
        }
    }

    /**
     * Se elimina la asignatura y, a su vez, sus unidades.
     * @return bool|string
     */
    public function eliminar(){
        global $db;
        // Obtenemos sus unidades
        $unidades = $this->obtenerUnidades();
        // Si hay resultados, las eliminamos
        if ($unidades){
            foreach ($unidades as $u){
                $ins = new Unidad();
                $ins->setClave($u['clave']);
                if (!$ins->eliminar()){
                    return "Error al eliminar las unidades a través de la asignatura";
                    exit(); // Si hubiera algún error, dejamos de ejecutar el script.
                }
            }
        }

        // Borramos la asignatura
        $query = "DELETE FROM asignaturas WHERE codigo = :codigo;";
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

    /**
     * Actualizamos los valores de la asignatura
     * @return bool
     */
    public function actualizar(): bool
    {
        global $db;
        $query = "UPDATE asignaturas t
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

    /**
     * Actualiza el codigo de la asignatura
     * @param $nuevoCodigo
     * @return bool
     */
    public function actualizarCodigo($nuevoCodigo): bool
    {
        // Comprobamos primero si el código es válido
        if ($this->validarCodigo($nuevoCodigo)){
            global $db;
            // Seleccionamos todas sus unidades
            $unidades = $this->obtenerUnidades();
            foreach ($unidades as $u){
                $unidad = new Unidad();
                $unidad->setClave($u['clave']);
                $unidad->setAsignatura($nuevoCodigo);
                // Actualizamos el código en todas sus unidades
                if (!$unidad->actualizarAsignatura()){
                    echo "Error al actualizar la asignatura nueva de la unidad";
                    exit(); // Si hubiera algún error, dejamos de ejecutar el script.
                }
            }

            // Cambiamos el código antiguo por el nuevo de Asignatura
            $query = "UPDATE asignaturas t
                    SET t.codigo = :nuevoCodigo
                    WHERE t.codigo = :codigo; ";
            $consulta = $db->prepare($query);
            $consulta->bindParam(":nuevoCodigo", $nuevoCodigo);
            $consulta->bindParam(":codigo", $this->codigo);

            if ($consulta->execute()){
                return true; // Si se ejecuta correctamente
            } else {
                return false; // Si no se ejecuta
            }
        } else {
            return false; // Si el código no es valido
        }
    }

    /**
     * Establecemos los atributos de la Asignatura con los datos de la base de datos
     * @return bool
     */
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

    /**
     * Obtenemos todas las unidades que tengan esta Asignatura
     * @return bool|array
     */
    public function obtenerUnidades(): bool|array
    {
        global $db;
        $query = "SELECT * FROM unidades WHERE asignatura = :codigo;";
        $consulta = $db->prepare($query);
        $consulta->bindParam(':codigo', $this->codigo);
        if ($consulta->execute()){
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return "Ha habido un error al realizar la consulta";
            exit();
        }
    }

    /**
     * Generamos el código HTML con los datos de la Asignatura
     * @return void
     */
    public function mostrarUnidades(){
        $unidades = $this->obtenerUnidades();
        $i = 1;
        if ($unidades){
            foreach ($unidades AS $unidad){
                ?>
                <tr>
                    <td><input type="hidden" name="unidades[<?php echo $i; ?>][clave]" value="<?php echo $unidad['clave'] ?>" /></td>
                    <td><input type="number" name="unidades[<?php echo $i; ?>][numero]" value="<?php echo $unidad['numero'] ?>" /></td>
                    <td><input type="text" name="unidades[<?php echo $i; ?>][nombre]" value="<?php echo $unidad['nombre'] ?>" /></td>
                    <td width="20px"><input type="number" name="unidades[<?php echo $i; ?>][porcentaje]" value="<?php echo $unidad['porcentaje'] ?>"/></td>
                    <td><a href="?operacion=eliminar&clave=<?php echo $unidad['clave'] ?>"><img src="img/remove32.png"></a></td>
                </tr>
                <?php $i++;
            }
        }  ?>
        <tr>
            <td></td>
            <td><input type="text" name="unidades[<?php echo $i; ?>][numero]" value="" /></td>
            <td><input type="text" name="unidades[<?php echo $i; ?>][nombre]" value="" /></td>
            <td><input type="number" name="unidades[<?php echo $i; ?>][porcentaje]" value="" /></td>
        </tr>
        <?php
    }

    /**
     * Obtenemos todas los instrumentos que tenga esta Asignatura
     * @return bool|array
     */
    public function obtenerInstrumentos(): bool|array
    {
        global $db;
        $query = "SELECT instrumentos.*, unidades.numero, unidades.nombre AS 'unidadesNombre' 
                    FROM instrumentos INNER JOIN unidades on unidades.clave = instrumentos.unidad 
                    WHERE unidades.asignatura = :codigo;";
        $consulta = $db->prepare($query);
        $consulta->bindParam(':codigo', $this->codigo);
        if ($consulta->execute()){
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return "Ha habido un error al realizar la consulta";
            exit();
        }
    }

    /**
     * Generamos el código HTML con los datos de la Asignatura
     * @return void
     */
    public function mostrarInstrumentos(){
        $instrumentos = $this->obtenerInstrumentos();
        $i = 1;
        if ($instrumentos){
            foreach ($instrumentos AS $instrumento){ ?>
                <tr>
                    <td><input type="hidden" name="instrumentos[<?php echo $i; ?>][clave]" value="<?php echo $instrumento['clave'] ?>" /></td>
                    <td>
                        <select name="instrumentos[<?php echo $i; ?>][unidad]">
                            <?php foreach ($this->obtenerUnidades() as $u){
                                //Se obtienen las unidades para el dropdown
                                //Por cada unidad se añade una opción
                                //Se comprueba si la unidad y la clave es la misma, para que aparezca seleccionado
                                if ($instrumento['unidad'] == $u['clave']) { ?>
                                    <option value="<?php echo $u['clave']; ?>" selected><?php echo $u['numero'].'. '.$u['nombre']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $u['clave']; ?>"><?php echo $u['numero'].'. '.$u['nombre']; ?></option>
                                <?php }
                            } ?>
                        </select>
                    </td>
                    <td><input type="text" name="instrumentos[<?php echo $i; ?>][nombre]" value="<?php echo $instrumento['nombre'] ?>" /></td>
                    <td><input type="text" name="instrumentos[<?php echo $i; ?>][peso]" value="<?php echo $instrumento['peso'] ?>" /></td>
                    <td><input type="number" step=".01" name="instrumentos[<?php echo $i; ?>][calificacion]" value="<?php echo $instrumento['calificacion'] ?>" /></td>
                    <td><a href="?operacion=eliminar&clave=<?php echo $instrumento['clave'] ?>"><img src="img/remove32.png"></a></td>
                </tr>
                <?php $i++;
            }
        } ?>
        <tr>
            <td></td>
            <td>
                <select name="instrumentos[<?php echo $i; ?>][unidad]">
                    <option selected disabled>Selecciona unidad</option>
                    <?php foreach ($this->obtenerUnidades() as $u){ ?>
                    <option value="<?php echo $u['clave']; ?>"><?php echo $u['numero'].'. '.$u['nombre']; ?></option>
                    <?php } ?>
                </select>
            </td>
            <td><input type="text" name="instrumentos[<?php echo $i; ?>][nombre]" value="" /></td>
            <td><input type="number" name="instrumentos[<?php echo $i; ?>][peso]" value="" /></td>
            <td><input type="number" step=".01" name="instrumentos[<?php echo $i; ?>][calificacion]" value="" /></td>

        </tr>
        <?php
    }

    /**
     * Calculamos la nota media de la asignatura
     * @return false|float|int|null
     */
    public function obtenerNotaMedia(){
        global $db;
        $query = "SELECT clave, porcentaje 
                    FROM unidades 
                    WHERE asignatura = :asignatura AND unidades.porcentaje IS NOT NULL";
        $consulta = $db->prepare($query);
        $consulta->bindParam(":asignatura", $this->codigo);

        if ($consulta->execute()){
            $dividendo = 0;
            // Se comprueba si hay unidades
            if($consulta->rowCount() == 0){
                return NULL;
            } else {
                foreach ($consulta->fetchAll(PDO::FETCH_ASSOC) as $item){
                    $unidad = new Unidad();
                    $unidad->setClave($item['clave']);

                    if (!is_null($unidad->obtenerNotaMedia())){
                        $dividendo += $unidad->obtenerNotaMedia() * $item['porcentaje'];
                    }
                }
                return $dividendo/100;
            }
        } else {
            return false;
        }
    }
}