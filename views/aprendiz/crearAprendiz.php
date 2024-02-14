<?php
ob_start();
// Calcular la fecha actual menos 18 años
$fechaMaxima = date('Y-m-d', strtotime('-18 years'));
?>
<div class="container">
  <form action="<?= base_url ?>aprendiz/guardarAprendiz" method="post" onsubmit="return validarNombresApellidos()">
    <div class="sm-3">
      <label for="tipoDocumento" class="form-label">Tipo de Documento </label>
      <select class="form-select" id="tipoDocumento" name="tipoDocumento">
        <option selected>ELIGE UNA OPCIÓN</option>
        <option value="0">NO REGISTRA</option>
        <option value="1">CC DE CIUDADANIA</option>
        <option value="2">TI</option>
        <option value="3">REGISTRO CIVIL</option>
        <option value="4">CC EXTRANJERA</option>
        <option value="5">PASAPORTE</option>
      </select>
      <?php if (isset($errores['tipoDocumento'])) : ?>
        <div class="alert alert-danger" role="alert">
          <img src="<?= base_url ?>assets/icons/exclamation-octagon.svg" alt="Alerta">
          <?php echo $errores['tipoDocumento']; ?>
        </div>
      <?php endif;
      if (isset($errores['obligatorios'])) : ?>
        <div class="alert alert-danger" role="alert">
          <img src="<?= base_url ?>assets/icons/exclamation-octagon.svg" alt="Alerta">
          <?php echo $errores['obligatorios']; ?>
        </div>
      <?php endif; ?>
    </div>

    <div class="mb-3">
      <label for="numeroDocumento" class="form-label">Número de Documento </label>
      <input type="text" class="form-control" id="numeroDocumento" name="numeroDocumento" pattern="[0-9]+">
      <?php if (isset($errores['numeroDocumento'])) : ?>
        <div class="alert alert-danger" role="alert">
          <img src="<?= base_url ?>assets/icons/exclamation-octagon.svg" alt="Alerta">
          <?php echo $errores['numeroDocumento']; ?>
        </div>
      <?php endif;
      if (isset($errores['obligatorios'])) : ?>
        <div class="alert alert-danger" role="alert">
          <img src="<?= base_url ?>assets/icons/exclamation-octagon.svg" alt="Alerta">
          <?php echo $errores['obligatorios']; ?>
        </div>
      <?php endif; ?>
    </div>

    <div class="mb-3">
      <label for="primerNombre" class="form-label">Primer Nombre </label>
      <input type="text" class="form-control" id="primerNombre" name="primerNombre" minlength="2" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+">
      <?php if (isset($errores['primerNombre'])) : ?>
        <div class="alert alert-danger" role="alert">
          <img src="<?= base_url ?>assets/icons/exclamation-octagon.svg" alt="Alerta">
          <?php echo $errores['primerNombre']; ?>
        </div>
      <?php endif;
      if (isset($errores['obligatorios'])) : ?>
        <div class="alert alert-danger" role="alert">
          <img src="<?= base_url ?>assets/icons/exclamation-octagon.svg" alt="Alerta">
          <?php echo $errores['obligatorios']; ?>
        </div>
      <?php endif; ?>
    </div>

    <div class="mb-3">
      <label for="segundoNombre" class="form-label">Segundo Nombre </label>
      <input type="text" class="form-control" id="segundoNombre" name="segundoNombre" minlength="2" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+">
      <?php if (isset($errores['segundoNombre'])) : ?>
        <div class="alert alert-danger" role="alert">
          <img src="<?= base_url ?>assets/icons/exclamation-octagon.svg" alt="Alerta">
          <?php echo $errores['segundoNombre']; ?>
        </div>
      <?php endif; ?>
    </div>

    <div class="mb-3">
      <label for="primerApellido" class="form-label">Primer Apellido </label>
      <input type="text" class="form-control" id="primerApellido" name="primerApellido" minlength="2" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+">
      <?php if (isset($errores['primerApellido'])) : ?>
        <div class="alert alert-danger" role="alert">
          <img src="<?= base_url ?>assets/icons/exclamation-octagon.svg" alt="Alerta">
          <?php echo $errores['primerApellido']; ?>
        </div>
      <?php endif;
      if (isset($errores['obligatorios'])) : ?>
        <div class="alert alert-danger" role="alert">
          <img src="<?= base_url ?>assets/icons/exclamation-octagon.svg" alt="Alerta">
          <?php echo $errores['obligatorios']; ?>
        </div>
      <?php endif; ?>
    </div>

    <div class="mb-3">
      <label for="segundoApellido" class="form-label">Segundo Apellido</label>
      <input type="text" class="form-control" id="segundoApellido" name="segundoApellido" minlength="2" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+">
      <?php if (isset($errores['segundoApellido'])) : ?>
        <div class="alert alert-danger" role="alert">
          <img src="<?= base_url ?>assets/icons/exclamation-octagon.svg" alt="Alerta">
          <?php echo $errores['segundoApellido']; ?>
        </div>
      <?php endif; ?>
    </div>
    <div class="mb-3">
      <label for="fechaDeNacimiento" class="form-label">Fecha de Nacimiento </label>
      <input type="date" class="form-control" id="fechaDeNacimiento" name="fechaDeNacimiento" max="<?= $fechaMaxima ?>">

      <?php if (isset($errores['fechaDeNacimiento'])) : ?>
        <div class="alert alert-danger" role="alert">
          <img src="<?= base_url ?>assets/icons/exclamation-octagon.svg" alt="Alerta">
          <?php echo $errores['fechaDeNacimiento']; ?>
        </div>
      <?php endif;
      if (isset($errores['obligatorios'])) : ?>
        <div class="alert alert-danger" role="alert">
          <img src="<?= base_url ?>assets/icons/exclamation-octagon.svg" alt="Alerta">
          <?php echo $errores['obligatorios']; ?>
        </div>
      <?php endif; ?>
        <br>
      <div class="sm-3">
        <label for="sexo" class="form-label">Sexo </label>
        
        <select class="form-select" id="sexo" name="sexo">

          <option selected>ELIGE UNA OPCIÓN</option>
          <option value="0">NO BINARIO</option>
          <option value="1">MASCULINO</option>
          <option value="2">FEMENINO</option>
        </select>
        <br>
        <?php if (isset($errores['sexo'])) : ?>
          <div class="alert alert-danger" role="alert">
            <img src="<?= base_url ?>assets/icons/exclamation-octagon.svg" alt="Alerta">
            <?php echo $errores['sexo']; ?>
          </div>
        <?php endif;
        if (isset($errores['obligatorios'])) : ?>
          <div class="alert alert-danger" role="alert">
            <img src="<?= base_url ?>assets/icons/exclamation-octagon.svg" alt="Alerta">
            <?php echo $errores['obligatorios']; ?>
          </div>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="telefono" class="form-label">Celular </label>
        <input type="text" class="form-control" id="telefono" name="telefono" minlength="7" pattern="[0-9]+">
        <?php if (isset($errores['telefono'])) : ?>
          <div class="alert alert-danger" role="alert">
            <img src="<?= base_url ?>assets/icons/exclamation-octagon.svg" alt="Alerta">
            <?php echo $errores['telefono']; ?>
          </div>
        <?php endif;
        if (isset($errores['obligatorios'])) : ?>
          <div class="alert alert-danger" role="alert">
            <img src="<?= base_url ?>assets/icons/exclamation-octagon.svg" alt="Alerta">
            <?php echo $errores['obligatorios']; ?>
          </div>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="direccion" class="form-label">Direccion </label>
        <input type="text" class="form-control" id="direccion" name="direccion" pattern="[A-Za-z0-9\s,.'-#]*">
        <?php if (isset($errores['direccion'])) : ?>
          <div class="alert alert-danger" role="alert">
            <img src="<?= base_url ?>assets/icons/exclamation-octagon.svg" alt="Alerta">
            <?php echo $errores['direccion']; ?>
          </div>
        <?php endif;
        if (isset($errores['obligatorios'])) : ?>
          <div class="alert alert-danger" role="alert">
            <img src="<?= base_url ?>assets/icons/exclamation-octagon.svg" alt="Alerta">
            <?php echo $errores['obligatorios']; ?>
          </div>
        <?php endif; ?>
      </div>
      <!-- aquí vamos con el formulario del registro -->
      <button type="submit" class="btn btn-primary">Guardar</button>
  </form>
</div>