<!doctype html>
<?php
//TODO - CONNECT SESSION
	@session_start();      //? START TO SESSION
	error_reporting(0);    //? SHOW NO ERRORS
	ini_set('display_errors', 0);
?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="generator" content="SuperHi">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Essmei</title>
		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
		<link rel="stylesheet" href="./assets/styles/_fonts.css">
		<link rel="stylesheet" href="./assets/styles/_base.css">
		<link rel="stylesheet" href="./assets/styles/style.css">
	</head>
	<body>
	<?php 
	//TODO CHECK IF USER CONNECTED
		if(!empty($_SESSION)){
	?>
	<!-- HEADER IF CONNECTED -->
		<marquee behavior="scroll" direction="left" scrollamount="10">
				BLACK FRIDAY SALE 💥 &nbsp;&nbsp;—&nbsp;&nbsp; BUY 3 GET ONE FREE &nbsp;&nbsp;—&nbsp;&nbsp; ONLY FOR A LIMITED TIME 🤩💰
		</marquee>
		<header>
		  <div class="container">
		  <a href="index.php">
		    <h1>
		      <img src="./assets/images/logo.png">
		    </h1>
		  </a>
		    <nav>
		        <p style="color:white"><?= $_SESSION['name'] ?></p>
			  	<a href="./GoogleAuth/backend/disconnect.php">
				<p>Disconnect</p>
			  	</a>
		      	<a id="cart-logo" href="./pages/cart.php">
		        <img src="./assets/images/basket-icon.svg">
				<!-- ITEMS - INDICATOR -->
				<div class="items-indicator">
					<p><?= $_SESSION['quantiteTotal'] ?></p>
				</div>
				<!-- / ITEMS - INDICATOR -->
		      	</a>
		    </nav>
		</header>
	<!-- / HEADER IF CONNECTED -->
	<?php }else{ ?>
	<!-- HEADER IF NOT CONNECTED -->
		<header>
		  <div class="container">
		    <h1>
		      <img src="./assets/images/logo.png">
		    </h1>
		    <nav>
			<a href="./GoogleAuth/frontend/index.php">
		        <p>Login with google</p>
		      </a>
		      <a href="./pages/cart.php">
		        <img src="./assets/images/basket-icon.svg">
		      </a>
		    </nav>
		</header>
	<!-- / HEADER IF NOT CONNECTED -->
	<?php }?>	

	<!-- HERO CONTAINER -->
		<section class="hero">
		  <div class="container">
		    <div class="intro">
		      <h2>An exploration of colour inspired by movement, positivity + New York City.</h2>
		      <p>Each bandana has been made and printed by hand.</p>
		    </div>
		  </div>
		</section>
	<!-- / HERO CONTAINER -->

	<!-- FILTER NAV -->	
		<nav class="filters">
		  <div class="container">
		    <a href="#" class="show-filters">Show Filters</a>
		    <ul class="filters-list">
		       <li>
		      <a href="#" class="selected" data-filter=".product">All</a>
		      </li>
		      <li>
		      <a href="#"data-filter=".bandana">Bandanas</a>
		      </li>
		      <li>
		      <a href="#"data-filter=".accs">Accessories</a>
		      </li>
		    </ul>
		  </div>
		</nav>
	<!-- / FILTER NAV -->	

    <!-- SHOW PRODUCTS -->
		<section id="prod_section" class="products">
		  <div class="container">
				<?php
				require_once("./backend/db_connect.php");
				$output = '';

				//TODO - SHOW PRODUCTS FROM DB ---//
				$selectAllProducts = "SELECT * FROM products";
				$query = $connection->query($selectAllProducts);
				$index = 0;

				while ($row = $query->fetch_assoc()) {
				
				    foreach ($row as $key => $value) {
				        if ($key == "prod_category") 
				        {
							if($value == "accs")
							{ 
								$params = 'prod_name='.$row['prod_name'].'&prod_price='.$row['prod_price'].'&prod_image='.$row['prod_image'].'&page_id=prod-'.$index;
								$output .= '<a id="accs" class="product accs" href="./backend/addTo_cart.php?'.$params;
				            	$output .= '"><div id="prod-'.$index.'" class="overlay">';
								$index ++;
							}
							else if($value == "bandana")
							{
								$params = 'prod_name='.$row['prod_name'].'&prod_price='.$row['prod_price'].'&prod_image='.$row['prod_image'].'&page_id=prod-'.$index;
								$output .= '<a id="bandana" class="product bandana" href="./backend/addTo_cart.php?'.$params;
				            	$output .= '"><div id="prod-'.$index.'" class="overlay">';
								$index ++;
							}
				        }
				        else if ($key == "prod_name") 
				        {
				            $output .= '<h4>'.$value.'</h4>';
				        }
				        else if ($key == "prod_price") 
				        {
				            $output .= '<p>'.$value.'$</p>';
				            $output .= '</div>';
				        }
				        else if ($key == "prod_image") 
				        {
				            $output .= '<img src="'.$value.'">';
				            $output .= '</a>';
				        }
				    }
				}
				echo $output;
				?>
		  </div>
		</section>
	<!-- / SHOW PRODUCTS -->

	<!-- SCRIPTS -->
		<script src="./assets/scripts/jquery.js"></script>
		<script src="./assets/scripts/main.js"></script>
	<!-- / SCRIPTS -->

	<!-- TOASTIFY SCRIPT TO NOTIFY USER TO CONNECT FOR PROMOTIONS -->
		<?php 
		if(empty($_SESSION)){
		?>
		<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
				<!--//! NOTIFY USER ABOUT PROMOTIONS -->
				<script>
				Toastify({
				text: "Connect to learn more about our BLACKFRIDAY promotions",
				duration: 4000,
				gravity: "bottom", 
  				position: "left", 
				style: {
    				background: "#000",
  					}
				}).showToast();
			</script>
		<!--//! / NOTIFY USER ABOUT PROMOTIONS -->
		<?php } ?>
	<!-- / TOASTIFY SCRIPT TO NOTIFY USER TO CONNECT FOR PROMOTIONS -->
	</body>
</html>
