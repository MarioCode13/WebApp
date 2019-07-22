<html>

<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Reports</title>

    <link href="../css/homestyle.css" rel="stylesheet">
</head>


<?php include('includes/header.php'); 

//Include functions
include('admin/includes/functions.php');

//require database class files
require('includes/pdocon.php');


//instatiating database objects
$db = new Pdocon;

$db->query('SELECT p.fund_id, p.fund_name, a.id, a.name, pa.holdings, pa.eff_weight
            FROM asset a, portfolio_asset pa, portfolio p
            WHERE a.id = pa.asset_id
            AND pa.fund_id = p.fund_id
            ORDER BY p.fund_id, pa.eff_weight DESC;');

$results = $db->fetchMultiple();

?>

<body>
    <h1 id="home-header"> Reports</h1>

    <div>
        <table class="table table-bordered table-hover text-center">
            <thead >
            <tr>
                <th class="text-center">Fund ID</th>
                <th class="text-center">Fund Name</th>
                <th class="text-center">Asset ID</th>
                <th class="text-center">Asset Name</th>
                <th class="text-center">Holdings</th>
                <th class="text-center">Effective Weight(%)</th>
            </tr>
            </thead>
            <tbody>
        <?php  foreach($results as $result) : ?>
            <tr>
                <td><?php echo $result['p.fund_id'] ?></td>
                <td><?php echo $result['p.fund_name'] ?></td>
                <td><?php echo $result['a.id'] ?></td>
                <td><?php echo $result['a.name'] ?></td>
                <td><?php echo $result['pa.holdings'] ?></td>
                <td><?php echo $result['pa.eff_weight'] ?></td>
            </tr>
            
            <?php endforeach ; ?>
            </tbody>
        </table>
    </div>





</body>
<?php include('includes/footer.php'); ?>

</html>

<!-- next to implement = individual reports per customer instead of all in one -->