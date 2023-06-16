<?php include('includes/db.php') ?>
<?php include('includes/header.php'); ?>  
<?php 
    if(isset($_POST['guardar_tarea'])){      
      $objConexion = new db();
      $title = $_POST['title'];
      $desc = $_POST['description'];
      $sql = "INSERT INTO `task` (`id`, `title`, `description`, `create_at`) VALUES (NULL, '$title', '$desc', NULL);";
      $result = $objConexion->ejecutar($sql);   
      $_SESSION['message'] = 'Tarea Guardada';
      $_SESSION['color'] = 'primary';
      header("location:index.php");
    }
    
    if($_GET){
      $objConexion = new db();
      $id = $_GET['borrar'];
      $sql = "DELETE FROM `task` WHERE `task`.`id` =".$id;
      $objConexion->ejecutar($sql);
      $_SESSION['message'] = 'Se borró el registro correctamente';
      $_SESSION['color'] = 'danger';
      header("location:index.php");
    }    

    if(isset($_POST['clear_session'])){      
      unset($_SESSION['message']);
    }
    //Recuperamos los datos desde la base de datos
    $objConexion = new db();
    $sql = "SELECT * FROM `task`";
    $resultado = $objConexion->consulta($sql);
    

?>
  <div class="container">  
    <div class="row mt-4">
      <div class="col-md-6">   
      <?php if(isset($_SESSION['message'])) {?>   
        <div class="alert d-flex justify-content-between alert-<?= $_SESSION['color'] ?>" role="alert">
          <?= $_SESSION['message'];?>     
          <form action="index.php" method="POST" enctype="multipart/form-data">                 
            <input type="hidden" id="" name="postId" value="cerrar" />
            <button class="btn-close" type="submit" name="clear_session"  aria-label="Close"></button>            
          </form>   
        </div>
      <?php  } ?>      
        <div class="card">          
          <div class="card-header">
            Datos del proyecto
            <ion-icon name="heart"></ion-icon>
          </div>          
          <div class="card-body">
            <form action="index.php" method="POST" enctype="multipart/form-data">
            Título de la Tarea
              <input required autofocus class="form-control" type="text" name="title" placeholder="Título de la Tarea" >              
              <br/>
              Descripcion
              <textarea required class="form-control mb-2" name="description" cols="30" rows="3" placeholder="Descripción de la tarea"></textarea>
              <button class="btn btn-success" type="submit" name="guardar_tarea">Guardar Tarea</button>
            </form>    
          </div>  
        </div>
      </div>
      <div class="col-md-5">
        <div class="table-responsive">
          <table class="table table-primary">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Título</th>                
                <th scope="col">Descripcion</th>
                <th scope="col">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($resultado as $proyecto){ ?>
              <tr class="">
                <td scope="row"><?php echo $proyecto['id']?></td>
                <td><?php echo $proyecto['title']?></td>                
                <td><?php echo $proyecto['description']?></td>
                <td>
                  <a name="" href="?borrar=<?php echo $proyecto['id'];?>" class="btn btn-primary" role="button">
                    <ion-icon name="trash-outline"></ion-icon>
                  </a>
                  <a name="" href="includes/edit_task.php?edit=<?php echo $proyecto['id'];?>" class="btn btn-primary" role="button">
                    <ion-icon name="create-outline"></ion-icon>
                  </a>
                </td>
              </tr>
              <?php }?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>
    

  



<?php include('includes/footer.php'); ?>  