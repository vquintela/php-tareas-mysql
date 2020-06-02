<?php

include('db.php');

if (isset($_POST['save_task'])) {
  $titulo = $_POST['titulo'];
  $descripcion = $_POST['descripcion'];
  $tiempo = $_POST['tiempo'];
  $observacion = $_POST['observacion'];
  $id_alumno = $_POST['id_alumno'];
  $query = "INSERT INTO tarea(titulo, descripcion, tiempo, observacion, id_alumno) VALUES ('$titulo', '$descripcion', '$tiempo', '$observacion', '$id_alumno')";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Tarea Guardada';
  $_SESSION['message_type'] = 'success';
  header('Location: index.php');

}

?>
