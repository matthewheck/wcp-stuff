<?php
error_reporting(-1);
function get_lat_long($address){
//this displays
echo "here";
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
    
        //this does NOT display
        echo "howwwwday";
    
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
}
$longitude = "empty";
$locationAddress = "11420 W Douglas";
$locationCity = "Wichita";
$locationCountry = "USA";
$newAddress = $locationAddress.", ".$locationCity.", ".$locationCountry;
if ($longitude == "empty"){
//this displays
echo "yo?";
$locationCoords = get_lat_long($newAddress);
//this displays
echo "hey";
print_r($locationCoords);
$longitude = $locationCoords['long'];
$latitude = $locationCoords['lat'];
echo $longitude;
echo $latitude;
}
?>
