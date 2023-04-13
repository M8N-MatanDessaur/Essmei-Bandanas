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
    <link rel="stylesheet" href="../GoogleAuth/assets/styles/style.css">
    <title>Confirmation</title>
</head>
<body style="height: 100%; overflow:hidden">

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

<!-- RECEIPT -->
    <section class="cart">
    <h1 style="font-size: 22px; margin-bottom:35px;">Receipt</h1>
    <form class="form" action="../backend/payment.php" method="post">
    <ul class="receipt">
    <?php
        unset($_SESSION['total']);
        error_reporting(E_ERROR | E_PARSE);

        if($_SESSION['quantiteTotal'] == 0)
        {
            //TODO - SEND BACK TO CART
        }
        else
        {
            for($index = 0; $index < count($_SESSION['cart']['prod_name']); $index++)
            {
                $_SESSION['total'] += ($_SESSION["cart"]["prod_quantite"][$index]*$_SESSION['cart']['prod_price'][$index]);
                if($_SESSION["cart"]["prod_quantite"][$index] != 0)
                {
                echo    "<li>";
                echo    "<p>".$_SESSION['cart']['prod_name'][$index]."</p>";
                echo    "<p>".$_SESSION['cart']['prod_quantite'][$index]."x</p>";
                echo    "<p>".$_SESSION['cart']['prod_price'][$index]."$</p>";
                echo    "</li>";
                }
            }
            echo "<hr>";
            echo '<p>&nbsp;&nbsp; subtotal : '.$_SESSION['total'].'$</p>';
            echo "<hr>";
            echo "<p>+TPS (5%) <br> +TVQ (9.975%)</p>";
            echo "<hr><br>";
            echo '<h1>Total : '.$_SESSION['total']*1.14975.'$</h1>';
        }
        ?>
    </ul>
    <br><br>
    <label style="margin-right: 15px;" for="payment"> Payment method </label>
    <input style="text-align:center;" type="text" name="payment" id="payment" placeholder="CARD NUMBER">

    <!-- SHOP NOW BUTTON -->
        <center>
         <button class="cta" type="submit">
         <p class="btn-paynow">Pay now</p>
         </button>
        </center>
    <!-- / SHOP NOW BUTTON -->

    </form>
   <?php }else{header("Location:../GoogleAuth/frontend/index.php");} ?>
    </section>
<!-- / RECEIPT -->
</body>
</html>
