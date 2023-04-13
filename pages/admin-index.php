<!DOCTYPE html>
<html lang="en" style="height: 100%;">
<?php 
//TODO - CONNECT SESSION
    @session_start();      //? START TO SESSION
    error_reporting(0);    //? SHOW NO ERRORS
    ini_set('display_errors', 0);
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/_fonts.css">
	<link rel="stylesheet" href="../assets/styles/_base.css">
    <link rel="stylesheet" href="../assets/styles/style.css">
    <!-- STYLE RESET -->
        <style>
            ::-webkit-scrollbar-thumb {
              background: #fe6a34;
            }

            ::-webkit-scrollbar-thumb:hover {
              background: #fe6a34;
            }
        </style>
    <!-- / STYLE RESET -->
    <title>admin - <?= $_SESSION['name'] ?></title>
</head>
<body style="height: 100%;">
<?php 
//TODO CHECK IF USER CONNECTED
    if(!empty($_SESSION)){
?>
<!-- HEADER IF CONNECTED -->
    <header class="admin-header">
	  <div class="container">
	    <h1 style="font-size:35px;font-weight:800;color: white;width: auto;">
	      ESSMEI  &nbsp;&nbsp;—&nbsp;&nbsp; ADMIN
	    </h1>
	    <nav>
	        <p style="color:white"><?= $_SESSION['name'] ?></p>
		  	<a href="../GoogleAuth/backend/disconnect.php">
			<p>Disconnect</p>
		  	</a>
	    </nav>
	</header>
<!-- / HEADER IF CONNECTED -->

<!-- ADMIN SECTION -->
    <section class="admin">
        <table class="admin-table">
            <thead>
            <th>ID</th><th>Catergory</th><th>Name</th><th>Price</th><th>Quantity</th><th>Image</th>
            <th style="font-weight: 800;border-left: 2px solid #fe6a34;border-right: 2px solid #fe6a34;box-sizing: border-box;" colspan="2">------Admin tools------</th>
            </thead>
            <tbody>
            <?php 
            require_once("../backend/db_connect.php");
            $output = '';

			//TODO - SHOW PRODUCTS FROM DB ---//
            $SHOW_ADMIN_TABLE = "SELECT * FROM products ORDER BY prod_id";

			$query = $connection->query($SHOW_ADMIN_TABLE);
			while ($row = $query->fetch_assoc()) 
            {
                echo "<tr>";
			    foreach ($row as $key => $value) 
                {
                    if($key == "prod_image"){
                        echo "<td>";
                        echo "<img src='../".$value."' height='65px'>";
                        echo "</td>";
                    }
                    else{
                        echo "<td>";
                        echo "<p>".$value."</p>";
                        echo "</td>";
                    }
                }
                echo "<td style='border-left: 2px solid #fe6a34;box-sizing: border-box;'>";
                        $params = 'prod_id='.$row['prod_id'].'&prod_name='.$row['prod_name'].'&prod_price='.$row['prod_price'].'&prod_image='.$row['prod_image'].'&prod_category='.$row['prod_category'].'&prod_quantity='.$row['prod_quantity'];
                        echo "<a href='../pages/modifyProd.php?".$params."'style='color:black;'>Modify</a>";
                echo "</td>";
                echo "<td style='border-right: 2px solid #fe6a34;box-sizing: border-box;'>";
                        echo "<a href='../backend/admin-delete.php?prod_id=$row[prod_id]' style='color:black;'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
        </table>
        <a href="../pages/addTo_DB.php" class="btn-add">Add item</a>
    </section>
   
<!-- / ADMIN SECTION -->

<!-- IF NOT CONNECTED SEND TO index.php -->
    <?php }else{ echo '<script>window.location.replace("../index.php");</script>';}?>
<!-- / IF NOT CONNECTED SEND TO index.php -->
</body>
</html>