<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Home Page
 *
 * Note: You can overwrite home.php as well as any other Template in Child Theme.
 * Create the same file (name) include in /responsive-child-theme/ and you're all set to go!
 * @see            http://codex.wordpress.org/Child_Themes
 *
 * @file           home.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2012 ThemeID
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/home.php
 * @link           http://codex.wordpress.org/Template_Hierarchy
 * @since          available since Release 1.0
 */
?>

<?php include("/var/www/wechoosepeace.org/htdocs/translation.php"); ?>
<?php $lang = $_GET['lang']; ?>
<?php get_header(); ?>

		<script type="text/javascript" src="/wp-content/themes/responsive/js/webcam.js"></script>

        <div id="featured" class="grid col-940">
        
        <div class="grid col-460">
                    
			<h1 class="featured-subtitle" style="font-size:3em; line-height: 1.3em;">
				<?php echo $text['main-sub']; ?>
			</h1>
            
            <p>
            	<?php echo $text['main-text']; ?>
            </p>
            
            <h3 style="color:#0071B5; text-align: center; font-size:28px;">
				<?php echo $text['main-head']; ?>
			</h3>
            
            <?php $options = get_option('responsive_theme_options'); ?>
		    <?php if ($options['cta_button'] == 0): ?>     
            <div class="call-to-action">
            
            </div><!-- end of .call-to-action -->
            <?php endif; ?>         
            
        </div><!-- end of .col-460 -->

        <div id="featured-image" class="grid col-460 fit"> 
        
        	<div id="slideshow" style="width:440px; height:300px">
        		<?php do_action('slideshow_deploy', '226'); ?>
        	</div>
                                   
        </div><!-- end of #featured-image --> 
        
        </div><!-- end of #featured -->
        
        <div id="featured" class="grid col-940">
        	<form id="peaceForm" method="post" enctype="multipart/form-data" target="upload_form" action="ajax-process.php" onsubmit="showThankYou()">
        	<div id="steps">
				<div class="grid col-300">
					<div class="step-left grid"<?php if($lang == "ar"){ echo " style='float:right;'"; } ?>>
						<h1><?php if($lang == "ar"){ echo "3"; } else { echo "1"; } ?></h1>
					</div>
					<div class="step-right grid-right" id="nameStep"<?php if($lang == "ar"){ echo " style='text-align:right; float:left;'"; } ?>>
						<h3<?php if($lang == "ar"){ echo " style='text-align:right;'"; } ?>><?php echo $text['step1-head']; ?></h3>
						<div class="the-steps"<?php if($lang == "ar"){ echo " style='text-align:right;'"; } ?>><?php echo $text['step1-text']; ?></div>
						<input type="text" name="peace_name" value="<?php echo $text['step1-head']; ?>" id="peace_name" onfocus="if(this.value == '<?php echo $text['step1-head']; ?>') { this.value = ''; }" />
					</div>
				</div>
				<div class="grid col-300">
					<div class="step-left grid"<?php if($lang == "ar"){ echo " style='float:right;'"; } ?>>
						<h1>2</h1>
					</div>
					<div class="step-right grid-right" id="locationStep"<?php if($lang == "ar"){ echo " style='text-align:right; float:left;'"; } ?>>
						<h3<?php if($lang == "ar"){ echo " style='text-align:right;'"; } ?>><?php echo $text['step2-head']; ?></h3>
						<div class="the-steps" name="locationStep"<?php if($lang == "ar"){ echo " style='text-align:right;'"; } ?>><?php echo $text['step2-text']; ?></div>
						<button type="button" onclick="getLocation()" id="get_location_button"><?php echo $text['gps']; ?></button>
						<button type="button" onclick="locationSlider();"><?php echo $text['location']; ?></button>
	        			<input type="hidden" name="longitude" value="empty" id="longitude1" />
	        			<input type="hidden" name="latitude" value="empty" id="latitude1" />
					</div>
			        <div id="location_slide">
			        	<input type="text" name="locationAddress" value="Address" id="locationAddressPiece" onfocus="if(this.value == 'Address') { this.value = ''; }" /><br />
			        	<input type="text" name="locationCity" value="City" onfocus="if(this.value == 'City') { this.value = ''; }" /><br />
			        	<input type="text" name="locationCountry" value="Country" onfocus="if(this.value == 'Country') { this.value = ''; }" /><button type="button" onclick="locationSlider();">Save</button><br />
			        </div>
				</div>
				<div class="grid col-300" style="width:29.7%">
					<div class="step-left grid"<?php if($lang == "ar"){ echo " style='float:right;'"; } ?>>
						<h1><?php if($lang == "ar"){ echo "1"; } else { echo "3"; } ?></h1>
					</div>
					<div class="step-right grid-right" id="pictureStep"<?php if($lang == "ar"){ echo " style='text-align:right; float:left;''"; } ?>>
						<h3<?php if($lang == "ar"){ echo " style='text-align:right;'"; } ?>><?php echo $text['step3-head']; ?></h3>
						<div class="the-steps"<?php if($lang == "ar"){ echo " style='text-align:right;'"; } ?>><?php echo $text['step3-text1']; ?><span id="webcamLanguage"><?php echo $text['step3-text2']; ?></span><?php echo $text['step3-text3']; ?></div>
						<button type="button" onclick="uploadSlider();"><?php echo $text['photo']; ?></button>
						<button type="button" onClick="webcamSlider();" id="webcamButton"><?php echo $text['webcam']; ?></button>
						<input type="hidden" name="image_used" id="image_used" value="" />
					</div>
					<div id="webcam_slide">
			        	<script type="text/javascript" src="/wp-content/themes/responsive/js/webcam.js"></script>
						
						<!-- Next, write the movie to the page at 320x240 -->
						<script language="JavaScript">
							document.write( webcam.get_html(280, 210, 640, 480) );
						</script>
			
						<!-- Some buttons for controlling things -->
						<br/>
							<!-- <input type=button value="Configure..." onClick="webcam.configure()"> -->
							
							<input type=button value="Take Snapshot" onClick="take_snapshot()"> <button type="button" onclick="webcamSlider();">Save</button>
						
						<div id="upload_results" style="background-color:#eee;"></div>
			
			        </div>
			        	<!-- Configure a few settings -->
						<script language="JavaScript">
							webcam.set_api_url( 'save-webcam.php' );
							webcam.set_quality( 90 ); // JPEG quality (1 - 100)
							webcam.set_shutter_sound( false ); // play shutter click sound
						</script>
						
						<!-- Code to handle the server response (see test.php) -->
						<script language="JavaScript">
							webcam.set_hook( 'onComplete', 'my_completion_handler' );
							
							var w=document.getElementById("image_used");
							
							function take_snapshot() {
								// take snapshot and upload to server
								document.getElementById('upload_results').innerHTML = '<h1>Uploading...</h1>';
								webcam.snap();
							}
							
							function my_completion_handler(msg) {
								// extract URL out of PHP output
								if (msg.match(/(http\:\/\/\S+)/)) {
									var image_url = RegExp.$1;
									// show JPEG image in page
									document.getElementById('upload_results').innerHTML = 
										'<img src="' + image_url + '">';
										
									w.value=image_url;
									
									// reset camera for another shot
									webcam.reset();
								}
								else alert("PHP Error: " + msg);
							}
						</script>
			        <div id="upload_slide">
			        	<input type="file" name="image_upload" id="imageUpload" value="" /><br />
			        	<button type="button" onclick="uploadSlider();">Save</button>
			        </div>
				</div>
			</div>
			<div class="grid" style="width:100%; text-align:center;">
				<input type="submit" value="<?php echo $text['submit']; ?>" style="float:right;margin-right:35px;width:150px;padding:10px;" />
			</div>
			</form>
			<iframe height="0" width="0" src="ajax-process.php" id="upload_file_iframe" name="upload_form" style="visibility:hidden;"></iframe>
			<div id="peaceSubmit">
				<h1>Thank You...</h1>
				<h5 onclick="testing()">for choosing peace. We need your help to spread the word. Will you share this with your friends?</h5>
				<div id="sharePeace">
					<a href="http://twitter.com/share" class="twitter-share-button" data-text="I #ChoosePeace in South Sudan & #Sudan, but we need to spread the word. What do you choose?" data-url="http://wechoosepeace.org" data-count="none" id="tweetPeace">Tweet</a> <a name="fb_share" type="button" style="padding:10px;top:-6px;" share_url="http://wechoosepeace.org" id="shareFBPeace">Share</a>
				</div>
				
			</div>
        </div>
        <div id="featured" class="grid col-940">
        
        	<div id="map_place" style="width:900px; height:350px; margin:30px;"></div>

        </div>
                     
