<?php
@session_start();
    require_once("./connection.php");
    $VERIFY_EMAIL = $connection->query("SELECT * FROM google_users where email = '$_POST[email]' AND password = '$_POST[pass]'");
    if($_POST['email'] == 'matandessaur@gmail.com') //TODO - ADMIN CONNECTION
    {
        $_SESSION["username"] = $_POST['email'];
        $strParts = explode('@', $_SESSION["username"]); // separates email to parts [username - @ domain.com]
        $_SESSION["name"] = (isset($strParts[0]) ? $strParts[0] : ' empty ');
        
        echo "<script>window.location.href = '../../pages/admin-index.php'</script>";
    }
    else //TODO - COSTUMER CONNECTION
    {
        if($VERIFY_EMAIL -> num_rows == 1)
        {
        $_SESSION["username"] = $_POST['email'];
        $strParts = explode('@', $_SESSION["username"]); // separates email to parts [username - @ domain.com]
        $_SESSION["name"] = (isset($strParts[0]) ? $strParts[0] : ' empty ');

        $_SESSION["cart"]                   = array();
        $_SESSION["cart"]["prod_name"]      = array();
        $_SESSION["cart"]["prod_price"]     = array();
        $_SESSION["cart"]["prod_quantite"]  = array();
        $_SESSION["cart"]["prod_image"]     = array();

        $_SESSION['total'] = 0;
        $_SESSION['quantiteTotal'] =0;

        header("Location:../../index.php");
        }
        else
        {
        echo "<script>alert('Wrong email or password')</script>";
        echo "<script>window.location.href = '../frontend/index.php'</script>";
        }
    }
?>