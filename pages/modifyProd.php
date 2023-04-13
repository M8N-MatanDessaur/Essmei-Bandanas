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
    <title>admin - modification</title>
    <link rel="stylesheet" href="../assets/styles/_fonts.css">
	<link rel="stylesheet" href="../assets/styles/_base.css">
    <link rel="stylesheet" href="../assets/styles/style.css">
    <link rel="stylesheet" href="../GoogleAuth/assets/styles/style.css">
</head>

<body>
<!-- MODIFY ITEM IN DATABASE FORM -->
    <section>
        <div>
            <center><h1>Modify <?= $_GET['prod_name'] ?></h1></center>
            <br>
            <div class="modif-prod">
            <form class="form modif-form" action="<?php echo '../backend/admin-modify.php?prod_id='.$_GET['prod_id']?> " method="post">
                <input type="text" value="<?= $_GET['prod_category'] ?>" name="prod_category" placeholder="prod Category"><br><br>
                <input type="text" value="<?= $_GET['prod_name'] ?>" name="prod_name" placeholder="prod Name"><br><br>
                <input type="text" value="<?= $_GET['prod_price'] ?>" name="prod_price" placeholder="prod Price"><br><br>
                <input type="text" value="<?= $_GET['prod_quantity'] ?>" name="prod_quantity" placeholder="prod Quantity"><br><br>
                <input style="background-color: #fe6a34 ;" type="submit" value="modify item">
            </form>
            <img src="../<?= $_GET['prod_image'] ?>" alt="">
            </div>
        </div>
    </section>
<!-- / MODIFY ITEM IN DATABASE FORM -->
</body>

</html>