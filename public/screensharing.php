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


  if(isset($_GET['date1'])) {

    $strQuery = "SELECT * FROM udp_ul_ss WHERE timestamp >= '" . $_GET['date1'] . "'
    AND timestamp <= '" . $_GET['date2'] . "';";

  } else {

    $strQuery = "SELECT * FROM udp_ul_ss;";

  } 



  // Execute the query, or else return the error message.
  $result = $connection->query($strQuery) or exit("Error code ({$connection->errno}): {$connection->error}");

  // if statement may be redundant
    if ($result) {
      
      // The `$arrData` array holds the chart attributes and data
      $arrJitterLatData = array("chart" => array("theme" => "carbon"));
      $arrJitterIATData = array("chart" => array("theme" => "carbon"));
      $arrPLRData = array("chart" => array("theme" => "carbon"));

      $arrJitterLatData["data"] = array();
      $arrJitterIATData["data"] = array();
      $arrPLRData["data"] = array();

      // Push the data into the array
      while($row = mysqli_fetch_array($result)) {
          array_push($arrJitterLatData["data"], array("label" => $row["timestamp"], "value" => $row["jitter_lat"]));
          array_push($arrJitterIATData["data"], array("label" => $row["timestamp"], "value" => $row["jitter_iat"]));
          array_push($arrPLRData["data"], array("label" => $row["timestamp"], "value" => $row["PLR"]));
      }

      $jsonEncodedJitterLatData = json_encode($arrJitterLatData);
      $jsonEncodedJitterIATData = json_encode($arrJitterIATData);
      $jsonEncodedPLRData = json_encode($arrPLRData);

      $jitterLatLineChart = new FusionCharts("line", "jitterLatChart" , 600, 300, "chart-1", "json", $jsonEncodedJitterLatData);
      $jitterIATLineChart = new FusionCharts("line", "jitterIATChart" , 600, 300, "chart-2", "json", $jsonEncodedJitterIATData);
      $PLRLineChart = new FusionCharts("line", "PLRChart" , 600, 300, "chart-3", "json", $jsonEncodedPLRData);

      $jitterLatLineChart->render();
      $jitterIATLineChart->render();
      $PLRLineChart->render();   

  }

?>

<?php require_once("../includes/layouts/navigation.php") ?>

    <!-- Right Column -->
    <div class="w3-twothird">

      <div class="w3-container w3-card-2 w3-white w3-margin-bottom">
          <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-user-circle fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>User <?php echo $user_id; ?>: Screen Sharing</h2>
          
        </div>
    
        <div class="w3-container w3-card-2 w3-white w3-margin-bottom">
          <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-chevron-right fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Packet Latency Jitter</h2>
          <div class="w3-container">
          
            <div id="chart-1"></div>
            <hr>
            <div>

              <p> Enter a range of dates to view data for: </p>

              <form action="ul_speeds.php" method="get">

                From <input type="date" name="date1"> to <input type="date" name="date2">
                <input type="submit">

              </form>
              <br>
            </div>
          </div>
        </div>

        <div class="w3-container w3-card-2 w3-white w3-margin-bottom">
          <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-chevron-right fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Packet Inter-Arrival Time Jitter</h2>
          <div class="w3-container">
          
            <div id="chart-2"></div>
            <hr>
            
          </div>  
        </div>

        <div class="w3-container w3-card-2 w3-white w3-margin-bottom">
          <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-chevron-right fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Packet Loss Ratio</h2>
          <div class="w3-container">
          
            <div id="chart-3"></div>
            <hr>

          </div>
        </div>

    <!-- End Right Column -->
    </div>

<?php require_once("../includes/layouts/footer.php") ?>