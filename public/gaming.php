<?php

	// Start the session
	session_start();

?>

<?php require_once("../includes/functions.php") ?>
<?php include("../includes/fusioncharts.php") ?>

<?php require_once("../includes/layouts/header.php") ?>


<?php

	$user_id = $_SESSION['userid'];

	$connection = connect_to_database("");

    $db_name = "user" . $user_id;

	mysqli_select_db($connection, $db_name);

?>

<?php require_once("../includes/layouts/navigation.php") ?>

    <!-- Right Column -->
    <div class="w3-twothird">

    	<div class="w3-container w3-card-2 w3-white w3-margin-bottom">
        	<h2 class="w3-text-grey w3-padding-16"><i class="fa fa-user-circle fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>User <?php echo $user_id; ?>: Gaming</h2>
        	
      	</div>
    
    	<div class="w3-container w3-card-2 w3-white w3-margin-bottom">
        	<h2 class="w3-text-grey w3-padding-16"><i class="fa fa-arrow-down fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Recent Download Speeds</h2>
        	<div class="w3-container">
          
          		<div id="chart-1"></div>
          
          		<hr>
        	</div>
      	</div>

      	<div class="w3-container w3-card-2 w3-white">
        <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-arrow-up fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Recent Upload Speeds</h2>
          	<div class="w3-container">

        		<div id="chart-2"></div>

          		<hr>
        	</div>
      	</div>

    <!-- End Right Column -->
    </div>

<?php require_once("../includes/layouts/footer.php") ?>