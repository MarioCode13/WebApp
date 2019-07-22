<?php include('includes/header.php'); 

//Include functions
include('includes/functions.php');

//Get id and store in variable
$id =   $_GET["cid"];

/****************Get  customer info to ajax *******************/

//require database class files
require('includes/pdocon.php');

//instatiating database object
$db = new Pdocon;

//Query to display customer info
$db->query('SELECT * FROM users WHERE id=:id');

//Bind id
$db->bindValue(':id', $id, PDO::PARAM_INT);

//Fetch data and store in row variable
$row = $db->fetchSingle();

//Display result to ajax
    if($row){
        
        echo '  <div  class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr >
                                <th class="text-center">Name</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                           <tr class="text-center">
                            <td>' . $row['fullname'] . '</td>
                            <td>$ ' . $row['spending_amount'] . '</td>
                            <td>' . $row['email'] . '</td>
                          </tr>

                        </tbody>
                    </table>
                </div>';
    }



?>