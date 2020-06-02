<?php include("db.php"); ?>

<?php include('includes/header.php'); ?>

<main class="container p-4">
  <div class="row justify-content-md-center">
    <div class="col-md-4">
    <h1 class="text-center">Ingrese Tarea</h1>
      <!-- ADD TASK FORM -->
      <div class="card card-body">
        <form action="save_task.php" method="POST">
          <div class="form-group">
            <input type="text" name="titulo" class="form-control" placeholder="Titulo Tarea" autofocus>
          </div>
          <div class="form-group">
            <input class="form-control" type="date" name="tiempo"/>
          </div>
          <div class="form-group">
            <textarea name="descripcion" rows="2" class="form-control" placeholder="Descripcion Tarea"></textarea>
          </div>
          <div class="form-group">
            <textarea name="observacion" rows="2" class="form-control" placeholder="Observacion Tarea"></textarea>
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
          <input type="submit" name="save_task" class="btn btn-success btn-block" value="Guardar Tarea">
        </form>
      </div>
    </div>
</main>
<?php include('includes/footer.php'); ?>