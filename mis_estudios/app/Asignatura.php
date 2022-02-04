<?php

class Asignatura
{
    public int         $codigo;
    public string      $nombre;
    public int         $horas_semana;
    public string      $profesor;

    public function __construct($codigo){
        //Esta función permite definir los atributos cuando se define la clase.
        $this->codigo = $codigo;
    }

    /**
     * @param string $nombre
     */
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @param int $horas_semana
     */
    public function setHorasSemana(int $horas_semana): void
    {
        $this->horas_semana = $horas_semana;
    }

    /**
     * @param string $profesor
     */
    public function setProfesor(string $profesor): void
    {
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

    public function actualizar(){
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

        if ($consulta->execute()){
            // Se ha actualizado correctamente
            return true;
        } else {
            // Ha habido un error al actualizar los datos
            return false;
        }
    }

    public function obtenerDetalles(){
        global $db;
        $query = "SELECT * FROM asignaturas WHERE codigo = :codigo;";
        $consulta = $db->prepare($query);
        $consulta->bindParam(':codigo', $this->codigo);

        if ($consulta->execute()){
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
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

        //TODO obtenerInstrumentos() devuelva los datos para la WEB de forma visual.
        if ($consulta->execute()){
            var_dump($consulta->fetchAll(PDO::FETCH_ASSOC));
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
            var_dump($consulta->fetchAll(PDO::FETCH_ASSOC));
        } else {
            echo "Ha habido un error al ejecutarse la consulta";
        }
    }

}