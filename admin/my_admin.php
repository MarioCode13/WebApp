<?php include('includes/header.php'); ?>

<?php

//Include functions
include('includes/functions.php');
//user logged in else redirect to index
if(!isset($_SESSION['user_is_logged_in'])){
    redirect('../index.php');
}

?>

<?php 
/************** Fetching data from database using id ******************/

//require database class files
require('includes/pdocon.php');

//instantiating database objects
$db = new Pdocon;


//query to select all users
   
$db->query("SELECT * FROM admin WHERE email=:email;");
$email  = $_SESSION['user_data']['email'];
$db->bindvalue(':email', $email, PDO::PARAM_STR);
    

//fetching data
$row = $db->fetchSingle();
?>


  <div class="well well-sm">
   
  <small class="pull-right"><a href="customers.php"> View Customers</a> </small>
 
  <?php //admin name via SESSION
  $fullname = $_SESSION['user_data']['fullname'];
    
    echo '<small class="pull-left" style="color:#337ab7;"> '. $fullname.' | Veiwing / Editing</small>';
?>
    
    <h2 class="text-center">My Account</h2><br>
   </div>
   
<div class="container"> 
   <div class="rows">
     
      <?php //session message on top of page 
        showmsg();
      ?>
      
     <div class="col-md-9">
         
          <?php  // loop through results
            if($row){
          ?>
          
          <br>
           <form class="form-horizontal" role="form" method="post" action="">
            <div class="form-group">
            <label class="control-label col-sm-2" for="name" style="color:#f3f3f3;">Fullname:</label>
            <div class="col-sm-10">
              <input type="name" name="name" class="form-control" id="name" 
                          value="<?php echo $row['fullname'] ?>" required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="email" style="color:#f3f3f3;">Email:</label>
            <div class="col-sm-10">
              <input type="email" name="email" class="form-control" id="email" 
                        value="<?php echo $row['email'] ?>" required>
            </div>
          </div>
          <div class="form-group ">
            <label class="control-label col-sm-2" for="password" style="color:#f3f3f3;">Password:</label>
            <div class="col-sm-10">
             <fieldset disabled> 
              <input type="password" name="password" class="form-control disabled" id="password" 
                        value="<?php echo $row['password'] ?>" required>
             </fieldset> 
            </div>
          </div>
         <br>
          <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-10">
                <a class="btn btn-primary" 
                    href="edit_admin.php?admin_id=<?php echo $row['id']; ?>">Edit</a>
                <button type="submit" class="btn btn-danger pull-right" 
                  name="delete_form">Delete</button>
            </div>
          </div>         
        </form>

        
  </div>
       <div class="col-md-3">
           <div style="padding:15px";>
             <div class="thumbnail" >
              <a href="edit_admin.php?admin_id=<?php echo $row['id']; ?>">
               

              <?php 
                
                // get image, put in variable
                $image = $row['image'];
                   
                //add styling and call
                echo '<img src="uploaded_image/'.$image.'"style="width:200px;height:200px">';
                ?> 
              </a>
              <h4 class="text-center"><?php //echo fullname of admin  ?></4>
            </div>
           </div>
       </div>
       
       <?php
       };
        ?>
       
  </div>  

</div>

<?php 
  
/************** Deleting data from database when delete button is clicked ******************/  
      
      
//confirmation message for delete       
if(isset($_POST['delete_form'])){
    $admin_id = $_SESSION['user_data']['id'];

    keepmsg('<div class="alert alert-danger text-center">

              <strong>Confirm</strong>, are you sure you want to delete your account?<br>
                  <div>
                  
                    <form method = "post" action = "my_admin.php" style="display:inline">
                      <input type="hidden" value=" '. $admin_id.' " name ="id">
                      <input type="submit" name="delete_admin" value="Yes" class="btn btn-success btn-sm">
                      <a href="#" class="btn btn-danger btn-sm" data-dismiss="alert" aria-label="close">No</a>
                    </form>
                  </div>
          </div>'
      );
}



//If Yes, Delete
if(isset($_POST['delete_admin'])){
    $id = $_POST['id'];
    $db->query('DELETE FROM admin WHERE id=:id;');
    $db->bindvalue(':id',$id, PDO::PARAM_INT);
    $run = $db->execute();
    if($run){
      redirect('logout.php');
    } else {
      keepmsg('<div class="alert alert-danger text-center">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>.
              <strong>Sorry</strong>, user could not be deleted.
              </div>');
    }
}   
?>

         
         
    </div> 
  </div>  
</div>

<?php include('includes/footer.php'); ?>