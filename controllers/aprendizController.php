<?php
require_once 'models/aprendiz.php';
class aprendizController
{
	public function crearAprendiz()
	{
		require_once "views/aprendiz/crearAprendiz.php";
		// funcion que nos redirige a la pagina con el formulario para registrar al aprendiz
	}
	public function verAprendices()
	{
		// con esta funcion hacemos la consulta de todos los aprendices que hay registrados
		$Naprendices = new Aprendiz();
		$aprendices = $Naprendices->verAprendices();
		require_once 'views/aprendiz/verAprendices.php';
	}
	public function verAprendiz()
	{
		// funcion para hacer la consulta de un solo aprendiz con el id
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$aprendiz = new Aprendiz();
			$aprendiz->setId($id);
			// $_SESSION['aprendiz'] = $aprendiz->verAprendiz();
			$nAprendiz = $aprendiz->verAprendiz();
			require_once 'views/aprendiz/verAprendiz.php';
		}
	}
	public function editarAprendiz()
	{
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$aprendiz = new Aprendiz();
			$aprendiz->setId($id);
			// $_SESSION['aprendiz'] = $aprendiz->verAprendiz();
			$nAprendiz = $aprendiz->verAprendiz();
			require_once 'views/aprendiz/editarAprendiz.php';
		}
	}
	public function updateAprendiz()
	{
		$exitos = array();
		$errores = array();
		if (isset($_POST['id'])) {
			$id = $_POST['id'];
			$aprendiz = new Aprendiz();
			$aprendiz->setId($id);
			// $_SESSION['aprendiz'] = $aprendiz->verAprendiz();
			$uAprendiz = $aprendiz->verAprendiz();
		}
		// funcion donde recibimos el post del formulario para crear al aprendiz
		$tipoDocumento = isset($_POST['tipoDocumento']) ? $_POST['tipoDocumento'] : $uAprendiz['tipoDocumento'];
		$tiposDocumentosPermitidos = array('0', '1', '2', '3', '4', '5'); // Lista de tipos de documento permitidos

		if (!in_array($tipoDocumento, $tiposDocumentosPermitidos)) {
			$errores['tipoDocumento'] = 'Seleccione un tipo de documento válido.';
		}

		$numeroDocumento = isset($_POST['numeroDocumento']) ? strtoupper($_POST['numeroDocumento']) : $uAprendiz['numeroDocumento'];
		// validar que el formato coincida con lo permitido
		if (!preg_match('/^[0-9]+$/', $numeroDocumento)) {
			$errores['numeroDocumento'] = 'El número de documento debe contener solo números.';
		}
		$primerNombre = isset($_POST['primerNombre']) ? strtoupper($_POST['primerNombre']) : $uAprendiz['primerNombre'];
		// Validar que no haya espacios en el nombre
		if (trim($primerNombre) !== $primerNombre) {
			$errores['primerNombre'] = 'El nombre no debe contener espacios.';
		}
		// Validar que solo contiene letras
		if (!preg_match('/^[A-Z]+$/', $primerNombre)) {
			$errores['primerNombre'] = 'El nombre debe contener solo letras.';
		}

		$segundoNombre = isset($_POST['segundoNombre']) ? strtoupper($_POST['segundoNombre']) : $uAprendiz['segundoNombre'];
		if ($segundoNombre != NULL) {
			if (trim($segundoNombre) !== $segundoNombre) {
				$errores['segundoNombre'] = 'El nombre no debe contener espacios.';
			}
			// Validar que solo contiene letras
			if (!preg_match('/^[A-Z]+$/', $segundoNombre)) {
				$errores['segundoNombre'] = 'El nombre debe contener solo letras.';
			}
		}

		$primerApellido = isset($_POST['primerApellido']) ? strtoupper($_POST['primerApellido']) : $uAprendiz['primerApellido'];
		// Validar que no haya espacios en el apellido
		if (trim($primerApellido) !== $primerApellido) {
			$errores['primerApellido'] = 'El Apellido no debe contener espacios.';
		}
		// Validar que solo contiene letras
		if (!preg_match('/^[A-Z]+$/', $primerApellido)) {
			$errores['primerApellido'] = 'El Apellido debe contener solo letras.';
		}
		$segundoApellido = isset($_POST['segundoApellido']) ? strtoupper($_POST['segundoApellido']) : $uAprendiz['segundoApellido'];
		if ($segundoApellido != NULL) {
			if (trim($segundoApellido) !== $segundoApellido) {
				$errores['segundoApellido'] = 'El Apellido no debe contener espacios.';
			}
			// Validar que solo contiene letras
			if (!preg_match('/^[A-Z]+$/', $segundoApellido)) {
				$errores['segundoApellido'] = 'El Apellido debe contener solo letras.';
			}
		}
		$fechaDeNacimiento = isset($_POST['fechaDeNacimiento']) ? $_POST['fechaDeNacimiento'] : $uAprendiz['fechaDeNacimiento'];
		// validacion para la fecha de nacimiento que no sea menor a 14 años
		$fechaActual = new DateTime();
		$fechaNacimiento = new DateTime($fechaDeNacimiento);
		$diferencia = $fechaActual->diff($fechaNacimiento);

		if ($diferencia->y < 14) {
			$errores['fechaDeNacimiento'] = 'El aprendiz debe tener minimo 18 años para registrarlo.';
		}

		$sexo = isset($_POST['sexo']) ? $_POST['sexo'] : $uAprendiz['sexo'];
		// validar el sexo
		$sexosPermitidos = array('0', '1', '2'); // Lista de sexos permitidos

		if (!in_array($sexo, $sexosPermitidos)) {
			$errores['sexo'] = 'Seleccione una opción válida.';
		}
		$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : $uAprendiz['telefono'];
		if (!preg_match('/^[0-9]+$/', $telefono)) {
			$errores['telefono'] = 'El número de telefono debe contener solo números.';
		}
		$direccion = isset($_POST['direccion']) ? strtoupper($_POST['direccion']) : $uAprendiz['direccion'];
		require_once 'views/aprendiz/editarAprendiz.php';

		try {
			// Verificar si los campos obligatorios no están vacíos
			if ($tipoDocumento !== ''  && !empty($numeroDocumento) && !empty($primerNombre) && !empty($primerApellido) && !empty($fechaDeNacimiento) && $sexo !== ''  && !empty($telefono) && !empty($direccion)) {
				ob_start();
				$Naprendiz = new Aprendiz;

				$Naprendiz->setId($id);
				$Naprendiz->setTipoDocumento($tipoDocumento);
				$Naprendiz->setNumeroDocumento($numeroDocumento);
				$Naprendiz->setPrimerNombre($primerNombre);
				$Naprendiz->setSegundoNombre($segundoNombre);
				$Naprendiz->setPrimerApellido($primerApellido);
				$Naprendiz->setSegundoApellido($segundoApellido);
				$Naprendiz->setFechaDeNacimiento($fechaDeNacimiento);
				// usamos la funcion calcular edad. para no tener inconsistencias en la informacion
				$edad = $Naprendiz->calcularEdad();
				$Naprendiz->setEdad($edad);
				$Naprendiz->setSexo($sexo);
				$Naprendiz->setTelefono($telefono);
				$Naprendiz->setDireccion($direccion);
				// $consulta = $Naprendiz->editarAprendiz();
				$Naprendiz->editarAprendiz();
				
				// if ($consulta) {
					
					

					// $exitos['registrado'] = 'Aprendiz registrado con éxito.';
					$_SESSION['exito'] = 'Aprendiz registrado con exito.';
					ob_end_flush();
					header("Location: " . base_url);
					exit;
				// }
			} else {
				$errores['obligatorios'] = 'Por favor llene el campo obligatorio.';
				require_once 'views/aprendiz/editarAprendiz.php';
			}
		} catch (Exception $e) {
			echo "error al guardar al aprendiz" . $e->getMessage();
			
		}
		// var_dump($nAprendiz);
		// die();
		// echo "hola mundo";
	}
	public function eliminarAprendiz()
	{
		$exitos = array();
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$aprendiz = new Aprendiz();
			$aprendiz->setId($id);
			// $_SESSION['aprendiz'] = $aprendiz->verAprendiz();
			$nAprendiz = $aprendiz->eliminarAprendiz();
			// require_once 'views/aprendiz/verAprendices.php';
			$_SESSION['exito'] = 'Aprendiz eliminado con exito.';
			header("Location: " . base_url);
		}
	}
	public function guardarAprendiz()
	{
		$errores = array();
		$exitos = array();
		// funcion donde recibimos el post del formulario para crear al aprendiz
		$tipoDocumento = isset($_POST['tipoDocumento']) ? $_POST['tipoDocumento'] : '';
		$tiposDocumentosPermitidos = array('0', '1', '2', '3', '4', '5'); // Lista de tipos de documento permitidos

		if (!in_array($tipoDocumento, $tiposDocumentosPermitidos)) {
			$errores['tipoDocumento'] = 'Seleccione un tipo de documento válido.';
		}

		$numeroDocumento = isset($_POST['numeroDocumento']) ? strtoupper($_POST['numeroDocumento']) : '';
		// validar que el formato coincida con lo permitido
		if (!preg_match('/^[0-9]+$/', $numeroDocumento)) {
			$errores['numeroDocumento'] = 'El número de documento debe contener solo números.';
		}
		$primerNombre = isset($_POST['primerNombre']) ? strtoupper($_POST['primerNombre']) : '';
		// Validar que no haya espacios en el nombre
		if (trim($primerNombre) !== $primerNombre) {
			$errores['primerNombre'] = 'El nombre no debe contener espacios.';
		}
		// Validar que solo contiene letras
		if (!preg_match('/^[A-Z]+$/', $primerNombre)) {
			$errores['primerNombre'] = 'El nombre debe contener solo letras.';
		}

		$segundoNombre = isset($_POST['segundoNombre']) ? strtoupper($_POST['segundoNombre']) : NULL;
		if ($segundoNombre != NULL) {
			if (trim($segundoNombre) !== $segundoNombre) {
				$errores['segundoNombre'] = 'El nombre no debe contener espacios.';
			}
			// Validar que solo contiene letras
			if (!preg_match('/^[A-Z]+$/', $segundoNombre)) {
				$errores['segundoNombre'] = 'El nombre debe contener solo letras.';
			}
		}

		$primerApellido = isset($_POST['primerApellido']) ? strtoupper($_POST['primerApellido']) : '';
		// Validar que no haya espacios en el apellido
		if (trim($primerApellido) !== $primerApellido) {
			$errores['primerApellido'] = 'El Apellido no debe contener espacios.';
		}
		// Validar que solo contiene letras
		if (!preg_match('/^[A-Z]+$/', $primerApellido)) {
			$errores['primerApellido'] = 'El Apellido debe contener solo letras.';
		}
		$segundoApellido = isset($_POST['segundoApellido']) ? strtoupper($_POST['segundoApellido']) : NULL;
		if ($segundoApellido != NULL) {
			if (trim($segundoApellido) !== $segundoApellido) {
				$errores['segundoApellido'] = 'El Apellido no debe contener espacios.';
			}
			// Validar que solo contiene letras
			if (!preg_match('/^[A-Z]+$/', $segundoApellido)) {
				$errores['segundoApellido'] = 'Este espacio debe contener solo letras.';
			}
		}
		$fechaDeNacimiento = isset($_POST['fechaDeNacimiento']) ? $_POST['fechaDeNacimiento'] : '';
		// validacion para la fecha de nacimiento que no sea menor a 14 años
		$fechaActual = new DateTime();
		$fechaNacimiento = new DateTime($fechaDeNacimiento);
		$diferencia = $fechaActual->diff($fechaNacimiento);

		if ($diferencia->y < 14) {
			$errores['fechaDeNacimiento'] = 'El aprendiz debe tener minimo 18 años para registrarlo.';
		}

		$sexo = isset($_POST['sexo']) ? $_POST['sexo'] : '';
		// validar el sexo
		$sexosPermitidos = array('0', '1', '2'); // Lista de sexos permitidos

		if (!in_array($sexo, $sexosPermitidos)) {
			$errores['sexo'] = 'Seleccione una opción válida.';
		}
		$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
		if (!preg_match('/^[0-9]+$/', $telefono)) {
			$errores['telefono'] = 'Este espacion debe contener solo números.';
		}
		$direccion = isset($_POST['direccion']) ? strtoupper($_POST['direccion']) : '';
		require_once 'views/aprendiz/crearAprendiz.php';

		try {
			// Verificar si los campos obligatorios no están vacíos
			if ($tipoDocumento !== ''  && !empty($numeroDocumento) && !empty($primerNombre) && !empty($primerApellido) && !empty($fechaDeNacimiento) && $sexo !== ''  && !empty($telefono) && !empty($direccion)) {
				ob_start();
				$Naprendiz = new Aprendiz;

				$Naprendiz->setTipoDocumento($tipoDocumento);
				$Naprendiz->setNumeroDocumento($numeroDocumento);
				$Naprendiz->setPrimerNombre($primerNombre);
				$Naprendiz->setSegundoNombre($segundoNombre);
				$Naprendiz->setPrimerApellido($primerApellido);
				$Naprendiz->setSegundoApellido($segundoApellido);
				$Naprendiz->setFechaDeNacimiento($fechaDeNacimiento);
				// usamos la funcion calcular edad. para no tener inconsistencias en la informacion
				$edad = $Naprendiz->calcularEdad();
				$Naprendiz->setEdad($edad);
				$Naprendiz->setSexo($sexo);
				$Naprendiz->setTelefono($telefono);
				$Naprendiz->setDireccion($direccion);
				$Naprendiz->crearAprendiz();

				// $exitos['registrado'] = 'Aprendiz registrado con éxito.';
				$_SESSION['exito'] = 'Aprendiz registrado con éxito.';
				ob_end_flush();
				header("Location: " . base_url);
				exit;
			} else {
				$errores['obligatorios'] = 'Por favor llene el campo obligatorio.';
				require_once 'views/aprendiz/crearAprendiz.php';
			}
		} catch (Exception $e) {
			// echo "error al guardar al aprendiz" . $e->getMessage();
		}
	}
}
