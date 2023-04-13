<!-- RESET CART -->
    <?php
    @session_start();
    $_SESSION["cart"]["prod_name"]      = array();
    $_SESSION["cart"]["prod_price"]     = array();
    $_SESSION["cart"]["prod_quantite"]  = array();
    $_SESSION['quantiteTotal'] = 0;
    echo "<script>alert('Thank you for buying on ESSMEI".'\n'."Your receipt will be sent on ".$_SESSION['username']."')</script>";
    echo '<script>window.location.replace("../index.php");</script>';   
    ?>
<!-- / RESET CART -->