<?php

class Instrumento
{
    public int      $clave;     // Auto-increment
    public int      $unidad;    // Unidades->clave;
    public string   $nombre;
    public int      $peso;
    public float    $calificacion;

    /**
     * @param int $clave
     */
    public function setClave(int $clave): void
    {
        $this->clave = $clave;
    }

    /**
     * @param int $unidad
     */
    public function setUnidad(int $unidad): void
    {
        $this->unidad = $unidad;
    }

    /**
     * @param string $nombre
     */
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @param int $peso
     */
    public function setPeso(int $peso): void
    {
        $this->peso = $peso;
    }

    /**
     * @param float $calificacion
     */
    public function setCalificacion(float $calificacion): void
    {
        $this->calificacion = $calificacion;
    }

    public function crear(){
        global $db;
        $query = "INSERT INTO mis_estudios.instrumentos (unidad, nombre, peso, calificacion) 
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

    public function actualizar(){
        global $db;
        $query = "UPDATE mis_estudios.instrumentos t
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

    public function eliminar(){
        global $db;
        $query = "DELETE
                    FROM mis_estudios.instrumentos
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