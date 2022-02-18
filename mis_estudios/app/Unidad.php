<?php

class Unidad
{
    public int      $clave;         // Auto-increment
    public int      $asignatura;    // Asignatura->codigo;
    public int      $numero;
    public string   $nombre;
    public int      $porcentaje;

    /**
     * @param int|mixed $clave
     */
    public function setClave(mixed $clave): void
    {
        $this->clave = (int)$clave;
    }

    /**
     * @param int|string $asignatura
     */
    public function setAsignatura(mixed $asignatura): void
    {
        $this->asignatura = (int)$asignatura;
    }

    /**
     * @param int|string $numero
     */
    public function setNumero(mixed $numero): void
    {
        $this->numero = (int)$numero;
    }

    /**
     * @param string $nombre
     */
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @param int|string $porcentaje
     */
    public function setPorcentaje(mixed $porcentaje): void
    {
        $this->porcentaje = (int)$porcentaje;
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

    public function obtenerNotaMedia(){
        global $db;
        $query = "SELECT peso, calificacion 
                    FROM instrumentos 
                    WHERE unidad = :unidad AND calificacion IS NOT NULL";
        $consulta = $db->prepare($query);
        $consulta->bindParam(":unidad", $this->clave);

        if($consulta->execute()){
            $dividendo = 0;
            $divisor = 0;

            foreach ($consulta->fetchAll(PDO::FETCH_ASSOC) as $item){
                $dividendo += $item['peso']* $item['calificacion'];
                $divisor += $item['peso'];
            }

            if (!$divisor){
                return NULL;
            } else {
                return $dividendo/$divisor;
            }
        } else {
            return false;
        }
    }
}