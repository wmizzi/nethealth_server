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

	$strQuery = "SELECT YEAR(timestamp) FROM tcp WHERE id = 1;";
 
//Execute the query, or else return the error message.
$result = $connection->query($strQuery) or exit("Error code ({$connection->errno}): {$connection->error}");

$row = mysqli_fetch_array($result);

$year = $row["YEAR(timestamp)"];



$arrYears = array();
$arrAverages = array();
$data = true;

while ($data == true) {

	$strQuery = "SELECT download FROM tcp WHERE YEAR(timestamp) = " . $year . ";";

	$result = $connection->query($strQuery) or exit("Error code ({$connection->errno}): {$connection->error}");

	$sum = 0.0;
	$counter = 0.0;

	while ($row = mysqli_fetch_array($result)) {

		$sum = $sum + $row['download'];
		$counter++;

	}

	if ($counter == 0.0) {

		$data = false;

	} else {

		$average = $sum/$counter;

		$arrYears[] = $year;
		$arrAverages[] = $average;

		$year++;

	}

}

print_r($arrYears);
print_r($arrAverages);



?>