<?php

class Asignatura
{
    public int      $codigo;
    public string   $nombre;
    public int      $horas_semana;
    public string   $profesor;

    public function __construct($codigo, $nombre = NULL, $horas_semana = NULL, $profesor = NULL){
        //Esta función permite definir los atributos cuando se define la clase.
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->horas_semana = $horas_semana;
        $this->profesor = $profesor;
    }

    public function crear(){
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

    public function obtenerUnidades(){
        global $db;
        $query = "SELECT * FROM mis_estudios.unidades WHERE asignatura = :codigo;";
        $consulta = $db->prepare($query);
        $consulta->bindParam(':codigo', $this->codigo);

        //TODO obtenerInstrumentos() devuelva los datos para la WEB de forma visual.
        if ($consulta->execute()){

        } else {

        }

    }

    public function obtenerInstrumentos(){
        global $db;
        $query = "SELECT instrumentos.*, unidades.numero, unidades.nombre FROM instrumentos INNER JOIN unidades on unidades.clave = instrumentos.unidad WHERE unidades.asignatura = :codigo;";
        $consulta = $db->prepare($query);
        $consulta->bindParam(':codigo', $this->codigo);

        //TODO obtenerInstrumentos() devuelva los datos para la WEB de forma visual.
        if ($consulta->execute()){

        } else {

        }
    }

}