<?php get_sidebar('home'); ?>
<?php get_footer(); ?>

<script type="text/javascript">

if (!navigator.geolocation){
	jQuery("#get_location_button").hide();
}

function showThankYou(){

	var extension = "";
	var errors = 0;
	
	if(jQuery("#imageUpload").val() != ""){
		
		var path = jQuery("#imageUpload").val();
		
		extension = path.split('.').pop().toLowerCase();
	
	}

	// Is the name empty?
	if (jQuery("#peace_name").val() == ""){
		jQuery(".the-steps", "#nameStep").html("<span style='color:red;weight:bold;'>Whoops! You didn't include a name!</span>");
		errors++;
	}
	
	if (jQuery("#latitude1").val() == "empty" && jQuery("#locationAddressPiece").val() == "Address") {
		jQuery(".the-steps", "#locationStep").html("<span style='color:red;weight:bold;'>You forgot to include a location, Are you sure you meant to do that?</span>");
		errors++;
	}
	
	if (jQuery("#image_used").val() == "" && jQuery("#imageUpload").val() == "") {
		jQuery(".the-steps", "#pictureStep").html("<span style='color:red;weight:bold;'>You must take a picture!</span>");
		errors++;
	}
	
	if (extension != "") {
	
		if (extension == "jpg" || extension == "jpeg" || extension == "gif" || extension == "png"){
		
		} else {
			jQuery(".the-steps", "#pictureStep").html("<span style='color:red;weight:bold;'>You must use a jpeg, jpg, gif, or png.</span>");
			errors++;
		}
	}
	
	if (errors == 0){
		jQuery("#peaceForm").fadeOut(0);
		jQuery("#peaceSubmit").fadeIn("slow");
	} else {
		errors = 0;
		event.preventDefault();
	}
}

var x=document.getElementById("longitude1");
var y=document.getElementById("latitude1");
function getLocation()
  {
  if (navigator.geolocation)
    {
    navigator.geolocation.getCurrentPosition(showPosition);
    }
  }
function showPosition(position)
  {
  x.value=position.coords.longitude; 
  y.value=position.coords.latitude;	
  }
</script>

<script language="JavaScript">
	document.write( webcam.get_html(0, 0) );

</script>
