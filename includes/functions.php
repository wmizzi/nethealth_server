<?php

	function connect_to_database($db_name) {
		$connection = mysqli_connect("localhost", "root", "", $db_name);

		return $connection;
	}

	function connect_to_database_with_check($db_name) {
		
		$connection = mysqli_connect("localhost", "root", "", $db_name);

		if(mysqli_connect_errno()) 
		{
			die("<div>Database connection failed: " . mysqli_connect_error() . 
				" (" . mysqli_connect_errno() . ")");
		}
		else
		{
			echo "<div>Database connection successful";
		}

		return $connection;
	}

	function confirm_query($connection, $result_set) {
		if(!$result_set)
		{
			die("<div>Database query failed: " . mysqli_error($connection) . 
				" (" . mysqli_errno($connection) . ")");
		}
	}

	function two_database_selection_by_id_order_desc($key1, $database1, $key2, $database2, $limit) {

		$query = "SELECT " . $key1 . ", " . $key2 . " FROM " . $database1 . " JOIN " . $database2 . " ON " . $database1 . ".id = " . $database2 . ".id ORDER BY " . $database1 . ".id DESC LIMIT " . $limit;

		return $query;

	}

	function two_database_selection_by_id_no_limit($key1, $database1, $key2, $database2) {

		$query = "SELECT " . $key1 . ", " . $key2 . " FROM " . $database1 . " JOIN " . $database2 . " ON " . $database1 . ".id = " . $database2 . ".id";
		
		return $query;

	}

?>
