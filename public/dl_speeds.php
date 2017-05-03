<?php

	// Start the session
	session_start();

?>

<?php require_once("../includes/functions.php") ?>
<?php include("../includes/fusioncharts.php") ?>

<?php require_once("../includes/layouts/header.php") ?>

<script type="text/javascript">
  FusionCharts.ready(function () {
   var salesByState = new FusionCharts({
        "type": "maps/victoria",
        "renderAt": "map-1",
        "width": "600",
        "height": "400",
        "dataFormat": "json",
        "dataSource": {
            "chart": {
                "caption": "",
                "entityFillHoverColor": "#000000",
                "numberScaleValue": "1,1000,1000",
                "numberScaleUnit": "K,M,B",
                "numberSuffix": "bps",
                "showLabels": "1",
                "theme": "carbon"
            },
            "colorrange": {
                "minvalue": "0",
                "startlabel": "Slow",
                "endlabel": "Fast",
                "code": "#e44a00",
                "gradient": "1",
                "color": [
                    {
                        "maxvalue": "24532",
                        "displayvalue": "Average",
                        "code": "#f8bd19"
                    },
                    {
                        "maxvalue": "50000",
                        "code": "#6baa01"
                    }
                ]
            },
            "data": [
                {
                    "id": "NEV",
                    "value": "19189"
                },
                {
                    "id": "SEV",
                    "value": "16879"
                },
                {
                    "id": "NWV",
                    "value": "12920"
                },
                {
                    "id": "SWV",
                    "value": "18342"
                },
                {
                    "id": "GMV",
                    "value": "44890"
                },
                {
                    "id": "CV",
                    "value": "24927"
                }
            ]
        }
    });
    salesByState.render();
});
</script>


<?php

	$user_id = $_SESSION['userid'];

	$connection = connect_to_database("");

    $db_name = "user" . $user_id;

	mysqli_select_db($connection, $db_name);



  if(isset($_GET['date1'])) {

    $strQuery = "SELECT timestamp, download FROM tcp WHERE timestamp >= '" . $_GET['date1'] . "'
    AND timestamp <= '" . $_GET['date2'] . "';";

  } else {

    $strQuery = "SELECT timestamp, download FROM tcp;";

  } 



  // Execute the query, or else return the error message.
  $result = $connection->query($strQuery) or exit("Error code ({$connection->errno}): {$connection->error}");

  // if statement may be redundant
    if ($result) {
      
      // The `$arrData` array holds the chart attributes and data
      $arrData = array("chart" => array("theme" => "carbon"));

      $arrData["data"] = array();

      // Push the data into the array
      while($row = mysqli_fetch_array($result)) {
          array_push($arrData["data"], array("label" => $row["timestamp"], "value" => $row["download"]));
      }

      $jsonEncodedData = json_encode($arrData);

      $lineChart = new FusionCharts("line", "tcpDownloadChart" , 600, 300, "chart-1", "json", $jsonEncodedData);

      $lineChart->render();   

  }


?>


<?php require_once("../includes/layouts/navigation.php") ?>

    <!-- Right Column -->
    <div class="w3-twothird">

    	<div class="w3-container w3-card-2 w3-white w3-margin-bottom">
        	<h2 class="w3-text-grey w3-padding-16"><i class="fa fa-user-circle fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>User <?php echo $user_id; ?>: Download Speeds</h2>
        	
      </div>
    
    	<div class="w3-container w3-card-2 w3-white w3-margin-bottom">
        	<h2 class="w3-text-grey w3-padding-16"><i class="fa fa-arrow-down fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Download Speeds</h2>
        	<div class="w3-container">
          
          		<div id="chart-1"></div>
          
          		<hr>
              <div>
                <p> Enter a range of dates to view data for: </p>

                <form action="dl_speeds.php" method="get">

                  From <input type="date" name="date1"> to <input type="date" name="date2">
                  <input type="submit">

                </form>
                <br>
              </div>

        	</div>
      	</div>

        <div class="w3-container w3-card-2 w3-white w3-margin-bottom">
          <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-arrow-down fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Download Speeds in your State</h2>
          <div class="w3-container">
          
              <div id="map-1"></div>
          
          <hr>
              

          </div>
        </div>

    <!-- End Right Column -->
    </div>

<?php require_once("../includes/layouts/footer.php") ?>