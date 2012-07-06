<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Home Widgets Template
 *
 *
 * @file           sidebar-home.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2012 ThemeID
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/sidebar-home.php
 * @link           http://codex.wordpress.org/Theme_Development#Widgets_.28sidebar.php.29
 * @since          available since Release 1.0
 */
?>  

<?php include("/var/www/wechoosepeace.org/htdocs/translation.php"); ?>
<?php $lang = $_GET['lang']; ?>
    <div id="widgets" class="home-widgets">
        <div class="grid col-300">
        <?php responsive_widgets(); // above widgets hook ?>
            
            
            <div class="widget-wrapper">
            
                <div class="widget-title-home"><h3<?php if($lang == "ar"){ echo " style='text-align:right;'"; } ?>><?php echo $text['widget1-header']; ?></h3></div>
                <div class="textwidget"<?php if($lang == "ar"){ echo " style='text-align:right;'"; } ?>><?php echo $text['widget1-text']; ?></div>
            
			</div><!-- end of .widget-wrapper -->
			

        <?php responsive_widgets_end(); // responsive after widgets hook ?>
        </div><!-- end of .col-300 -->

        <div class="grid col-300">
        <?php responsive_widgets(); // responsive above widgets hook ?>
            
            <div class="widget-wrapper">
            
                <div class="widget-title-home"><h3<?php if($lang == "ar"){ echo " style='text-align:right;'"; } ?>><?php echo $text['widget2-header']; ?></h3></div>
                <div class="textwidget"<?php if($lang == "ar"){ echo " style='text-align:right;'"; } ?>><?php echo $text['widget2-text']; ?></div>
            
			</div><!-- end of .widget-wrapper -->
            
        <?php responsive_widgets_end(); // after widgets hook ?>
        </div><!-- end of .col-300 -->

        <div class="grid col-300 fit">
        <?php responsive_widgets(); // above widgets hook ?>
            
            <div class="widget-wrapper">

		<?php if(empty($lang)){ $lang = "en"; }?>
            
                <div class="widget-title-home"><h3<?php if($lang == "ar"){ echo " style='text-align:right;'"; } ?>><?php echo $text['widget3-header']; ?></h3></div>
                <div class="textwidget"<?php if($lang == "ar"){ echo " style='text-align:right;'"; } ?>><?php quotescollection_quote('ajax_refresh=0&tags='.$lang); ?></div>
        
			</div><!-- end of .widget-wrapper -->
            
        <?php responsive_widgets_end(); // after widgets hook ?>
        </div><!-- end of .col-300 fit -->
    </div><!-- end of #widgets -->