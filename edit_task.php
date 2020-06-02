<?php
include("db.php");

if  (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "SELECT * FROM tarea WHERE id=$id";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $titulo = $row['titulo'];
    $descripcion = $row['descripcion'];
    $tiempo = $row['tiempo'];
    $observacion = $row['observacion'];
    $id_alumno = $row['id_alumno'];
  }
}

if (isset($_POST['update'])) {
  $id = $_GET['id'];
  $titulo = $_POST['titulo'];
  $descripcion = $_POST['descripcion'];
  $tiempo = $_POST['tiempo'];
  $observacion = $_POST['observacion'];
  $id_alumno = $_POST['id_alumno'];

  $query = "UPDATE tarea set titulo = '$titulo', descripcion = '$descripcion', tiempo = '$tiempo', observacion = '$observacion', id_alumno = '$id_alumno' WHERE id=$id";
  mysqli_query($conn, $query);
  $_SESSION['message'] = 'Tarea Actualizada';
  $_SESSION['message_type'] = 'warning';
  header('Location: index.php');
}

?>
<?php include('includes/header.php'); ?>
<div class="container p-4">
  <h1 class="text-center">Editar Tarea</h1>
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
      <form action="edit_task.php?id=<?php echo $_GET['id']; ?>" method="POST">
        <div class="form-group">
          <input name="titulo" type="text" class="form-control" value="<?php echo $titulo; ?>" />
        </div>
        <div class="form-group">
          <input name="tiempo" type="date" class="form-control" value="<?php echo $tiempo; ?>" />
        </div>
        <div class="form-group">
          <textarea name="descripcion" class="form-control" cols="30" rows="3"><?php echo $descripcion;?></textarea>
        </div>
        <div class="form-group">
          <textarea name="observacion" class="form-control" cols="30" rows="3"><?php echo $observacion;?></textarea>
        </div>
        <div class="form-group">
          <select class="form-control" name="id_alumno">
            <?php 
            $query = "SELECT * FROM alumno";
            $result_tasks = mysqli_query($conn, $query);    
  
            while($row = mysqli_fetch_assoc($result_tasks)) { ?>
              <option value="<?php echo $row['id']?>"><?php echo $row['apellido']?></option>
            <?php } ?>
          </select>
        </div>
        <button class="btn btn-success" name="update">
          Editar
        </button>
      </form>
      </div>
    </div>
  </div>
</div>
<?php include('includes/footer.php'); ?>
