<!DOCTYPE html>
<?php
//TODO - CONNECT SESSION
    @session_start();      //? START TO SESSION
    error_reporting(0);    //? SHOW NO ERRORS
    ini_set('display_errors', 0);
?>
<html style="height: 100%;">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../assets/styles/_fonts.css">
	<link rel="stylesheet" href="../assets/styles/_base.css">
    <link rel="stylesheet" href="../assets/styles/style.css">
    <title>Cart</title>
</head>
<body style="height: 100%; overflow-x:hidden">

<?php 
//TODO - IF SESSION EXISTS RESET TOTAL QUANTITY & COUNT AGAIN THEN SHOW TABLE
    if(!empty($_SESSION))
    {
    $_SESSION['quantiteTotal'] = 0;
    for($index = 0; $index < count($_SESSION['cart']['prod_name']); $index++)
    {
        $_SESSION['quantiteTotal'] += ($_SESSION["cart"]["prod_quantite"][$index]);
    }
?>

<!-- HEADER IF CONNECTED -->
    <header>
	  <div class="container">
        <a href="../index.php">
	    <h1>
	      <img src="../assets/images/logo.png">
	    </h1>
        </a>
	    <nav>
	        <p style="color:white"><?= $_SESSION['name'] ?></p>
		  	<a href="../GoogleAuth/backend/disconnect.php">
			<p>Disconnect</p>
		  	</a>
	      	<a id="cart-logo" href="../pages/cart.php">
	        <img src="../assets/images/basket-icon.svg">
            <!-- ITEMS - INDICATOR -->
			<div class="items-indicator">
				<p><?= $_SESSION['quantiteTotal'] ?></p>
			</div>
			<!-- / ITEMS - INDICATOR -->
	      	</a>
	    </nav>
	</header>
<!-- / HEADER IF CONNECTED -->

<!-- SHOW CART -->
    <section class="cart" style="margin:35px 0 ;">
    <h1 style="font-size: 22px; margin-bottom:35px;">Checkout</h1>
    <table class="cart-table">
        <?php
        unset($_SESSION['total']);
        error_reporting(E_ERROR | E_PARSE);

        $trashIcon = '<svg width="30" height="30" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m12.03 5-.018 14"></path><path d="M5 12h14"></path></svg>';

        if($_SESSION['quantiteTotal'] == 0)
        {
            echo '<th>Empty cart</th>';
        }
        else
        {
            for($index = 0; $index < count($_SESSION['cart']['prod_name']); $index++)
            {
                $_SESSION['total'] += ($_SESSION["cart"]["prod_quantite"][$index]*$_SESSION['cart']['prod_price'][$index]);
                echo '<div class="cart-item">';
                echo '<img src="../'.$_SESSION['cart']['prod_image'][$index].'" height="90px">';
                echo '<div class="cart-item-details">';
                echo    "<h2>".$_SESSION['cart']['prod_name'][$index] ."</h2>";
                echo    "<p>".$_SESSION['cart']['prod_quantite'][$index] ."x</p>";
                echo    "<p class='item-price'>".$_SESSION['cart']['prod_price'][$index] ." $ &nbsp; </p>";
                echo    '<a href="?action=suppression&prod_name=' . $_SESSION['cart']['prod_name'][$index] . '"">' .  $trashIcon . '</a>';
                echo    '<form style="margin-top:15px;" method="post" action="cart.php?pos='.$index.'">';
                echo    '<input style="border: 0;background: transparent; color:#696969;" type="submit" name="less" value="-"/>';
                echo    '<input style="border: 0;background: transparent; color:#696969;" type="submit" name="add" value="+"/>';
                echo    '</form>';
                echo '</div>';
                echo '</div>';
            }
            echo '<p>Subtotal '.$_SESSION['total'].' $</p>';
        }

        if (isset($_GET['action']) && $_GET['action'] == "suppression") 
        {
            $prod_position = array_search($_GET["prod_name"],$_SESSION["cart"]["prod_name"]);
            if($prod_position !== false)
            {
                //$_SESSION['cart']['prod_name'][$prod_position]       = "";
                //$_SESSION['cart']['prod_price'][$prod_position]      =  0;   
                //$_SESSION['cart']['prod_quantite'][$prod_position]   =  0;   
                array_splice($_SESSION['cart']['prod_name'], $prod_position, 1);
		        array_splice($_SESSION['cart']['prod_price'], $prod_position, 1);
		        array_splice($_SESSION['cart']['prod_quantite'], $prod_position, 1);
                echo '<script>window.location.replace("cart.php");</script>';       
            }
        }

      
        if(isset($_POST['less'])) {
            if($_SESSION["cart"]["prod_quantite"][$_GET['pos']] == 1)
            {
                array_splice($_SESSION['cart']['prod_name'], $_GET['pos'], 1);
		        array_splice($_SESSION['cart']['prod_price'], $_GET['pos'], 1);
		        array_splice($_SESSION['cart']['prod_quantite'], $_GET['pos'], 1);
                echo '<script>window.location.replace("cart.php");</script>'; 
            }
            else
            {
                array_splice($_SESSION["cart"]["prod_quantite"],$_GET['pos'],1,($_SESSION["cart"]["prod_quantite"][$_GET['pos']])-1);
                echo '<script>window.location.replace("cart.php");</script>'; 
            }
        }
        if(isset($_POST['add'])) {
            array_splice($_SESSION["cart"]["prod_quantite"],$_GET['pos'],1,($_SESSION["cart"]["prod_quantite"][$_GET['pos']])+1);
            echo '<script>window.location.replace("cart.php");</script>'; 
        }

        ?>
    </table>


    <!-- SHOP NOW BUTTON -->
   <center>
    <a href="./confirmation.php">
    <button class="cta" style="margin:35px 0 ;">
    <span class="hover-underline-animation"> Shop now </span>
    <svg viewBox="0 0 46 16" height="10" width="30" xmlns="http://www.w3.org/2000/svg" id="arrow-horizontal">
        <path transform="translate(30)" d="M8,0,6.545,1.455l5.506,5.506H-30V9.039H12.052L6.545,14.545,8,16l8-8Z" data-name="Path 10" id="Path_10"></path>
    </svg>
    </button>
    </a>
   </center>
    <!-- / SHOP NOW BUTTON -->

   <?php }else{header("Location:../GoogleAuth/frontend/index.php");} ?>
    </section>
<!-- / SHOW CART -->
</body>
</html>
