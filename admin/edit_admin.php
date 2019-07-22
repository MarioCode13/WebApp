<?php 
include('includes/header.php'); 

//Include functions
include('includes/functions.php');

//check to see if user logged in else redirect to index page
if(!isset($_SESSION['user_is_logged_in'])){
  redirect('../index.php');
}
?>
   
   
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
      </div>
      <div class="col-md-4 col-md-offset-4">
           <form class="form-horizontal" role="form" method="post" action="<?php $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
           
           <?php 
               
               /************** Fetching data from database using id ******************/
                if(isset($_GET['admin_id'])){
                    $admin_id = $_GET['admin_id'];
                }

                //require database class files
                require('includes/pdocon.php');

                //instatiating database objects
                $db = new Pdocon;

                //query to display customer inf
                $db->query("SELECT * FROM admin WHERE id=:id;");

                $db->bindvalue(':id', $admin_id, PDO::PARAM_INT); 

                //Fetch data and display in forms value fields
                $row = $db->fetchSingle();
          
                if($row):
            ?>
               
            <div class="form-group">
            <label class="control-label col-sm-2" for="name"></label>
            <div class="col-sm-10">
              <input type="name" name="name" class="form-control" id="name" value="<?php echo $row['fullname']; ?>" required>
            </div>
          </div>
          
          <div class="form-group">
            <label class="control-label col-sm-2" for="email"></label>
            <div class="col-sm-10">
              <input type="email" name="username" class="form-control" id="email" 
                value="<?php echo $row['email']; ?>" required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="password"></label>
            <div class="col-sm-10"> 
              <input type="password" name="password" class="form-control" id="password" 
                placeholder="Confirm Password" required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="image"></label>
            <div class="col-sm-10">
              <input type="file" name="image" id="image" placeholder="Choose Image">
            </div>
          </div>

          <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-10 text-center">
              <button type="submit" class="btn btn-primary pull-right" 
                name="submit_update">Update</button>
              <a class="pull-left btn btn-danger" href="my_admin.php">Cancel</a>
            </div>
          </div>
          
                <?php endif; ?>
</form>
          
<?php
          
/************** Update data to database using id ******************/  
          
      
//Get field names from from and validate          
if(isset($_POST['submit_update'])){

  $raw_name       =  cleandata(($_POST['name']));
  $raw_email      =  cleandata(($_POST['username']));
  $raw_password   =  cleandata(($_POST['password']));

  $c_name         = sanitize($raw_name);
  $c_email        = valemail($raw_email);
  //$c_password     = sanitize($raw_password);
//Hash password using md5 function
  //$hashed_pass    = hashpassword($c_password);

  //collect image
  $c_img          = $_FILES['image']['name'];
  $c_img_tmp      = $_FILES['image']['tmp_name'];
  //move to permanent location
  move_uploaded_file($c_img_tmp, "uploaded_image/$c_img");


  if($row){


    if(isset($_GET['admin_id'])){
                    
      $admin_id   =   $_GET['admin_id'];
   }

    $db->query('UPDATE admin 
            SET fullname=:fullname, email=:email, password=:password, image=:image
            WHERE id=:id;');

    $db->bindValue(':id', $admin_id, PDO::PARAM_INT);
    $db->bindvalue(':fullname', $c_name, PDO::PARAM_STR);
    $db->bindvalue(':email', $c_email, PDO::PARAM_STR);
    $db->bindvalue(':password', $raw_password, PDO::PARAM_STR);     //hashed pw not working... come back later
    $db->bindvalue(':image', $c_img, PDO::PARAM_STR);


    $run = $db->execute();
    if($run){

      redirect("my_admin.php");

      keepmsg( '<div class="alert alert-success text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>.
            <strong>Success!</strong> Update successfull!
            </div>');
    } else {
      redirect("my_admin.php");

      keepmsg('<div class="alert alert-danger text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>.
            <strong>Sorry</strong>, could not update. Please try again.
            </div>');
    }
  }
}                 

?>
          
         
      </div>
    </div>          
  </div>
</div>
  
<?php include('includes/footer.php'); ?>  