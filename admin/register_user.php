<?php include('includes/header.php'); 

//Include functions
include('includes/functions.php');
//check to see if user logged in else redirect to index page
if(!isset($_SESSION['user_is_logged_in'])){
    redirect('../index.php');
}


/************** Register new customer ******************/


//require or include database connection file
require('includes/pdocon.php');
    
//instantiating database objects
$db = new Pdocon;

//Collect and clean values from the form
if(isset($_POST['submit_user'])){
  $raw_name           =   cleandata(($_POST['name']));
  $raw_amount         =   cleandata(($_POST['amount']));
  $raw_email          =   cleandata(($_POST['email']));
  $raw_password       =   cleandata(($_POST['password']));

  $c_name         = sanitize($raw_name);
  $c_amount       = valint($raw_amount);
  $c_email        = valemail($raw_email);

  //Check and see if user already exist in database using email so write query and bind email
  $db->query('SELECT * FROM admin WHERE email = :email');
  $db->bindvalue(':email',$c_email,PDO::PARAM_STR);

  //Call function to count row
  $row = $db->fetchSingle(); 

  //Display error if customer exist 
    if($row){
      redirect('customers.php');    
      
      keepmsg('<div class="alert alert-danger text-center">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Sorry!</strong> Customer already exists.
                </div>');
    } else {
    //Write query to insert values, bind values
    $db->query('INSERT INTO users(id, email, password, fullname, spending_amount) 
                        VALUES (NULL, :email, :password, :fullname, :spending );');

    $db->bindvalue(':fullname',$c_name, PDO::PARAM_STR);
    $db->bindvalue(':email',$c_email, PDO::PARAM_STR);
    $db->bindvalue(':password',$raw_password, PDO::PARAM_STR);
    $db->bindvalue(':spending',$c_amount, PDO::PARAM_INT);


    //Execute and assign a varaible to the execution result
    $run = $db->execute();

    //Comfirm execute and display error or success message
    if($run){
        redirect('customers.php');

        keepmsg('<div class="alert alert-success text-center">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Success!</strong> Customer registered
                  </div>');
    } else {
        redirect('customers.php');    

        keepmsg('<div class="alert alert-danger text-center">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Sorry!</strong> Customer registration unsuccessful
                  </div>');
    }
  }            

}

?>

  
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
          <p class="pull-right" style="color:#777"> Adding Customer in Database</p><br>
      </div>
      <div class="col-md-4 col-md-offset-4">
           <form class="form-horizontal" role="form" method="post" action="register_user.php">
            <div class="form-group">
            <label class="control-label col-sm-2" for="name"></label>
            <div class="col-sm-10">
              <input type="name" name="name" class="form-control" id="name" placeholder="Enter Full Name" required>
            </div>
          </div>
            <div class="form-group">
            <label class="control-label col-sm-2" for="salary"></label>
            <div class="col-sm-10">
              <input type="text" name="amount" class="form-control" id="country" placeholder="Enter Amount" required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="email"></label>
            <div class="col-sm-10">
              <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="pwd"></label>
            <div class="col-sm-10"> 
              <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password" required>
            </div>
          </div>

          <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-10">
              <div class="checkbox">
                <label><input type="checkbox" required> Accept</label>
              </div>
            </div>
          </div>

          <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-10 text-center">
              <button type="submit" class="btn btn-primary pull-right" 
                  name="submit_user">Register</button>
              <a class="pull-left btn btn-danger" href="customers.php"> Cancel</a>
            </div>
          </div>
</form>
          
  </div>
</div>
          
  </div>
</div>
  
<?php include('includes/footer.php'); ?>  