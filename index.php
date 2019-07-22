<html>

<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Log In</title>

    <link href="css/style.css" rel="stylesheet">
</head>


<?php include('includes/header.php'); 

//Include functions
include('admin/includes/functions.php');

//require database connection
require('admin/includes/pdocon.php');
    
//instantiating database objects
$db = new Pdocon;


//process login submission
if(isset($_POST['submit_login'])){
    $raw_username     = cleandata($_POST['username']);
    $raw_passsword    = cleandata($_POST['password']);

    $c_username       = valemail($raw_username);
    $hashed_password  = hashpassword($c_password);

    $db->query("SELECT * FROM admin 
                WHERE email= :email AND password= :password;");

    $db->bindValue(':email', $c_username, PDO::PARAM_STR);
    $db->bindValue(':password', $raw_passsword, PDO::PARAM_STR);


    $row = $db->fetchSingle();
    echo $row['email'];

    if($row){
        
        $d_image      = $row['image'];
        $s_image      = "<img src='uploaded_image/$d_image' class='profile_image' />";
  
        $d_name       = $row['fullname'];

        $_SESSION['user_data'] = array(
          'fullname'    =>   $row['fullname'],
          'id'          =>   $row['id'],
          'email'       =>   $row['email'],
          'image'       =>   $s_image
        ); 
        $_SESSION['user_is_logged_in'] = true;

        redirect('admin/my_admin.php');

        keepmsg('<div class="alert alert-success text-center">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>.
                <strong>Welcome '.$d_name. '.</strong> You are logged in as Admin
                </div>');
    } else {
        echo '<div class="alert alert-danger text-center">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>.
              <strong>Sorry</strong>, incorrect password or user does not exist.
              </div>'; 
    }
}
?>


  <img src="images/gir-logo.png" alt="GIRSA logo" id="logo">
  <div class="row">
      <div class="col-md-4 col-md-offset-4">
          <p class=""><a class="pull-right" href="admin/register_admin.php"> Register</a></p><br>
      </div>
      <div class="col-md-4 col-md-offset-4">
        <form class="form-horizontal" role="form" method="post" action="index.php">
          <div class="form-group">
            <label class="control-label col-sm-2" for="email"></label>
            <div class="col-sm-10">
              <input type="email" name="username" class="form-control" id="email" placeholder="Enter Email" required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="pwd"></label>
            <div class="col-sm-10"> 
              <input type="password" name="password" class="form-control" id="pwd" placeholder="Enter Password" required>
            </div>
          </div>

          <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-10 text-center">
              <button type="submit" class="btn btn-primary text-center" name="submit_login">Login</button>
            </div>
          </div>
        </form>
          
  </div>
</div>
  
  
<?php include('admin/includes/footer.php'); ?>

</html>