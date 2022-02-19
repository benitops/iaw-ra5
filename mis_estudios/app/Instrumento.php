<?php

class Instrumento
{
    public int      $clave;     // Auto-increment
    public int      $unidad;    // Unidades->clave;
    public string   $nombre;
    public int      $peso;
    public mixed    $calificacion;

    /**

     * Establece el valor de clave

     * @param int $clave
     */
    public function setClave(int $clave): void
    {
        $this->clave = $clave;
    }

    /**
     * Establece el valor de unidad
     * @param int $unidad
     */
    public function setUnidad(int $unidad): void
    {
        $this->unidad = $unidad;
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
     * Establece el valor de peso
     * @param int $peso
     */
    public function setPeso(int $peso): void
    {
        $this->peso = $peso;
    }

    /**
     * Establece el valor de calificacion
     * @param mixed $calificacion
     */
    public function setCalificacion(mixed $calificacion): void
    {
        $this->calificacion = $calificacion;
    }

    /**
     * Inserta en la tabala toda la información del Instrumento
     * @return bool
     */
    public function crear(){
        global $db;
        $query = "INSERT INTO instrumentos (unidad, nombre, peso, calificacion) 
                    VALUES (:unidad, :nombre, :peso, :calificacion);";
        $consulta = $db->prepare($query);
        $consulta->bindParam(":unidad", $this->unidad);
        $consulta->bindParam(":nombre", $this->nombre);
        $consulta->bindParam(":peso", $this->peso);
        $consulta->bindParam(":calificacion", $this->calificacion);
        if($consulta->execute()){
            // Si se ejecuta correctamente, devuelve TRUE
            return true;
        } else {
            // Si no se ejecuta correctamente, devuelve FALSE
            return false;
        }
    }


    /**
     * Actualiza los datos del instrumento
     * @return bool
     */
    public function actualizar(){
        global $db;
        $query = "UPDATE instrumentos t
                    SET t.unidad       = :unidad,
                        t.nombre       = :nombre,
                        t.peso         = :peso,
                        t.calificacion = :calificacion
                    WHERE t.clave = :clave;";
        $consulta = $db->prepare($query);
        $consulta->bindParam(":unidad", $this->unidad);
        $consulta->bindParam(":nombre", $this->nombre);
        $consulta->bindParam(":peso", $this->peso);
        $consulta->bindParam(":calificacion", $this->calificacion);
        $consulta->bindParam(":clave", $this->clave);
        if ($consulta->execute()){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Eliminar el instrumento
     * @return bool
     */
    public function eliminar(){
        global $db;
        $query = "DELETE
                    FROM instrumentos
                    WHERE clave = :clave;";

        $consulta = $db->prepare($query);
        $consulta->bindParam(':clave', $this->clave);

        if($consulta->execute()){
            return true;
        } else {
            return false;
        }
    }

}