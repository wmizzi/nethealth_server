<?php include("../includes/layouts/header.php") ?>
<?php require_once("../includes/functions.php") ?>

<?php

    // Check a file path has been provided
	if (isset($_POST['file']))
	{
		$file_location = $_POST['file'];
	}
	else
	{
		exit("No file path entered!");
	}

	// Check the file exists
	if (!file_exists($file_location))
	{

		exit("File not found");

	}

    $jsondata = file_get_contents($file_location);

	// Convert json object to php associative array
    $data = json_decode($jsondata, true);

    $user_id = $data['UserInfo']['user id'];
    $timestamp = $data['UserInfo']['timestamp'];
    $lat = $data['UserInfo']['lat'];
    $lon = $data['UserInfo']['lon'];
    $ip = $data['UserInfo']['ip'];

    $traceroute_array = $data['TRACEROUTE'];

    $traceroute = implode(",", $traceroute_array);

    $udp_download_420p_jitterlat = $data['SpeedTests']['UDP']['download']['420p']['jitter_lat'];
    $udp_download_420p_jitteriat = $data['SpeedTests']['UDP']['download']['420p']['jitter_iat'];
    $udp_download_420p_PLR = $data['SpeedTests']['UDP']['download']['420p']['PLR'];

    $udp_download_720p_jitterlat = $data['SpeedTests']['UDP']['download']['720p']['jitter_lat'];
    $udp_download_720p_jitteriat = $data['SpeedTests']['UDP']['download']['720p']['jitter_iat'];
    $udp_download_720p_PLR = $data['SpeedTests']['UDP']['download']['720p']['PLR'];

    $udp_download_1080p_jitterlat = $data['SpeedTests']['UDP']['download']['1080p']['jitter_lat'];
    $udp_download_1080p_jitteriat = $data['SpeedTests']['UDP']['download']['1080p']['jitter_iat'];
    $udp_download_1080p_PLR = $data['SpeedTests']['UDP']['download']['1080p']['PLR'];

    $udp_download_4k_jitterlat = $data['SpeedTests']['UDP']['download']['4k']['jitter_lat'];
    $udp_download_4k_jitteriat = $data['SpeedTests']['UDP']['download']['4k']['jitter_iat'];
    $udp_download_4k_PLR = $data['SpeedTests']['UDP']['download']['4k']['PLR'];

    $udp_2way_gaming_latency = $data['SpeedTests']['UDP']['2way']['gaming']['latency'];
    $udp_2way_gaming_jitterlat = $data['SpeedTests']['UDP']['2way']['gaming']['jitter_lat'];
    $udp_2way_gaming_jitteriat = $data['SpeedTests']['UDP']['2way']['gaming']['jitter_iat'];
    $udp_2way_gaming_PLR = $data['SpeedTests']['UDP']['2way']['gaming']['PLR'];

    $udp_2way_highvoip_latency = $data['SpeedTests']['UDP']['2way']['high_VOIP']['latency'];
    $udp_2way_highvoip_jitterlat = $data['SpeedTests']['UDP']['2way']['high_VOIP']['jitter_lat'];
    $udp_2way_highvoip_jitteriat = $data['SpeedTests']['UDP']['2way']['high_VOIP']['jitter_iat'];
    $udp_2way_highvoip_PLR = $data['SpeedTests']['UDP']['2way']['high_VOIP']['PLR'];

    $udp_2way_lowvoip_latency = $data['SpeedTests']['UDP']['2way']['low_VOIP']['latency'];
    $udp_2way_lowvoip_jitterlat = $data['SpeedTests']['UDP']['2way']['low_VOIP']['jitter_lat'];
    $udp_2way_lowvoip_jitteriat = $data['SpeedTests']['UDP']['2way']['low_VOIP']['jitter_iat'];
    $udp_2way_lowvoip_PLR = $data['SpeedTests']['UDP']['2way']['low_VOIP']['PLR'];

    $udp_upload_svc_jitterlat = $data['SpeedTests']['UDP']['upload']['standard_video_calling']['jitter_lat'];
    $udp_upload_svc_jitteriat = $data['SpeedTests']['UDP']['upload']['standard_video_calling']['jitter_iat'];
    $udp_upload_svc_PLR = $data['SpeedTests']['UDP']['upload']['standard_video_calling']['PLR'];

    $udp_upload_hdvc_jitterlat = $data['SpeedTests']['UDP']['upload']['hd_video_calling']['jitter_lat'];
    $udp_upload_hdvc_jitteriat = $data['SpeedTests']['UDP']['upload']['hd_video_calling']['jitter_iat'];
    $udp_upload_hdvc_PLR = $data['SpeedTests']['UDP']['upload']['hd_video_calling']['PLR'];

    $udp_upload_ss_jitterlat = $data['SpeedTests']['UDP']['upload']['screensharing']['jitter_lat'];
    $udp_upload_ss_jitteriat = $data['SpeedTests']['UDP']['upload']['screensharing']['jitter_iat'];
    $udp_upload_ss_PLR = $data['SpeedTests']['UDP']['upload']['screensharing']['PLR'];

    $tcp_download = $data['SpeedTests']['TCP']['download'];
    $tcp_upload = $data['SpeedTests']['TCP']['upload'];


    // Connect to mySQL but don't select a database yet
    $connection = connect_to_database("");

    $db_name = "user" . $user_id;

    // Check whether the user's database exists
    if(mysqli_select_db($connection, $db_name))
    {

        echo "<div>database found and selected";

        // following line may be redundant
    	// $connection = connect_to_database($user_id);

    } else {

        echo "<div>database not found: creating...";

        $query = "CREATE DATABASE " . $db_name;

        $success = mysqli_query($connection, $query);

        mysqli_select_db($connection, $db_name);

    	$query = "CREATE TABLE test_info (
    		id SMALLINT NOT NULL AUTO_INCREMENT,
    		timestamp TIMESTAMP NOT NULL,
            lat FLOAT(7,4) NOT NULL,
            lon FLOAT(7,4) NOT NULL,
    		ip VARCHAR(16) NOT NULL,
            traceroute VARCHAR(255) NOT NULL,
    		PRIMARY KEY (id)
    		);";

    	$success = mysqli_query($connection, $query);
        confirm_query($connection, $success);

        $query = "CREATE TABLE udp_dl_420p (
            id SMALLINT NOT NULL AUTO_INCREMENT,
            timestamp TIMESTAMP NOT NULL,
            jitter_lat FLOAT(6,5) NOT NULL,
            jitter_iat FLOAT(6,5) NOT NULL,
            PLR FLOAT(6,5) NOT NULL,
            PRIMARY KEY (id)
            );";

        $success = mysqli_query($connection, $query);
        confirm_query($connection, $success);

        $query = "CREATE TABLE udp_dl_720p (
            id SMALLINT NOT NULL AUTO_INCREMENT,
            timestamp TIMESTAMP NOT NULL,
            jitter_lat FLOAT(6,5) NOT NULL,
            jitter_iat FLOAT(6,5) NOT NULL,
            PLR FLOAT(6,5) NOT NULL,
            PRIMARY KEY (id)
            );";

        $success = mysqli_query($connection, $query);
        confirm_query($connection, $success);

        $query = "CREATE TABLE udp_dl_1080p (
            id SMALLINT NOT NULL AUTO_INCREMENT,
            timestamp TIMESTAMP NOT NULL,
            jitter_lat FLOAT(6,5) NOT NULL,
            jitter_iat FLOAT(6,5) NOT NULL,
            PLR FLOAT(6,5) NOT NULL,
            PRIMARY KEY (id)
            );";

        $success = mysqli_query($connection, $query);
        confirm_query($connection, $success);

        $query = "CREATE TABLE udp_dl_4k (
            id SMALLINT NOT NULL AUTO_INCREMENT,
            timestamp TIMESTAMP NOT NULL,
            jitter_lat FLOAT(6,5) NOT NULL,
            jitter_iat FLOAT(6,5) NOT NULL,
            PLR FLOAT(6,5) NOT NULL,
            PRIMARY KEY (id)
            );";

        $success = mysqli_query($connection, $query);
        confirm_query($connection, $success);

        $query = "CREATE TABLE udp_2way_gaming (
            id SMALLINT NOT NULL AUTO_INCREMENT,
            timestamp TIMESTAMP NOT NULL,
            latency FLOAT(6,5) NOT NULL,
            jitter_lat FLOAT(6,5) NOT NULL,
            jitter_iat FLOAT(6,5) NOT NULL,
            PLR FLOAT(6,5) NOT NULL,
            PRIMARY KEY (id)
            );";

        $success = mysqli_query($connection, $query);
        confirm_query($connection, $success);

        $query = "CREATE TABLE udp_2way_highvoip (
            id SMALLINT NOT NULL AUTO_INCREMENT,
            timestamp TIMESTAMP NOT NULL,
            latency FLOAT(6,5) NOT NULL,
            jitter_lat FLOAT(6,5) NOT NULL,
            jitter_iat FLOAT(6,5) NOT NULL,
            PLR FLOAT(6,5) NOT NULL,
            PRIMARY KEY (id)
            );";

        $success = mysqli_query($connection, $query);
        confirm_query($connection, $success);

        $query = "CREATE TABLE udp_2way_lowvoip (
            id SMALLINT NOT NULL AUTO_INCREMENT,
            timestamp TIMESTAMP NOT NULL,
            latency FLOAT(6,5) NOT NULL,
            jitter_lat FLOAT(6,5) NOT NULL,
            jitter_iat FLOAT(6,5) NOT NULL,
            PLR FLOAT(6,5) NOT NULL,
            PRIMARY KEY (id)
            );";

        $success = mysqli_query($connection, $query);
        confirm_query($connection, $success);

        $query = "CREATE TABLE udp_ul_svc (
            id SMALLINT NOT NULL AUTO_INCREMENT,
            timestamp TIMESTAMP NOT NULL,
            jitter_lat FLOAT(6,5) NOT NULL,
            jitter_iat FLOAT(6,5) NOT NULL,
            PLR FLOAT(6,5) NOT NULL,
            PRIMARY KEY (id)
            );";

        $success = mysqli_query($connection, $query);
        confirm_query($connection, $success);

        $query = "CREATE TABLE udp_ul_hdvc (
            id SMALLINT NOT NULL AUTO_INCREMENT,
            timestamp TIMESTAMP NOT NULL,
            jitter_lat FLOAT(6,5) NOT NULL,
            jitter_iat FLOAT(6,5) NOT NULL,
            PLR FLOAT(6,5) NOT NULL,
            PRIMARY KEY (id)
            );";

        $success = mysqli_query($connection, $query);
        confirm_query($connection, $success);

        $query = "CREATE TABLE udp_ul_ss (
            id SMALLINT NOT NULL AUTO_INCREMENT,
            timestamp TIMESTAMP NOT NULL,
            jitter_lat FLOAT(6,5) NOT NULL,
            jitter_iat FLOAT(6,5) NOT NULL,
            PLR FLOAT(6,5) NOT NULL,
            PRIMARY KEY (id)
            );";

        $success = mysqli_query($connection, $query);
        confirm_query($connection, $success);

        $query = "CREATE TABLE tcp (
            id SMALLINT NOT NULL AUTO_INCREMENT,
            timestamp TIMESTAMP NOT NULL,
            download FLOAT(12,3) NOT NULL,                   #bits per second
            upload FLOAT(12,3) NOT NULL,
            PRIMARY KEY (id)
            );";

        $success = mysqli_query($connection, $query);
        confirm_query($connection, $success);

    }

    $query = "INSERT INTO test_info (";
    $query .= "timestamp, lat, lon, ip, traceroute";
    $query .= ") VALUES (";
    $query .= "'{$timestamp}', {$lat}, {$lon}, '{$ip}', '{$traceroute}'";
    $query .= ")";

    $success = mysqli_query($connection, $query);
    confirm_query($connection, $success);

    $query = "INSERT INTO udp_dl_420p (";
    $query .= "timestamp, jitter_lat, jitter_iat, PLR";
    $query .= ") VALUES (";
    $query .= "'{$timestamp}', {$udp_download_420p_jitterlat}, {$udp_download_420p_jitteriat}, {$udp_download_420p_PLR}";
    $query .= ")";

    $success = mysqli_query($connection, $query);
    confirm_query($connection, $success);

    $query = "INSERT INTO udp_dl_720p (";
    $query .= "timestamp, jitter_lat, jitter_iat, PLR";
    $query .= ") VALUES (";
    $query .= "'{$timestamp}', {$udp_download_720p_jitterlat}, {$udp_download_720p_jitteriat}, {$udp_download_720p_PLR}";
    $query .= ")";

    $success = mysqli_query($connection, $query);
    confirm_query($connection, $success);

    $query = "INSERT INTO udp_dl_1080p (";
    $query .= "timestamp, jitter_lat, jitter_iat, PLR";
    $query .= ") VALUES (";
    $query .= "'{$timestamp}', {$udp_download_1080p_jitterlat}, {$udp_download_1080p_jitteriat}, {$udp_download_1080p_PLR}";
    $query .= ")";

    $success = mysqli_query($connection, $query);
    confirm_query($connection, $success);

    $query = "INSERT INTO udp_dl_4k (";
    $query .= "timestamp, jitter_lat, jitter_iat, PLR";
    $query .= ") VALUES (";
    $query .= "'{$timestamp}', {$udp_download_4k_jitterlat}, {$udp_download_4k_jitteriat}, {$udp_download_4k_PLR}";
    $query .= ")";

    $success = mysqli_query($connection, $query);
    confirm_query($connection, $success);

    $query = "INSERT INTO udp_2way_gaming (";
    $query .= "timestamp, latency, jitter_lat, jitter_iat, PLR";
    $query .= ") VALUES (";
    $query .= "'{$timestamp}', {$udp_2way_gaming_latency}, {$udp_2way_gaming_jitterlat}, {$udp_2way_gaming_jitteriat}, {$udp_2way_gaming_PLR}";
    $query .= ")";

    $success = mysqli_query($connection, $query);
    confirm_query($connection, $success);

    $query = "INSERT INTO udp_2way_highvoip (";
    $query .= "timestamp, latency, jitter_lat, jitter_iat, PLR";
    $query .= ") VALUES (";
    $query .= "'{$timestamp}', {$udp_2way_highvoip_latency}, {$udp_2way_highvoip_jitterlat}, {$udp_2way_highvoip_jitteriat}, {$udp_2way_highvoip_PLR}";
    $query .= ")";

    $success = mysqli_query($connection, $query);
    confirm_query($connection, $success);

    $query = "INSERT INTO udp_2way_lowvoip (";
    $query .= "timestamp, latency, jitter_lat, jitter_iat, PLR";
    $query .= ") VALUES (";
    $query .= "'{$timestamp}', {$udp_2way_lowvoip_latency}, {$udp_2way_lowvoip_jitterlat}, {$udp_2way_lowvoip_jitteriat}, {$udp_2way_lowvoip_PLR}";
    $query .= ")";

    $success = mysqli_query($connection, $query);
    confirm_query($connection, $success);

    $query = "INSERT INTO udp_ul_svc (";
    $query .= "timestamp, jitter_lat, jitter_iat, PLR";
    $query .= ") VALUES (";
    $query .= "'{$timestamp}', {$udp_upload_svc_jitterlat}, {$udp_upload_svc_jitteriat}, {$udp_upload_svc_PLR}";
    $query .= ")";

    $success = mysqli_query($connection, $query);
    confirm_query($connection, $success);

    $query = "INSERT INTO udp_ul_hdvc (";
    $query .= "timestamp, jitter_lat, jitter_iat, PLR";
    $query .= ") VALUES (";
    $query .= "'{$timestamp}', {$udp_upload_hdvc_jitterlat}, {$udp_upload_hdvc_jitteriat}, {$udp_upload_hdvc_PLR}";
    $query .= ")";

    $success = mysqli_query($connection, $query);
    confirm_query($connection, $success);

    $query = "INSERT INTO udp_ul_ss (";
    $query .= "timestamp, jitter_lat, jitter_iat, PLR";
    $query .= ") VALUES (";
    $query .= "'{$timestamp}', {$udp_upload_ss_jitterlat}, {$udp_upload_ss_jitteriat}, {$udp_upload_ss_PLR}";
    $query .= ")";

    $success = mysqli_query($connection, $query);
    confirm_query($connection, $success);

    $query = "INSERT INTO tcp (";
    $query .= "timestamp, download, upload";
    $query .= ") VALUES (";
    $query .= "'{$timestamp}', {$tcp_download}, {$tcp_upload}";
    $query .= ")";

    $success = mysqli_query($connection, $query);
    confirm_query($connection, $success);

?>
