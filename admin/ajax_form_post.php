<?php include('includes/header.php'); 

//Include functions
include('includes/functions.php');

?>

<?php 

/****************Get  customer info to ajax *******************/

//require database class files
require('includes/pdocon.php');

//instatiating database object
$db = new Pdocon;

//stametment to check if a field coming from ajax post is set,then Create query to update user 
if(isset($_POST['c_id'])){
    
    $id             =   $_POST['c_id'];
    $raw_amount     =   cleandata($_POST['salary']);
    $c_amount       =   valint($raw_amount);

    $db->query('UPDATE users SET spending_amount =:spending WHERE id=:id ');

    //Bind id coming from the ajax data
    $db->bindvalue(':id', $id, PDO::PARAM_INT);
    $db->bindvalue(':spending', $c_amount, PDO::PARAM_INT);

    //Execute
    $row = $db->execute();

    //send echo message to ajax
        if($row){

            echo "<p class='bg-success text-center' style='font-weight:bold;'>User Updated </p>";
    
        }else{
                
            echo "<p class='bg-danger text-center'>User Update not Successfull</p>";
                
        }    
}            

        

?>