<?php
require_once("./db_connect.php");
if (isset($_GET['prod_id'])) 
{
    $del = "DELETE FROM products WHERE prod_id= '$_GET[prod_id]'";
    $res = $connection->query($del);
    if ($res) 
    {
        header("Location:../pages/admin-index.php");
    }
}
?>