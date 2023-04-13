<?php
require_once("./db_connect.php");
if (!empty($_POST)) 
{
    $MOD_PROD = "UPDATE products SET prod_category = '$_POST[prod_category]', prod_name = '$_POST[prod_name]', prod_price = '$_POST[prod_price]', prod_quantity = '$_POST[prod_quantity]' WHERE prod_id = '$_GET[prod_id]'";

    if ($connection->query($MOD_PROD) === TRUE) {
        header("Location:../pages/admin-index.php");
    } else {
        echo "<script>alert('Error while modifying')</script>";
    }
}
die();
?>