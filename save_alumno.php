<?php

include('db.php');

if (isset($_POST['save_alumno'])) {
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $email = $_POST['email'];
  $query = "INSERT INTO alumno (nombre, apellido, email) VALUES ('$nombre', '$apellido', '$email')";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Alumno Guardado';
  $_SESSION['message_type'] = 'success';
  header('Location: alumnos.php');

}

?>
