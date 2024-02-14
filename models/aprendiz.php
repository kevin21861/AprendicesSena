<?php
require_once 'config/db.php';
class Aprendiz
{
    private $id;
    private $tipoDocumento;
    private $numeroDocumento;
    private $primerNombre;
    private $segundoNombre;
    private $primerApellido;
    private $segundoApellido;
    private $fechaDeNacimiento;
    private $edad;
    private $sexo;
    private $telefono;
    private $direccion;
    private $password;
    public $db;


    public function __construct()
    {
        try {
            $this->db = Database::connect();
        } catch (Exception $e) {
            echo "Error de conexión: " . $e->getMessage();

            exit;
        }
    }


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $this->db->real_escape_string($id);

        return $this;
    }
    public function getTipoDocumento()
    {
        return $this->tipoDocumento;
    }

    public function setTipoDocumento($tipoDocumento)
    {
        $this->tipoDocumento = $this->db->real_escape_string($tipoDocumento);

        return $this;
    }

    public function getNumeroDocumento()
    {
        return $this->numeroDocumento;
    }

    public function setNumeroDocumento($numeroDocumento)
    {
        $this->numeroDocumento = $this->db->real_escape_string($numeroDocumento);

        return $this;
    }

    public function getPrimerNombre()
    {
        return $this->primerNombre;
    }

    public function setPrimerNombre($primerNombre)
    {
        $this->primerNombre = $this->db->real_escape_string($primerNombre);

        return $this;
    }

    public function getSegundoNombre()
    {
        return $this->segundoNombre;
    }

    public function setSegundoNombre($segundoNombre)
    {
        $this->segundoNombre = $this->db->real_escape_string($segundoNombre);

        return $this;
    }

    public function getPrimerApellido()
    {
        return $this->primerApellido;
    }

    public function setPrimerApellido($primerApellido)
    {
        $this->primerApellido = $this->db->real_escape_string($primerApellido);

        return $this;
    }

    public function getSegundoApellido()
    {
        return $this->segundoApellido;
    }

    public function setSegundoApellido($segundoApellido)
    {
        $this->segundoApellido = $this->db->real_escape_string($segundoApellido);

        return $this;
    }

    public function getFechaDeNacimiento()
    {
        return $this->fechaDeNacimiento;
    }

    public function setFechaDeNacimiento($fechaDeNacimiento)
    {
        $this->fechaDeNacimiento = $fechaDeNacimiento;

        return $this;
    }
    public function getEdad()
    {
        return $this->edad;
    }

    public function setEdad($edad)
    {
        $this->edad = $this->db->real_escape_string($edad);

        return $this;
    }


    public function getSexo()
    {
        return $this->sexo;
    }
    public function setSexo($sexo)
    {
        $this->sexo = $this->db->real_escape_string($sexo);
        return $this;
    }
    public function getTelefono()
    {
        return $this->telefono;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = $this->db->real_escape_string($telefono);
        return $this;
    }
    public function getDireccion()
    {
        return $this->direccion;
    }

    public function setDireccion($direccion)
    {
        $this->direccion = $this->db->real_escape_string($direccion);
        return $this;
    }
    public function getPassword()
    {
        // creamos la contraseña encriptada
        return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
    public function calcularEdad()
    {
        // funcion para calcular la edad de acuerdo con la fecha de nacimiento establecida. 
        // para evitar problemas de inconsistencia en los datos
        // Convertir las fechas a objetos DateTime
        $nacimiento = new DateTime($this->fechaDeNacimiento);
        $actual = new DateTime();

        // Calcular la diferencia en años
        $diferencia = $nacimiento->diff($actual);

        // Obtener el número de años
        $edad = $diferencia->y;

        return $edad;
    }
    public function crearAprendiz()
    {
        // consulta para guardar los datos del aprendiz
        $sql = "INSERT INTO aprendices
        VALUES (NULL,'{$this->getTipoDocumento()}', '{$this->getNumeroDocumento()}', '{$this->getPrimerNombre()}', '{$this->getSegundoNombre()}', '{$this->getPrimerApellido()}', '{$this->getSegundoApellido()}', '{$this->getFechaDeNacimiento()}', '{$this->getEdad()}', '{$this->getSexo()}',  '{$this->getTelefono()}', '{$this->getDireccion()}')";
        if ($this->db->query($sql)) {
            return true;
        } else {
            return false;
        }
    }
    public function verAprendices()
    {
        $sql = "SELECT id, numeroDocumento, primerNombre, primerApellido from aprendices ORDER BY id ASC;";
        $aprendices = $this->db->query($sql);
        if ($aprendices) {
            $verAprendices = $aprendices->fetch_all(MYSQLI_ASSOC);
            return $verAprendices;
        } else {
            return false;
        }
    }
    public function verAprendiz()
    {
        $id = $this->getId();
        $sql = "SELECT aprendices.id, tipodocumento.descripcion AS tipoDeDocumento, aprendices.numeroDocumento, aprendices.primerNombre, aprendices.segundoNombre,
        aprendices.primerApellido, aprendices.segundoApellido, aprendices.fechaDeNacimiento, aprendices.edad, sexo.descripcion AS sex,
        aprendices.telefono, aprendices.direccion
        FROM aprendices
        JOIN sexo ON sexo.id = aprendices.idSexo
        JOIN tipodocumento ON tipodocumento.id = aprendices.idTipoDocumento 
        WHERE aprendices.id=$id;";
        $aprendiz = $this->db->query($sql);
        if ($aprendiz) {
            return  $aprendiz->fetch_assoc();
        } else {
            return false;
        }
    }
    public function eliminarAprendiz()
    {
        $id = $this->getId();
        $sql = "DELETE FROM aprendices WHERE id=$id;";
        $delete = $this->db->query($sql);
        if ($delete) {
            return true;
        } else {
            return false;
        }
    }

    public function editarAprendiz()
    {
        $id = $this->getId();

        $sql = "UPDATE aprendices SET 
        idTipoDocumento = '{$this->getTipoDocumento()}',
        numeroDocumento = '{$this->getNumeroDocumento()}',
        primerNombre = '{$this->getPrimerNombre()}', 
        segundoNombre = '{$this->getSegundoNombre()}',
        primerApellido = '{$this->getPrimerApellido()}',
        segundoApellido = '{$this->getSegundoApellido()}', 
        fechaDeNacimiento = '{$this->getFechaDeNacimiento()}', 
        edad = '{$this->getEdad()}', 
        idSexo = '{$this->getSexo()}',  
        telefono = '{$this->getTelefono()}', 
        direccion = '{$this->getDireccion()}'
        WHERE id = '$id'; ";
        // echo $sql;
        // echo $id;
        // die();
        if ($this->db->query($sql)) {
            return true;
            // echo "exito";
            // die();
            exit;
        } else {
            // echo "no fue exito";
            // die();
            return false;
        }
    }


}
