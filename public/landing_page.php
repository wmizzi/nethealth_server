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

  	$strQuery = "SELECT * FROM (SELECT timestamp, download FROM tcp ORDER BY timestamp DESC LIMIT 10) sub ORDER BY timestamp ASC;";

	// Execute the query, or else return the error message.
	$result = $connection->query($strQuery) or exit("Error code ({$connection->errno}): {$connection->error}");

	// if statement may be redundant
  	if ($result) {

    	// The `$arrData` array holds the chart attributes and data
    	$arrData = array("chart" => array( "theme" => "carbon"));

    	$arrData["data"] = array();

    	// Push the data into the array
    	while($row = mysqli_fetch_array($result)) {
      		array_push($arrData["data"], array("label" => $row["timestamp"], "value" => $row["download"]));
   		}

		// JSON Encode the data to retrieve the string containing the JSON representation of the data in the array
	    $jsonEncodedData = json_encode($arrData);

	    // Create an object for the column chart using the FusionCharts PHP class constructor
	    $lineChart = new FusionCharts("line", "tcpDownloadChart" , 600, 300, "chart-1", "json", $jsonEncodedData);

	    // Render the chart
	    $lineChart->render();

	}


	$strQuery = "SELECT * FROM (SELECT timestamp, upload FROM tcp ORDER BY timestamp DESC LIMIT 10) sub ORDER BY timestamp ASC;";

	// Execute the query, or else return the error message.
	$result = $connection->query($strQuery) or exit("Error code ({$connection->errno}): {$connection->error}");

	// if statement may be redundant
  	if ($result) {
    	
    	// The `$arrData` array holds the chart attributes and data
    	$arrData = array("chart" => array("theme" => "carbon"));

    	$arrData["data"] = array();

    	// Push the data into the array
    	while($row = mysqli_fetch_array($result)) {
      		array_push($arrData["data"], array("label" => $row["timestamp"], "value" => $row["upload"]));
   		}

	    $jsonEncodedData = json_encode($arrData);

	    $lineChart = new FusionCharts("line", "tcpUpwnloadChart" , 600, 300, "chart-2", "json", $jsonEncodedData);

	    $lineChart->render();		

	}

	$angularChart1 = new FusionCharts("AngularGauge", "PLRGauge420p", 300, 150, "gauge-1", "json", '{
    "chart": {
        "caption": "420p",
        "lowerlimitdisplay": "Bad",
        "upperlimitdisplay": "Good",
        "gaugeinnerradius": "50",
        "gaugeouterradius": "95",
        "bgcolor": "FFFFFF",
        "pivotradius": "8",
        "pivotfillmix": "333333, 333333",
        "pivotfilltype": "radial",
        "pivotfillratio": "0,100",
        "majorTMNumber": "2",
        "showtickvalues": "1",
        "showborder": "0"
    },
    "colorrange": {
        "color": [
            {
                "minvalue": "0",
                "maxvalue": "75",
                "code": "e44a00"
            },
            {
                "minvalue": "75",
                "maxvalue": "95",
                "code": "f8bd19"
            },
            {
                "minvalue": "95",
                "maxvalue": "100",
                "code": "6baa01"
            }
        ]
    },
    "dials": {
        "dial": [
            {
                "value": "92",
                "rearextension": "15",
                "radius": "100",
                "bgcolor": "333333",
                "bordercolor": "333333",
                "basewidth": "8"
            }
        ]
    }
}');
// Render the chart
$angularChart1->render();

$angularChart2 = new FusionCharts("AngularGauge", "PLRGauge720p", 300, 150, "gauge-2", "json", '{
    "chart": {
        "caption": "720p",
        "lowerlimitdisplay": "Bad",
        "upperlimitdisplay": "Good",
        "gaugeinnerradius": "50",
        "gaugeouterradius": "95",
        "bgcolor": "FFFFFF",
        "pivotradius": "8",
        "pivotfillmix": "333333, 333333",
        "pivotfilltype": "radial",
        "pivotfillratio": "0,100",
        "majorTMNumber": "2",
        "showtickvalues": "1",
        "showborder": "0"
    },
    "colorrange": {
        "color": [
            {
                "minvalue": "0",
                "maxvalue": "75",
                "code": "e44a00"
            },
            {
                "minvalue": "75",
                "maxvalue": "95",
                "code": "f8bd19"
            },
            {
                "minvalue": "95",
                "maxvalue": "100",
                "code": "6baa01"
            }
        ]
    },
    "dials": {
        "dial": [
            {
                "value": "92",
                "rearextension": "15",
                "radius": "100",
                "bgcolor": "333333",
                "bordercolor": "333333",
                "basewidth": "8"
            }
        ]
    }
}');
// Render the chart
$angularChart2->render();

