<?php include('db.php') ?>
<?php include('header.php'); ?>  
<?php

if(isset($_GET['edit'])){
  $objConexion = new db();
  $id = $_GET['edit'];  
  $sqlSelect = "SELECT * FROM `task` WHERE `task`.`id` =".$id;
  $result = $objConexion->consulta($sqlSelect);      
}

if($_POST){     
  $objConexion = new db();  
  $title = $_POST['title'];
  $desc = $_POST['description'];
  $id = $_POST['postId'];  
  $sql = "UPDATE `task` SET `title` = '$title', `description` = '$desc' WHERE `task`.`id` =".$id;  
  $result = $objConexion->ejecutar($sql);     
  $_SESSION['message'] = 'Se actualizó la tarea correctamente';
  $_SESSION['color'] = 'warning'; 
  header("location:../index.php");
}

  
?>
  
  <div class="container">
    <div class="row mt-5 d-flex justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            Datos del proyecto
            <ion-icon name="heart"></ion-icon>
          </div>
          <div class="card-body">
            <form action="edit_task.php" method="POST" enctype="multipart/form-data">
              Título de la Tarea
              <input required class="form-control" type="text" value="<?php echo $result[0]['title'] ?>" name="title" >             
              <br/>
              Descripción
              <textarea class="form-control mb-2" name="description" id="" cols="30" rows="3"><?php echo $result[0]['description'] ?></textarea>
              <input type="hidden" id="" name="postId" value="<?php echo $result[0]['id'] ?>" />
              <button class="btn btn-success" type="submit">Actualizar Datos</button>
            </form>    
          </div>  
        </div>
      </div>
    </div>
  </div>
<?php include('./footer.php'); ?>  
