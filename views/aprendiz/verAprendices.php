<!-- tabla -->
<div class="container">
  <div class="table">
    <table class="table">
      <thead>
        <tr>
          
         
          <th scope="col">Primer Nombre</th>
          <th scope="col">Primer Apellido</th>
          <th scope="col">Ver</th>
          <th scope="col">Editar</th>
          <th scope="col">Eliminar</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($aprendices as $apr) : ?>
          <!-- $aprendices es el array asociativo con la consulta en la base de datos, $apr, se usa para 
          indicar que es un aprendiz individual-->
          <tr>
            
           
            <td><?= $apr['primerNombre']; ?></td>
            <td><?= $apr['primerApellido']; ?></td>
            <td><a href="<?= base_url ?>aprendiz/verAprendiz&id=<?= $apr['id']; ?>" class="btn btn-info">Ver</a></td>
            <td><a href="<?= base_url ?>aprendiz/editarAprendiz&id=<?= $apr['id']; ?>" class="btn btn-warning">Editar</a></td>
            <td><a href="<?= base_url ?>aprendiz/eliminarAprendiz&id=<?= $apr['id']; ?>" class="btn btn-danger">Eliminar</a></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>