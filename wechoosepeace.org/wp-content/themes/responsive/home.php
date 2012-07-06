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

        <div id="featured" class="grid col-940">
        
        <div class="grid col-460">

            <?php $options = get_option('responsive_theme_options');
			// First let's check if headline was set
			    if ($options['home_headline']) {
                    echo '<h1 class="featured-title">'; 
				    echo $options['home_headline'];
				    echo '</h1>'; 
			// If not display dummy headline for preview purposes
			      } else { 
			        echo '<h1 class="featured-title">';
				    echo __('Hello, World!','responsive');
				    echo '</h1>';
				  }
			?>
                    
            <?php $options = get_option('responsive_theme_options');
			// First let's check if headline was set
			    if ($options['home_subheadline']) {
                    echo '<h2 class="featured-subtitle">'; 
				    echo $options['home_subheadline'];
				    echo '</h2>'; 
			// If not display dummy headline for preview purposes
			      } else { 
			        echo '<h2 class="featured-subtitle">';
				    echo __('Your H2 subheadline here','responsive');
				    echo '</h2>';
				  }
			?>
            
            <?php $options = get_option('responsive_theme_options');
			// First let's check if content is in place
			    if ($options['home_content_area']) {
                    echo '<p>'; 
				    echo $options['home_content_area'];
				    echo '</p>'; 
			// If not let's show dummy content for demo purposes
			      } else { 
			        echo '<p>';
				    echo __('Your title, subtitle and this very content is editable from Theme Option. 
					      Call to Action button and its destination link as well. Image on your right 
						  can be an image or even YouTube video if you like.','responsive');
				    echo '</p>';
				  }
			?>
            
            <?php $options = get_option('responsive_theme_options'); ?>
		    <?php if ($options['cta_button'] == 0): ?>     
            <div class="call-to-action">
            
            </div><!-- end of .call-to-action -->
            <?php endif; ?>         
            
        </div><!-- end of .col-460 -->

        <div id="featured-image" class="grid col-460 fit"> 
        
        	<div id="map_place" style="width:440px; height:300px"></div>
                                   
        </div><!-- end of #featured-image --> 
        
        </div><!-- end of #featured -->
        
        <div id="featured" class="grid col-940">
        	<form id="peaceForm" method="post" enctype="multipart/form-data" target="upload_form" action="ajax-process.php" onsubmit="showThankYou()">
        	<div id="steps">
				<div class="grid col-300">
					<div class="step-left grid">
						<h1>1</h1>
					</div>
					<div class="step-right grid-right">
						<h3>Name</h3>
						<div class="the-steps">You don't have to use your full name!</div>
						<input type="text" name="peace_name" value="Name" id="peace_name" onfocus="if(this.value == 'Name') { this.value = ''; }" />
					</div>
				</div>
				<div class="grid col-300">
					<div class="step-left grid">
						<h1>2</h1>
					</div>
					<div class="step-right grid-right">
						<h3>Location</h3>
						<div class="the-steps">We'll try to grab your location, but you can submit it if you'd prefer.</div>
						<button type="button" onclick="getLocation()" id="get_location_button">Use GPS</button>
						<button type="button" onclick="locationSlider();">Enter Location</button>
	        			<input type="hidden" name="longitude" value="empty" id="longitude1" />
	        			<input type="hidden" name="latitude" value="empty" id="latitude1" />
					</div>
			        <div id="location_slide">
			        	<input type="text" name="locationAddress" value="Address" onfocus="if(this.value == 'Address') { this.value = ''; }" /><br />
			        	<input type="text" name="locationCity" value="City" onfocus="if(this.value == 'City') { this.value = ''; }" /><br />
			        	<input type="text" name="locationCountry" value="Country" onfocus="if(this.value == 'Country') { this.value = ''; }" /><br />
			        </div>
				</div>
				<div class="grid col-300" style="width:29.7%">
					<div class="step-left grid">
						<h1>3</h1>
					</div>
					<div class="step-right grid-right">
						<h3>Picture</h3>
						<div class="the-steps">Either use your webcam or upload a picture with a sign saying "I choose peace."</div>
						<button type="button" onClick="webcamSlider();">Use Webcam</button>
						<button type="button" onclick="uploadSlider();">Upload Picture</button>
						<input type="hidden" name="image_used" id="image_used" />
					</div>
					<div id="webcam_slide">
			        	<script type="text/javascript" src="/wp-content/themes/responsive/js/webcam.js"></script>
											
						<!-- Configure a few settings -->
						<script language="JavaScript">
							webcam.set_api_url( 'save-webcam.php' );
							webcam.set_quality( 90 ); // JPEG quality (1 - 100)
							webcam.set_shutter_sound( false ); // play shutter click sound
						</script>
						
						<!-- Next, write the movie to the page at 320x240 -->
						<script language="JavaScript">
							document.write( webcam.get_html(280, 210, 640, 480) );
						</script>
			
						<!-- Some buttons for controlling things -->
						<br/>
							<!-- <input type=button value="Configure..." onClick="webcam.configure()"> -->
							
							<input type=button value="Take Snapshot" onClick="take_snapshot()">
						
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
						<div id="upload_results" style="background-color:#eee;"></div>
			
			        </div>
			        <div id="upload_slide">
			        	<input type="file" name="image_upload" />
			        </div>
				</div>
			</div>
			<div class="grid" style="width:100%; text-align:center;">
				<input type="submit" value="Submit" />
			</div>
			</form>
			<div id="peaceSubmit" style="width:100%;text-align:center;" onclick="validateChoices()">
				<h2>Thank You...</h2>
				<h5>for choosing peace. Would you spread the word?</h5>
				
			</div>
        </div>
        
        <iframe height="0" width="0" src="ajax-process.php" id="upload_file_iframe" name="upload_form"></iframe>
                     
<?php get_sidebar('home'); ?>
<?php get_footer(); ?>

<script type="text/javascript">

if (!navigator.geolocation){
	jQuery("#get_location_button").hide();
}

function showThankYou(){
	jQuery("#peaceForm").fadeOut(0);
	jQuery("#peaceSubmit").fadeIn("slow");
}

function validateChoices(){

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
