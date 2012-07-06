<?php 

if (file_exists("/var/www/wechoosepeace.org/htdocs/wp-config.php")){
	require("/var/www/wechoosepeace.org/htdocs/wp-config.php");
	echo "here1";
} else {
	echo "nope";
} ?>

<?php 
/*
if (file_exists("/var/www/wechoosepeace.org/htdocs/wp-content/themes/responsive/includes/bitly.php")){
	include("/var/www/wechoosepeace.org/htdocs/wp-content/themes/responsive/includes/bitly.php");
	echo "here2";
} else {
	echo "nope";
}  */ ?>

<?php
	
	echo 'here';

	if (!empty($_POST)){

	$peace_name = htmlspecialchars(trim($_POST['peace_name']));
	$longitude = htmlspecialchars(trim($_POST['longitude']));
	$latitude = htmlspecialchars(trim($_POST['latitude']));
	$image_used = htmlspecialchars(trim($_POST['image_used']));
	
	$locationAddress = htmlspecialchars(trim($_POST['locationAddress']));
	$locationCity = htmlspecialchars(trim($_POST['locationCity']));
	$locationCountry = htmlspecialchars(trim($_POST['locationCountry']));
	
	$address = $locationAddress.", ".$locationCity.", ".$locationCountry;
	
		if (empty($image_used)){
		
			$filename = "tmp/". date('YmdHis');
			$filename = $filename . rand();
			
			if ($_FILES['image_upload'] == "image/gif"){
			
				move_uploaded_file ($_FILES['image_upload'] ['tmp_name'], $filename.'.gif');
				
			} elseif ($_FILES['image_upload'] == "image/png"){
			
				move_uploaded_file ($_FILES['image_upload'] ['tmp_name'], $filename.'.png');
			
			} elseif ($_FILES['image_upload'] != "image/jpg"){
			
				move_uploaded_file ($_FILES['image_upload'] ['tmp_name'], $filename.'.jpg');
			
			} elseif ($_FILES['image_upload'] != "image/jpeg"){
			
				move_uploaded_file ($_FILES['image_upload'] ['tmp_name'], $filename.'.jpeg');

			} else {
			
				
			}
					
			$image_used = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . $filename;
		
		}
		
		if ($longitude == "empty"){
			
			$locationCoords = get_lat_long($address);
			
			$longitude = $locationCoords['long'];
			$latitude = $locationCoords['lat'];
		
		}
	
	global $wpdb;
			
	$table_name = $wpdb->prefix . "peace_map";
			
	$wpdb->insert( $table_name, array( 'name' => $peace_name, 'longitude' => $longitude, 'latitude' => $latitude, 'image' => $image_used ) );

	$new_id = mysql_insert_id();
	
	// Create post object
  	$my_post = array(
    	'post_title' => wp_strip_all_tags( $peace_name ),
	    'post_content' => $new_id,
	    'post_status' => 'publish',
	    'post_type' => 'peace',
	);

	// Insert the post into the database
	$second_id = wp_insert_post( $my_post );
	
	$table_name = $wpdb->prefix . "posts";
    $grabInformation = $wpdb->get_row("SELECT * FROM $table_name WHERE ID=$second_id");
    
    //$bitly = bitly_v3_shorten($grabInformation->guid);
    
    $table_name = $wpdb->prefix . "peace_map";
    
    $wpdb->update(
    	$table_name,
    	array('bitly' => $grabInformation->guid),
    	array ('id' => $new_id)
    );
?>

	<script type="text/javascript">
		window.onload = function(){
		// this runs when the iframe has been loaded
		var bitlylink = "<?php echo $grabInformation->guid; ?>";
		parent.passBitLy(bitlylink);
		}
	</script>


<?php } ?>

<?php
function get_lat_long($address){

// check to see if the address is a string
	if (!is_string($address))die("All Addresses must be passed as a string");
    
    
	// pass the string to google maps in accordance with their URI structure
	$_url = sprintf('http://maps.google.com/maps?output=js&q=%s',rawurlencode($address));
	$_result = false;
   
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, $_url);
   
	// if there is a response from google ..
	if($_result = curl_exec($ch)) {
    
		// .. and it's the kind we want :) ..
		if(strpos($_result,'errortips') > 1 || strpos($_result,'Did you mean:') !== false) return false;
		// .. do some regular expression to parse..
		preg_match('!center:\s*{lat:\s*(-?\d+\.\d+),lng:\s*(-?\d+\.\d+)}!U', $_result, $_match);
		
		// .. the latitude ..
		$_coords['lat'] = $_match[1];
		// .. & longitude ..
		$_coords['long'] = $_match[2];
		
	}
    
	// return response assuming it is valid
	return $_coords;
}?>