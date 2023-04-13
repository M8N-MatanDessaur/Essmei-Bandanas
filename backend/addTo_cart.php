<?php
@session_start(); 
if(!empty($_SESSION))
{
    $prod_position = array_search($_GET["prod_name"],$_SESSION["cart"]["prod_name"]);
    if($prod_position !== false)
    {
        $newQuantity = $_SESSION["cart"]["prod_quantite"][$prod_position]+1;
        $_SESSION["cart"]["prod_quantite"].array_splice($_SESSION["cart"]["prod_quantite"],$prod_position,1, $newQuantity);
    }
    else
    {
        $_SESSION['cart']['prod_name'][] =$_GET["prod_name"];
        $_SESSION['cart']['prod_price'][] = $_GET["prod_price"];
		$_SESSION['cart']['prod_quantite'][] = 1;
        $_SESSION['cart']['prod_image'][] = $_GET["prod_image"];
    }
    
    $_SESSION['quantiteTotal'] = 0;
    for($index = 0; $index < count($_SESSION['cart']['prod_name']); $index++)
    {
        $_SESSION['quantiteTotal'] += ($_SESSION["cart"]["prod_quantite"][$index]);
    }
    header("Location:../index.php#".strval($_GET['page_id']));
}
else
{
    header("Location:../GoogleAuth/frontend/index.php");
}
?>