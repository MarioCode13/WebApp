<html>

<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Home</title>

    <link href="../css/homestyle.css" rel="stylesheet">
    <style>

        .image {
            box-sizing: border-box;
            display: block;
            width: 300px;
            height: auto;
            margin-left: auto;
            margin-right: auto;
            }
        .column {
            float: left;
            width: 33.3%;
            padding: 5px;
            position:relative;
            }
        .row::after {
            content: "";
            clear: both;
            display: table;
            }
        .overlay {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            height: 330px;
            width: 73%;
            opacity: 0;
            transition: .5s ease;
            background-color: blueviolet; 
            margin-left: auto;
            margin-right: auto;
            }
        .column:hover .overlay {
            opacity: 1;
            }
        .column:hover .image {
            opacity 0.0;
            }
        .text {
            color: white;
            font-size: 40px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            }
    </style>
</head>


<?php include('includes/header.php'); 

//Include functions
include('admin/includes/functions.php'); ?>

<body>
    <h1 id="home-header"> Home</h1>
    <img src="../images/gir-logo.png" alt="GIRSA logo" id="logo">
    <br>
<div class="row">
    <div class="column">
        <a href="customers.php">
            <img src="../images/customers.png" class="image">
            <div class="overlay">
                <div class="text">Customers</div>
            </div>
    </div>
    <div class="column">
        <a href="employees.php">
            <img src="../images/employee.png" class="image" style="width:270px; margin-top: 20px;">
            <div class="overlay">
                <div class="text">Employees</div>
            </div>
    </div>
    <div class="column">
        <a href="reportpage.php">
            <img src="../images/report.png" class="image" style="width:240px; margin-top: 40px;">
            <div class="overlay">
                <div class="text">Reports</div>
            </div>
                
</div>
<p style="clear: both;">

</body>
<?php include('includes/footer.php'); ?>

</html>