$angularChart3 = new FusionCharts("AngularGauge", "PLRGauge1080p", 300, 150, "gauge-3", "json", '{
    "chart": {
        "caption": "1080p",
        "lowerlimitdisplay": "Bad",
        "upperlimitdisplay": "Good",
        "gaugeinnerradius": "50",
        "gaugeouterradius": "95",
        "bgcolor": "FFFFFF",
        "pivotradius": "8",
        "pivotfillmix": "333333, 333333",
        "pivotfilltype": "radial",
        "pivotfillratio": "0,100",
        "majorTMNumber": "2",
        "showtickvalues": "1",
        "showborder": "0"
    },
    "colorrange": {
        "color": [
            {
                "minvalue": "0",
                "maxvalue": "75",
                "code": "e44a00"
            },
            {
                "minvalue": "75",
                "maxvalue": "95",
                "code": "f8bd19"
            },
            {
                "minvalue": "95",
                "maxvalue": "100",
                "code": "6baa01"
            }
        ]
    },
    "dials": {
        "dial": [
            {
                "value": "92",
                "rearextension": "15",
                "radius": "100",
                "bgcolor": "333333",
                "bordercolor": "333333",
                "basewidth": "8"
            }
        ]
    }
}');
// Render the chart
$angularChart3->render();

$angularChart4 = new FusionCharts("AngularGauge", "PLRGauge4k", 300, 150, "gauge-4", "json", '{
    "chart": {
        "caption": "4k",
        "lowerlimitdisplay": "Bad",
        "upperlimitdisplay": "Good",
        "gaugeinnerradius": "50",
        "gaugeouterradius": "95",
        "bgcolor": "FFFFFF",
        "pivotradius": "8",
        "pivotfillmix": "333333, 333333",
        "pivotfilltype": "radial",
        "pivotfillratio": "0,100",
        "majorTMNumber": "2",
        "showtickvalues": "1",
        "showborder": "0"
    },
    "colorrange": {
        "color": [
            {
                "minvalue": "0",
                "maxvalue": "75",
                "code": "e44a00"
            },
            {
                "minvalue": "75",
                "maxvalue": "95",
                "code": "f8bd19"
            },
            {
                "minvalue": "95",
                "maxvalue": "100",
                "code": "6baa01"
            }
        ]
    },
    "dials": {
        "dial": [
            {
                "value": "92",
                "rearextension": "15",
                "radius": "100",
                "bgcolor": "333333",
                "bordercolor": "333333",
                "basewidth": "8"
            }
        ]
    }
}');
// Render the chart
$angularChart4->render();


?>

<?php require_once("../includes/layouts/navigation.php") ?>

    <!-- Right Column -->
    <div class="w3-twothird">

    	<div class="w3-container w3-card-2 w3-white w3-margin-bottom">
        	<h2 class="w3-text-grey w3-padding-16"><i class="fa fa-user-circle fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>User <?php echo $user_id; ?>: Quick View</h2>

        	<h4 class="w3-text-grey w3-padding-small">Below is a summary of the recent health of your network connection</h4> 
          	<h4 class="w3-text-grey w3-padding-small">Use the links on the left-hand side to see descriptions and expanations of metrics and view more detailed information about your broadband performance</h4>
          	<br>
        	
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

      	<div class="w3-container w3-card-2 w3-white">
        <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-tv fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Video Streaming Packet Loss Ratios</h2>
          	<div class="w3-container">
	
    			<div class="w3-show-inline-block" id="gauge-1"></div>
    			<div class="w3-show-inline-block" id="gauge-2"></div>
    			<div class="w3-show-inline-block" id="gauge-3"></div>
    			<div class="w3-show-inline-block" id="gauge-4"></div>

          		<hr>
        	</div>
      	</div>

    <!-- End Right Column -->
    </div>

<?php require_once("../includes/layouts/footer.php") ?>