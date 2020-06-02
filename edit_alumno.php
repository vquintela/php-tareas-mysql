<?php
include("db.php");

if  (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "SELECT * FROM alumno WHERE id=$id";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $nombre = $row['nombre'];
    $apellido = $row['apellido'];
  }
}

if (isset($_POST['update'])) {
  $id = $_GET['id'];
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];

  $query = "UPDATE alumno set nombre = '$nombre', apellido = '$apellido' WHERE id=$id";
  mysqli_query($conn, $query);
  $_SESSION['message'] = 'Alumno Actualizado';
  $_SESSION['message_type'] = 'warning';
  header('Location: alumnos.php');
}

?>
<?php include('includes/header.php'); ?>
<div class="container p-4">
  <h1 class="text-center">Editar Tarea</h1>
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
      <form action="edit_alumno.php?id=<?php echo $_GET['id']; ?>" method="POST">
        <div class="form-group">
          <input name="nombre" type="text" class="form-control" value="<?php echo $nombre; ?>" />
        </div>
        <div class="form-group">
          <input name="apellido" type="text" class="form-control" value="<?php echo $apellido; ?>" />
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
