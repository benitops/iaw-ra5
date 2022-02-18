<?php

class Unidad
{
    public int      $clave;         // Auto-increment
    public int      $asignatura;    // Asignatura->codigo;
    public int      $numero;
    public string   $nombre;
    public int      $porcentaje;

    /**
     * Establece el valor de clave
     * @param int|mixed $clave
     */
    public function setClave(mixed $clave): void
    {
        $this->clave = (int)$clave;
    }

    /**
     * Establece el valor de asignatura
     * @param int|string $asignatura
     */
    public function setAsignatura(mixed $asignatura): void
    {
        $this->asignatura = (int)$asignatura;
    }

    /**
     * Establece el valor de numero
     * @param int|string $numero
     */
    public function setNumero(mixed $numero): void
    {
        $this->numero = (int)$numero;
    }

    /**
     * Establece el valor de nombre
     * @param string $nombre
     */
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * Establece el valor de porcentaje
     * @param int|string $porcentaje
     */
    public function setPorcentaje(mixed $porcentaje): void
    {
        $this->porcentaje = (int)$porcentaje;
    }

    /**
     * Realiza una consulta para obtener la clave de los instrumentos
     * @return array|false
     */
    public function obtenerInstrumentos(){
        global $db;
        $query = "SELECT clave FROM instrumentos WHERE unidad = :unidad";
        $consulta = $db->prepare($query);
        $consulta->bindParam(":unidad", $this->clave);
        if ($consulta->execute()){
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    /**
     * Inserta en la tabla toda la información de la Unidad
     * @return bool
     */
    public function crear(){
        global $db;
        $query = "INSERT INTO unidades (asignatura, numero, nombre, porcentaje) VALUES (:asignatura, :numero, :nombre, :porcentaje);";
        $consulta = $db->prepare($query);
        $consulta->bindParam(':asignatura', $this->asignatura);
        $consulta->bindParam(':numero', $this->numero);
        $consulta->bindParam(':nombre', $this->nombre);
        $consulta->bindParam(':porcentaje', $this->porcentaje);

        if($consulta->execute()){
            // Si se ejecuta correctamente, devuelve TRUE
            return true;
        } else {
            // Si no se ejecuta correctamente, devuelve FALSE
            return false;
        }
    }

    /**
     * Elimina la unidad y sus instrumentos
     * @return bool|string
     */
    public function eliminar(): bool|string
    {
        global $db;
        // Primero borramos sus instrumentos, para no perderlos
        $instrumentos = $this->obtenerInstrumentos();
        if ($instrumentos){
            foreach ($instrumentos as $i){
                $ins = new Instrumento();
                $ins->setClave($i['clave']);
                if (!$ins->eliminar()){
                    return "Error al eliminar los Instrumentos de las unidades";
                    exit(); // Si hubiera algún error, dejamos de ejecutar el script.
                }
            }
        }

        // Borramos la unidad
        $query = "DELETE FROM unidades WHERE clave = :clave;";
        $consulta = $db->prepare($query);
        $consulta->bindParam(':clave', $this->clave);

        if($consulta->execute()){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Actualizamos los valores de la Unidad.
     * @return bool
     */
    public function actualizar(){
        global $db;
        $query = "UPDATE unidades t
                    SET t.numero     = :numero,
                        t.nombre     = :nombre,
                        t.porcentaje = :porcentaje
                    WHERE t.clave = :clave;
                    ";
        $consulta = $db->prepare($query);
        $consulta->bindParam(":numero", $this->numero);
        $consulta->bindParam(":nombre", $this->nombre);
        $consulta->bindParam(":porcentaje", $this->porcentaje);
        $consulta->bindParam(":clave", $this->clave);

        if ($consulta->execute()){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Si hubiera un cambio en el código de la asignatura, esta función actualiza
     * aquellas unidades que necesiten actualizar el código de referencia
     * para no desvincularse de su asignatura.
     * @return bool
     */
    public function actualizarAsignatura(): bool
    {
        global $db;
        $query = "UPDATE    unidades t
                    SET     t.asignatura = :asignatura
                    WHERE   t.clave = :clave;
                    ";
        $consulta = $db->prepare($query);
        $consulta->bindParam(":asignatura", $this->asignatura);
        $consulta->bindParam(":clave", $this->clave);

        if ($consulta->execute()){
            return true;
        } else {
            return false;
        }

    }

    /**
     * Calcula la nota media de la Unidad, teniendo en cuenta sus instrumentos.
     * @return false|float|int|null
     */
    public function obtenerNotaMedia(){
        global $db;
        $query = "SELECT peso, calificacion 
                    FROM instrumentos 
                    WHERE unidad = :unidad AND calificacion";
        $consulta = $db->prepare($query);
        $consulta->bindParam(":unidad", $this->clave);

        if($consulta->execute()){
            $dividendo = 0;
            if ($consulta->rowCount() == 0){
                // Si no encuentra instrumentos, devuelve NULL.
                return NULL;
            } else {
                // Si hay instrumentos, para cada uno de ellos calcula su aportación
                foreach ($consulta->fetchAll(PDO::FETCH_ASSOC) as $item){
                    $dividendo += $item['peso'] * $item['calificacion'];
                }
                return $dividendo/100;
            }
        } else {
            return false;
        }
    }

}