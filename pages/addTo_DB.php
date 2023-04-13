<!DOCTYPE html>
<html lang="en">
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
    <title>admin - insertion</title>
    <link rel="stylesheet" href="../assets/styles/_fonts.css">
	<link rel="stylesheet" href="../assets/styles/_base.css">
    <link rel="stylesheet" href="../assets/styles/style.css">
    <link rel="stylesheet" href="../GoogleAuth/assets/styles/style.css">
</head>

<body>
<!-- ADD ITEM TO DATABASE FORM -->
    <section>
        <div>
            <center><h1>Add item to database</h1></center>
            <br>
            <form class="form" action="../backend/admin-insert.php" method="post" enctype="multipart/form-data">
                <input type="text" name="prod_category" placeholder="prod Category"><br><br>
                <input type="text" name="prod_name" placeholder="prod Name"><br><br>
                <input type="text" name="prod_price" placeholder="prod Price"><br><br>
                <input type="text" name="prod_quantity" placeholder="prod Quantity"><br><br>

                <label style="color:black">Select Image File:</label>
                <input type="file" id="prod_image" name="prod_image" required><br><br>
                <input style="background-color: #fe6a34 ;" type="submit" value="add to database">
            </form>
        </div>
    </section>
<!-- / ADD ITEM TO DATABASE FORM -->
</body>

</html>