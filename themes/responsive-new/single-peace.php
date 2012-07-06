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


<?php get_header(); ?>

		<script type="text/javascript" src="/wp-content/themes/responsive/js/webcam.js"></script>

        <div id="featured" class="grid col-940">
        
<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>

        <?php $content = get_the_content();
        $table_name = $wpdb->prefix . "peace_map";
	    $grabInformation = $wpdb->get_row("SELECT * FROM $table_name WHERE id=$content");
	    ?>
        
        <div class="grid col-460">
        
  			<h1 style="text-align:center;font-size:36px;">
  			
  				<?php the_title(); ?>
  					
  			</h1>
  			
  			<h3 style="text-align:center;">
  			
  				chose peace. Will you?
  			
  			</h3>
  			
  			<p>
  			On July 9, one year after South Sudan’s independence, advocates across the world are coming together to reject war and call for peace in the region. Will you join us?
  			</p>
  			
  			<div style="text-align:center;">
  				<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $grabInformation->bitly; ?>" data-text="Do you #ChoosePeace in Sudan and South Sudan? Check it out!" data-count="none">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				<a name="fb_share" type="button" share_url="<?php echo $grabInformation->bitly; ?>" style="padding:10px;top:-6px;"></a><script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript">
</script>
  			</div>
            
            <?php $options = get_option('responsive_theme_options'); ?>
		    <?php if ($options['cta_button'] == 0): ?>     
            <div class="call-to-action">
            
            </div><!-- end of .call-to-action -->
            <?php endif; ?>         
            
        </div><!-- end of .col-460 -->

        <div id="featured-image" class="grid col-460 fit"> 
	        
	        <img src="<? echo $grabInformation->image; ?>" style="width:95%;" />
                                   
        </div><!-- end of #featured-image --> 
        
        </div><!-- end of #featured -->
        <?php endwhile; ?> 

<?php endif; ?>  
        
        <div id="featured" class="grid col-940">
        	<form id="peaceForm" method="post" enctype="multipart/form-data" target="upload_form" action="/ajax-process.php" onsubmit="showThankYou()">
        	<div id="steps">
				<div class="grid col-300">
					<div class="step-left grid">
						<h1>1</h1>
					</div>
					<div class="step-right grid-right" id="nameStep">
						<h3>Name</h3>
						<div class="the-steps">We'll use your name to show you on our map.</div>
						<input type="text" name="peace_name" value="Name" id="peace_name" onfocus="if(this.value == 'Name') { this.value = ''; }" />
					</div>
				</div>
				<div class="grid col-300">
					<div class="step-left grid">
						<h1>2</h1>
					</div>
					<div class="step-right grid-right" id="locationStep">
						<h3>Location</h3>
						<div class="the-steps" name="locationStep">We'll try to grab your location, but you can submit it if you'd prefer.</div>
						<button type="button" onclick="getLocation()" id="get_location_button">Use GPS</button>
						<button type="button" onclick="locationSlider();">Enter Location</button>
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
					<div class="step-left grid">
						<h1>3</h1>
					</div>
					<div class="step-right grid-right" id="pictureStep">
						<h3>Picture</h3>
						<div class="the-steps">Upload a picture <span id="webcamLanguage">or use your webcam to take a picture </span>with a sign saying "I choose peace in Sudan and South Sudan."</div>
						<button type="button" onclick="uploadSlider();">Upload Photo</button>
						<button type="button" onClick="webcamSlider();" id="webcamButton">Use Webcam</button>
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
							
							<input type=button value="Take Snapshot" onClick="take_snapshot()">
						
						<div id="upload_results" style="background-color:#eee;"></div>
			
			        </div>
			        	<!-- Configure a few settings -->
						<script language="JavaScript">
							webcam.set_api_url( '/save-webcam.php' );
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
			        	<input type="file" name="image_upload" id="imageUpload" value="" />
			        </div>
				</div>
			</div>
			<div class="grid" style="width:100%; text-align:center;">
				<input type="submit" value="Submit" />
			</div>
			</form>
			<iframe height="0" width="0" src="/ajax-process.php" id="upload_file_iframe" name="upload_form" style="visibility:hidden;"></iframe>
			<div id="peaceSubmit">
				<h1>Thank You...</h1>
				<h5 onclick="testing()">for choosing peace. We need your help to spread the word. Will you share this with your friends?</h5>
				<div id="sharePeace">
				</div>
				
			</div>
        </div>
                     
<?php get_sidebar('home'); ?>
<?php get_footer(); ?>

<p onclick="bypassValidation();">-</p>

<script type="text/javascript">

if (!navigator.geolocation){
	jQuery("#get_location_button").hide();
}

function bypassValidation(){
	jQuery("#peaceForm").fadeOut(0);
	jQuery("#peaceSubmit").fadeIn("slow");
}
function showThankYou(){

	// Is the name empty?
	if (jQuery("#peace_name").val() == ""){
		jQuery(".the-steps", "#nameStep").html("<span style='color:red;weight:bold;'>Whoops! You didn't include a name!</span>");
		event.preventDefault();
		
	// How about the location?
	} else if (jQuery("#latitude1").val() == "empty" && jQuery("#locationAddressPiece").val() == "Address") {
		jQuery(".the-steps", "#locationStep").html("<span style='color:red;weight:bold;'>You forgot to include a location, Are you sure you meant to do that?</span>");
		event.preventDefault();
		
	// Is there a picture attached?
	} else if (jQuery("#image_used").val() == "" && jQuery("#imageUpload").val() == "") {
		jQuery(".the-steps", "#pictureStep").html("<span style='color:red;weight:bold;'>You must take a picture!</span>");
		event.preventDefault();
	} else {
		jQuery("#peaceForm").fadeOut(0);
		jQuery("#peaceSubmit").fadeIn("slow");
	}
}

function passBitLy(param){
	jQuery("#sharePeace").html('<a href="http://twitter.com/share" class="twitter-share-button" data-text="I #ChoosePeace in South Sudan & #Sudan, but we need to spread the word. What do you choose?" data-url="' + param + '" data-count="none" id="tweetPeace">Tweet</a>');
	jQuery.getScript("http://platform.twitter.com/widgets.js");
	jQuery("#sharePeace").append('<a name="fb_share" type="button" style="padding:10px;top:-6px;" share_url="' + param +'">Share</a>');
	jQuery.getScript("http://static.ak.fbcdn.net/connect.php/js/FB.Share");
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
