<?php

class Asignatura
{
    public int      $codigo;
    public string   $nombre;
    public int      $horas_semana;
    public string   $profesor;

    public function crearUnidad(){
        // Usamos la variable $db que hemos definido en el archivo de configuración, la cual contiene la conexión a la base de datos.
        global $db;
        $query = "INSERT INTO mis_estudios.asignaturas (`codigo`, `nombre`, `horas_semana`, `profesor`) VALUES (:codigo, :nombre, :horas_semana, :profesor);";
        $consulta = $db->prepare($query);
        $consulta->bindParam(':codigo', $this->codigo);
        $consulta->bindParam(':nombre', $this->nombre);
        $consulta->bindParam(':horas_semana', $this->horas_semana);
        $consulta->bindParam(':profesor', $this->profesor);

        if($consulta->execute()){
            // Si se ejecuta correctamente, devuelve TRUE
            return true;
        } else {
            // Si no se ejecuta correctamente, devuelve FALSE
            return false;
        }
    }

}