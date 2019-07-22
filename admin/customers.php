<?php include('includes/header.php'); 

//Include functions
include('includes/functions.php');


/************** Fetching all data from database ******************/


//require database class files
require('includes/pdocon.php');


//instatiating database objects
$db = new Pdocon;

$db->query('SELECT * FROM users');

$results = $db->fetchMultiple();

?>


  <div class="container">

   <?php showmsg(); ?>
   
  <div class="jumbotron">
  
  <small class="pull-right"><a href="register_user.php"> Add Customer </a> </small>
 
  <?php echo $_SESSION['user_data']['fullname'] ?> | Admin
    
    <h2 class="text-center">Customers</h2> <hr>
    <br>
     <table class="table table-bordered table-hover text-center">
        <thead >
          <tr>
            <th class="text-center">User ID</th>
            <th class="text-center">Full Name</th>
            <th class="text-center">Spending</th>
            <th class="text-center">Email</th>
            <th class="text-center">Password</th>
            <th class="text-center">Report</th>
          </tr>
        </thead>
        <tbody>
    <?php  foreach($results as $result) : ?>
          <tr>
            <td><?php echo $result['id'] ?></td>
            <td><?php echo $result['fullname'] ?></td>
            <td><?php echo $result['spending_amount'] ?></td>
            <td><?php echo $result['email'] ?></td>
            <td><?php echo '*********' ?></td>
            <td><a href="reports.php?cus_id=<?php echo $result['id'] ?>" class='btn btn-primary'>View Report</a></td>
            <td><a href="edit.php?cus_id=<?php echo $result['id'] ?>" class='btn btn-danger'>Edit</a></td>   
          </tr>
          
          <?php endforeach ; ?>
        </tbody>
     </table>
</div>
  </div>
  
</div>
  
  
<?php include('includes/footer.php'); ?>