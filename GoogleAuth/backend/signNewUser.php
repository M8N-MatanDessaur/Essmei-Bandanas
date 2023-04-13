<?php
    require_once("./connection.php");

    if (!empty($_POST)) 
    {
        if($_POST['pass'] != $_POST['confirm_pass'])
        {
            echo "<script>alert('Confirm password not identical')</script>";
            echo "<script>window.location.href = '../frontend/signup.php'</script>";
        }
        else
        {
            $VERIFY_EMAIL = $connection->query("SELECT * FROM google_users where email = '$_POST[email]'");
            if($VERIFY_EMAIL -> num_rows == 0)
                {
                    $INSERT_USER =
                    "INSERT INTO google_users(first_name, last_name, email, password) VALUES('$_POST[first_name]', '$_POST[last_name]', '$_POST[email]', '$_POST[pass]')";
                    if (!$connection->query($INSERT_USER) === TRUE) 
                    {
                        echo "<script>alert('Error adding user')</>";
                        echo "<script>window.location.href = './signNewUser.php'</script>";
                    }

                    if ($INSERT_USER) 
                    {
                    header("Location:http:../frontend/index.php");
                    }
                }
            else
            {
                echo "<script>alert('This account already exists')</script>";
                echo "<script>window.location.href = '../frontend/index.php'</script>";
            }
        }
       
    }
    die();
?>