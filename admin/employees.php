<html>

<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Employees</title>

    <link href="../css/homestyle.css" rel="stylesheet">
</head>


<?php include('includes/header.php'); 

//Include functions
include('admin/includes/functions.php'); ?>

<body>

<?php 
/************** Fetching all data from database ******************/


//require database class files
require('includes/pdocon.php');


//instatiating database objects
$db = new Pdocon;

$db->query('SELECT * FROM employees');

$results = $db->fetchMultiple();

?>

<div class="container">

<div class="jumbotron">

<small class="pull-right"><a href="add_employee.php"> Add Employee </a> </small>

<?php echo $_SESSION['user_data']['fullname'] ?> | Admin
 
 <h2 class="text-center">Employees</h2> <hr>
 <br>
  <table class="table table-bordered table-hover text-center">
     <thead >
       <tr>
         <th class="text-center">Employee ID</th>
         <th class="text-center">Name</th>
         <th class="text-center">Surname</th>
         <th class="text-center">Address</th>
         <th class="text-center">Job Description</th>
       </tr>
     </thead>
     <tbody>
 <?php  foreach($results as $result) : ?>
       <tr>
         <td><?php echo $result['employee_id'] ?></td>
         <td><?php echo $result['first_name'] ?></td>
         <td><?php echo $result['surname'] ?></td>
         <td><?php echo $result['address'] ?></td>
         <td><?php echo $result['job_description'] ?></td>
         
       </tr>
       
       <?php endforeach ; ?>
     </tbody>
  </table>
</div>
</div>

</div>


</body>
<?php include('includes/footer.php'); ?>

</html>