<?php

class Unidad
{
    public int      $clave;         // Auto-increment
    public int      $asignatura;    // Asignatura->codigo;
    public int      $numero;
    public string   $nombre;
    public int      $porcentaje;

    public function __construct($clave = NULL){
        $this->clave = $clave;
    }

    /**
     * @param int|mixed|null $clave
     */
    public function setClave(mixed $clave): void
    {
        $this->clave = $clave;
    }

    /**
     * @param int $asignatura
     */
    public function setAsignatura(int $asignatura): void
    {
        $this->asignatura = $asignatura;
    }

    /**
     * @param int $numero
     */
    public function setNumero(int $numero): void
    {
        $this->numero = $numero;
    }

    /**
     * @param string $nombre
     */
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @param int $porcentaje
     */
    public function setPorcentaje(int $porcentaje): void
    {
        $this->porcentaje = $porcentaje;
    }

    public function validarUnidad($clave){
        global $db;
        $query = "SELECT clave FROM unidades WHERE clave = :clave;";
        $con = $db->prepare($query);
        $con->bindParam(":clave", $clave);
        $con->execute();
        if ($con->rowCount() == 0){
            return true;
        } else {
            return false;
        }
    }

    public function crear(){
        global $db;
        $query = "INSERT INTO mis_estudios.unidades (asignatura, numero, nombre, porcentaje) VALUES (:asignatura, :numero, :nombre, :porcentaje);";
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

    public function eliminar(){
        global $db;
        $query = "DELETE FROM mis_estudios.unidades WHERE clave = :clave;";
        $consulta = $db->prepare($query);
        $consulta->bindParam(':clave', $this->clave);

        if($consulta->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function actualizar(){
        global $db;
        $query = "UPDATE mis_estudios.unidades t
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
}