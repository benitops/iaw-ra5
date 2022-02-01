<?php

class Unidades
{
    public int      $clave;         //Auto-increment
    public int      $asignatura;    // Asignatura->codigo;
    public int      $numero;
    public string   $nombre;
    public int      $porcentaje;

    public function __construct($clave = NULL){
        $this->clave = $clave;
    }

    public function crearUnidad($asignatura, $numero, $nombre, $porcentaje){
        $this->asignatura   = $asignatura;
        $this->numero       = $numero;
        $this->nombre       = $nombre;
        $this->porcentaje   = $porcentaje;

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
}