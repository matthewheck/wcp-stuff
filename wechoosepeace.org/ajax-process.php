<?php require_once("wp-config.php"); ?>

<?php

	if (!empty($_POST)){

	$peace_name = htmlspecialchars(trim($_POST['peace_name']));
	$longitude = htmlspecialchars(trim($_POST['longitude']));
	$latitude = htmlspecialchars(trim($_POST['latitude']));
	$image_used = htmlspecialchars(trim($_POST['image_used']));
	
	if (empty($image_used)){
	
		$filename = "tmp/". date('YmdHis');
		$filename = $filename . rand();
		$filename = $filename . '.jpg';
	
		move_uploaded_file ($_FILES['image_upload'] ['tmp_name'], $filename);
		
		$image_used = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . $filename;
	
	}
	
	global $wpdb;
			
	$table_name = $wpdb->prefix . "peace_map";
			
	$wpdb->insert( $table_name, array( 'name' => $peace_name, 'longitude' => $longitude, 'latitude' => $latitude, 'image' => $image_used, 'timestamp' => current_time('mysql') ) );
	
	}
	
?>