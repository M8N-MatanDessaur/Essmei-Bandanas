    <!------------------------------------------------------------------->
    <?php
    //TODO SQL CONNECTION\\
    $connection = new mysqli('localhost', 'root', '123', 'google_accounts'); //mysqli_connect()
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    ?>
    <!------------------------------------------------------------------->