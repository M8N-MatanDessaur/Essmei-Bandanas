<!-- CONNECT TO DB -->
    <?php
    //? $connection = new mysqli('server name', 'username', 'password', 'database'); ?\\[MODEL DE CONNECTION]
        $connection = new mysqli('localhost', 'root', '123', 'essmei_shop'); 
        if ($connection->connect_error) {                                    
            die("Connection failed: " . $connection->connect_error);
        }
    ?>
<!-- / CONNECT TO DB -->
