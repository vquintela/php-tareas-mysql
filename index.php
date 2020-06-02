<?php include("db.php"); ?>

<?php include('includes/header.php'); ?>

<main class="container p-4">
  <div class="row justify-content-md-center">
      <!-- MESSAGES -->
      <?php if (isset($_SESSION['message'])) { ?>
      <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['message']?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php session_unset(); } ?>
    <div class="col-md-12">
      <h1 class="text-center">Listado de Tareas</h1>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Titulo</th>
            <th>Descripcion</th>
            <th>Creado</th>
            <th>Tiempo Tarea</th>
            <th>Integrante</th>
            <th>Observaciones</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $query = "SELECT * FROM tarea";
          $result_tasks = mysqli_query($conn, $query);    

          while($row = mysqli_fetch_assoc($result_tasks)) { ?>
          <tr>
            <td><?php echo $row['titulo']; ?></td>
            <td><?php echo $row['descripcion']; ?></td>
            <td><?php echo $row['creado']; ?></td>
            <td><?php echo $row['tiempo']; ?></td>
            <?php 
              $id = $row['id_alumno'];
              $query = "SELECT * FROM alumno where id='$id'";
              $result = mysqli_query($conn, $query);
              $row2 = mysqli_fetch_assoc($result) 
            ?><td><?php echo $row2['apellido']; ?></td>
            <td><?php echo $row['observacion']; ?></td>
            <td>
              <a href="edit_task.php?id=<?php echo $row['id']?>" class="btn btn-secondary">
                <i class="fas fa-marker"></i>
              </a>
              <a href="delete_task.php?id=<?php echo $row['id']?>" class="btn btn-danger">
                <i class="far fa-trash-alt"></i>
              </a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</main>

<?php include('includes/footer.php'); ?>
