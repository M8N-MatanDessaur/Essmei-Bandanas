<?php
require_once("./db_connect.php");
if (!empty($_POST)) {
    $prod_image = "";
    if (!empty($_FILES['prod_image']['name'])) {
        $prod_image_name = $_FILES['prod_image']['name'];
        $prod_image = "assets/images/" . $prod_image_name;
        $prod_image_folder = "C:/wamp64/www/SITES/Projects_PHP/Essmei_PRJ/assets/images/" . $prod_image_name;
        copy($_FILES['prod_image']['tmp_name'], $prod_image_folder);
        echo $_FILES['prod_image']['tmp_name'];
    }

    $INSERT_PROD =
        "INSERT INTO products(prod_category,prod_name, prod_price, prod_quantity, prod_image) VALUES('$_POST[prod_category]', '$_POST[prod_name]','$_POST[prod_price]','$_POST[prod_quantity]', '$prod_image')";

    if ($connection->query($INSERT_PROD) === TRUE) {
        echo "products inserted successfully";
        header("Location:../pages/admin-index.php");
    } else {
        echo "<script>alert('Error while inserting')</script>";
    }
}
die();
?>