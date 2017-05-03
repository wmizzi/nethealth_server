<?php

  // Start the session
  session_start();

?>

<?php require_once("../includes/functions.php") ?>

<?php require_once("../includes/layouts/header.php") ?>

<body class="w3-light-grey">

<!-- Page Container -->
<div class="w3-content w3-margin-top" style="max-width:1400px;">

  <!-- The Grid -->
  <div class="w3-row-padding">
  
      <!-- Left Column -->
      <div class="w3-third">
    
          <div class="w3-white w3-text-grey w3-card-4">
            <div class="w3-display-container">
                <img src="images/network_splash.png" style="width:100%" alt="Avatar">
                <div class="w3-display-topleft w3-container">
                  <h2>NetHealth</h2>
                </div>
            </div><br>
          </div>
      <!-- End Left Column -->
      </div>

<?php

  // remove all session variables
  session_unset(); 

  // destroy the session 
  session_destroy(); 

?>

      <!-- Right Column -->
      <div class="w3-twothird">
    
          <div class="w3-container w3-card-2 w3-white w3-margin-bottom">
              <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-lock fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Login</h2>
              <div class="w3-container">

                <form action="login.php">
              
                  <p>You have been sccessfully logged out</p>
                  <p>Click below to return to login screen</p>

                  <input type="submit" value="Login">
                </form>
          
              </div>
            <br>
            <br>  
          </div>

      <!-- End Right Column -->
      </div>

    
<?php require_once("../includes/layouts/footer.php") ?>