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


$query = "SELECT * FROM alumno WHERE id = '$id_alumno'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result); 
$nombre = $row['nombre'];
$apellido = $row['apellido'];
$email = $row['email'];
$asunto = $titulo;
$comentario = $descripcion;

$body = "<h3><b>Se le asigno la siguiente tarea</b></h3><br><br>"
        . "<b>Descripcion: </b>" . $comentario . "<br><br>"
        . "<b>Fecha limite de entrega: </b>" . $tiempo . "<br><br>"
        . "Muchas Gracias!<br>";
        

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'consultashidroflores@gmail.com';           // SMTP username
    $mail->Password   = 'Hidro2019';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('consultashidroflores@gmail.com', 'TP_Final');
    $mail->addAddress($email);     // Add a recipient
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $asunto;
    $mail->Body    = $body;
    $mail->send();
    echo 'Mensaje enviado correctamente';
} catch (Exception $e) {
    echo "mensaje incorrecto: {$mail->ErrorInfo}";
}

?>
