<?php
$_SESSION['start_time'] = time();

// ...

// Comprobar si ha pasado un cierto tiempo
if (isset($_SESSION['start_time']) && (time() - $_SESSION['start_time'] > 1)) {
	// Han pasado 1 segundo, eliminar la variable de sesión 'exito'
	unset($_SESSION['exito']);
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sena_db</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="<?= base_url ?>assets/css/styles.css">
	<script>
		function validarNombresApellidos() {
			var inputPrimerNombre = document.getElementById('primerNombre');
			var inputSegundoNombre = document.getElementById('segundoNombre');
			var inputPrimerApellido = document.getElementById('primerApellido');
			var inputSegundoApellido = document.getElementById('segundoApellido');
			var inputNumeroDocumento = document.getElementById('numeroDocumento');
			var inputTelefono = document.getElementById('telefono');

			// Verificar espacios en blanco en primerNombre
			if (tieneEspaciosEnBlanco(inputPrimerNombre)) {
				alert('No se permiten espacios en blanco en el campo de primer nombre.');
				return false; // Evitar el envío del formulario
			}

			// Verificar espacios en blanco en segundoNombre
			if (tieneEspaciosEnBlanco(inputSegundoNombre)) {
				alert('No se permiten espacios en blanco en el campo de segundo nombre.');
				return false; // Evitar el envío del formulario
			}

			// Verificar espacios en blanco en primerApellido
			if (tieneEspaciosEnBlanco(inputPrimerApellido)) {
				alert('No se permiten espacios en blanco en el campo de primer apellido.');
				return false; // Evitar el envío del formulario
			}

			// Verificar espacios en blanco en segundoApellido
			if (tieneEspaciosEnBlanco(inputSegundoApellido)) {
				alert('No se permiten espacios en blanco en el campo de segundo apellido.');
				return false; // Evitar el envío del formulario
			}
			// Verificar espacios en blanco en segundoApellido
			if (tieneEspaciosEnBlanco(inputNumeroDocumento)) {
				alert('No se permiten espacios en blanco en el campo de numero de documento.');
				return false; // Evitar el envío del formulario
			}
			// Verificar espacios en blanco en segundoApellido
			if (tieneEspaciosEnBlanco(inputTelefono)) {
				alert('No se permiten espacios en blanco en el campo de telefono.');
				return false; // Evitar el envío del formulario
			}


			return true; // Permitir el envío del formulario si no hay espacios en blanco
		}

		function tieneEspaciosEnBlanco(input) {
			return input.value.indexOf(' ') !== -1;
		}
	</script>

</head>

<body>
	<div class="container">
		<div class="container  container-cont">
			<div class="row">
				<div class="col-2 col-md-6 col-sm-6 col-xs-12 col-12">
					<form action="<?= base_url ?>" method="post">
						<button type="submit" class="btn btn-success">Inicio</button>
					</form>
				</div>
				<div class="col-2 col-md-6 col-sm-6 col-xs-12 col-12">
					<form action="<?= base_url ?>aprendiz/crearAprendiz" method="post">
						<button type="submit" class="btn btn-success">Crear</button>
					</form>
				</div>
			</div>
		</div>
		<?php
		if (isset($_SESSION['exito'])) : ?>
			<div class="row d-flex justify-content-center">
				<div class="col-md-4  col-xs-12  col-sm-6 ">
					<div class="alert alert-success d-flex align-items-center containe-2" role="alert">
						<!-- <img src="<?= base_url ?>assets/icons/check-circle-fill.svg" alt="Alerta" class="icon"> -->
						<?php echo $_SESSION['exito']; ?>
						<form action="<?= base_url ?> ">
							<?php unset($_SESSION['exito']); ?>
							<button type="input" class="btn-close red"></button>
						</form>
					</div>
				</div>
			</div>


		<?php endif;
		// unset($_SESSION['exito']);
		?>