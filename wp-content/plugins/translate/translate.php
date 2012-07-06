<?php
/*
Plugin Name: Translate
Plugin URI: http://www.misternifty.com/translate
Description: Display different content from within a single post or page based on a user's language or version selection. NOTE: COMMA DELIMITERS HAVE BEEN CHANGED TO PIPE DELIMITERS FOR PARAMETERS! Use the symbol | to separate parameters.
Version: 1.2
Author: Brian Fegter
Author URI: http://www.misternifty.com
*/

if(!mysql_num_rows(mysql_query("SHOW TABLES LIKE 'wp_translate'")))
{
$i = "CREATE TABLE wp_translate
( 
ID int NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(ID),
name varchar(25) NOT NULL,
main boolean NOT NULL
)";
mysql_query($i);
}


add_action('admin_menu', 'translate_admin');
add_action('init', 't_change_lang');
add_action('wp_head', 't_shortcode_style');
add_action("plugins_loaded", "translate_widget");
add_filter('widget_text', 'do_shortcode');
add_shortcode('translate', 't_shortcode',2);
add_shortcode('translations', 'list_translations',1);
add_shortcode('list_pages', 'translate_list_pages');


function translate_admin()
{
    add_menu_page('Translate Options', 'Translate', 8, __FILE__, 'translate_options');
}


function translate_options()
{?>
    <div class="wrap">
    <h2>Translate</h2>
    <?php if($_POST['language']):
        $lang = $_POST['language'];
        add_lang($lang);
    endif;
    if($_GET['lang_default']):
        lang_default($_GET['lang_default']);
    endif;
    if($_GET['lang_del']):
        del_lang($_GET['lang_del']);
    endif;
    ?>
    <h3>Add A Language</h3>
    <form method="post">
        <p><label>Name:</label>
        <input name="language" type="text"></p>
        <p><input class="button-primary" type="submit" value="Add Language"></p>
    </form>
    <h2>Languages</h2>
    <em>Click language name to make default.</em>
    <p>
    <ul>
    <?php global $wpdb;
    $langs = $wpdb->get_results('SELECT * from wp_translate', ARRAY_A);
    if($langs):
    foreach($langs as $lang)
    {
        if($lang['main']):$language = "<strong>".lang_proper($lang['name'])."</strong> (default)";else: $language = lang_proper($lang['name']); endif;
        echo "<li></a> <a style='text-decoration:none;' title='Delete' href='admin.php?page=translate.php&lang_del=".$lang['name']."'>[Delete]</a> - <a href='admin.php?page=translate.php&lang_default=".$lang['name']."' title='Make Default'>".$language."</li>";
    }   
    ?>
    </ul></p>
    </div>   
    
    <?php else:
        echo "<span style='font-weight:bold; color:red;'>Please add a language!</span>";
    endif; }


function lang_default($lang)
{
    $langcheck = lang_check($lang);
    if($langcheck):
        $i = "UPDATE wp_translate SET main = '0' WHERE main = '1'";
        mysql_query($i);
        $i = "UPDATE wp_translate SET main = '1' WHERE name = '".$lang."'";
        mysql_query($i);
    endif;
    
}


function langs_check($lang)
{
    global $wpdb;
    $langs = $wpdb->get_results('SELECT name from wp_translate WHERE name = "'.$lang.'"', ARRAY_A);
    if($langs):
        echo "That language already exists in the database."; return false;
    else: return true;
    endif;
}

function add_lang($lang)
{
    if(langs_check($lang)):
    $language = strtolower($lang);
    global $wpdb;
    $i = $wpdb->get_results('SELECT * FROM wp_translate');
    if($i):$main = 0;else: $main=1;endif;
    $add_lang ='INSERT INTO wp_translate (name, main) VALUES ("'.$language.'", '.$main.')';
    mysql_query($add_lang);
    if($add_lang):
    echo "Language added successfully!";
    endif;
    endif;
}

function del_lang($lang)
{
    if(!$_POST['language']):
    if(lang_check($lang)):
        $i = "DELETE from wp_translate WHERE name = '".$lang."'";
        mysql_query($i);
        $i = "SELECT main from wp_translate WHERE main = '1'";
        $results = mysql_query($i);
        if(!mysql_num_rows($results)):
            $i = "UPDATE wp_translate SET main = '1' LIMIT 1";
            mysql_query($i);
        endif;
        echo "Language deleted!";
    endif;
    endif;
}

function t_shortcode_style()
{
    global $wpdb;
    echo '<style>';
    $langs = $wpdb->get_results("SELECT name FROM wp_translate WHERE name != '".$_SESSION['language']."'", ARRAY_A);
    foreach($langs as $lang)
    {
        echo ".translate_".$lang['name']."{display:none;}";
    }
    echo '</style>';
}

function t_shortcode($atts, $content = null)
{
    $lang = strtolower($atts['lang']);
    $content = "<div class='translate_".$lang."'>".$content."</div>";
    if($lang == $_SESSION['language']):

    return $content;
    endif;

}

function lang_check($lang)
{
    global $wpdb;
    $langcheck = $wpdb->get_results("SELECT name from wp_translate WHERE name = '".$lang."'");
    if(empty($langcheck)): return false; else: return true; endif;
}

function url_check()
{
    $currenturl = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
    $currenturl = preg_replace('/[\&\?]lang\=[a-z]*/', '', $currenturl);
    $currenturl = preg_replace('/index\.[a-z]*/', '', $currenturl);
    if(strpos($currenturl, '?')):
    return true;
    else: return false;
    endif;
}

function lang_proper($lang)
{
    $proper = strtolower($lang);
    $proper = substr_replace($lang, strtoupper(substr($lang, 0, 1)), 0, 1);
    return $proper;
}

function list_translations()
{
    $currenturl = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
    $currenturl = preg_replace('/[\&\?]lang\=[a-z]*/', '', $currenturl);
    $currenturl = preg_replace('/index\.[a-z]*/', '', $currenturl);
        global $wpdb;
    $trans = $wpdb ->get_results("SELECT name FROM wp_translate");
    echo "<ul class='translate'>";
    foreach($trans as $tran)
    {
        if(url_check()):$transurl = '&lang='.$tran->name; else:$transurl = '?lang='.$tran->name; endif;
        $translist .= '<li class="list_item_'.$tran->name.'"><a href="'.$currenturl.$transurl.'">'.lang_proper($tran->name).'</a></li>';
    }
    echo $translist."</ul>";
}


function translate_list_pages()
{
    global $wpdb;
    $pages = $wpdb->get_results('SELECT ID, post_type, post_status, post_id, meta_key, meta_value FROM wp_posts, wp_postmeta WHERE post_status = "publish" AND post_type = "page" AND ID = post_id AND meta_key = "'.$_SESSION['language'].'" ORDER BY meta_value ASC', ARRAY_A);
    echo "<ul>";
    if($pages):
    foreach($pages as $page)
    {
        echo "<li class='page_item page-item-".$page['ID']."'><a href='".get_page_link($page['ID'])."' title='".$page['meta_value']."'>".$page['meta_value']."</a></li>";
    }
    echo "</ul>";
    endif;
}

function translate_link($args)
{
    $template = get_bloginfo('template_directory');
    $home = get_bloginfo('home');
    $args = preg_replace("/TEMPLATEPATH/", $template, $args);
    $args = preg_replace("/HOME/", $home, $args);
    $atts = explode('|', $args);
    $params[] = '';
    foreach($atts as $att)
    {
        $att = trim($att);
        $param = explode('=', $att);
        $params[$param[0]] = $param[1];
    }
    $lang = $params['lang'];
    $langcheck = lang_check($lang);
    if($langcheck):
        if($lang == $_SESSION['language']):
        $text = $params['text'];
        $link = $params['link'];
        $target = $params['target'];
        if($target):$target = " target='".$target."'"; else: $target=null; endif; 
        $class = $params['class'];
        if (!$class): $class = " class='".$lang."_link' "; else: $class = " class='".$params['class']."' "; endif;
            echo '<a'.$class.'href="'.$link.'"'.$target.'>'.$text.'</a>';
        endif;
    endif;
    //link, text, class, lang, target  %language%_link  
}

function translate_text($args)
{
    $template = get_bloginfo('template_directory');
    $home = get_bloginfo('home');
    $args = preg_replace("/TEMPLATEPATH/", $template, $args);
    $args = preg_replace("/HOME/", $home, $args);
    $atts = explode('|', $args);
    $params[] = '';
    foreach($atts as $att)
    {
        $att = trim($att);
        $param = explode('=', $att);
        $params[$param[0]] = $param[1];
    }
    $lang = $params['lang'];
    $langcheck = lang_check($lang);
    if($langcheck):
        if($lang == $_SESSION['language']):
            $text = $params['text'];
            $class = $params['class'];
            $p = $params['p'];
            if (!$class): $class = " class='".$lang."_text'"; else: $class = " class='".$params['class']."'"; endif;
            if($p == null || $p == "yes"):
            if($text):
                echo "<p".$class.">".$text."</p>";
            endif;
            endif;
            if ($p == "no"):
            if($text):
                echo $text;
            endif;
            endif;
        endif;
    endif;
    //text, class, lang %language%_link
}


function translate_image($args)
{
    $template = get_bloginfo('template_directory');
    $home = get_bloginfo('home');
    $args = preg_replace("/TEMPLATEPATH/", $template, $args);
    $args = preg_replace("/HOME/", $home, $args);
    $atts = explode('|', $args);
    $params[] = '';
    foreach($atts as $att)
    {
        $att = trim($att);
        $param = explode('=', $att);
        $params[$param[0]] = $param[1];
    }
    $lang = $params['lang'];
    $langcheck = lang_check($lang);
    if($langcheck):
    if($lang == $_SESSION['language']):
        $link = $params['link'];
        $target = $params['target'];
        $src = $params['src'];
        $alt = $params['alt'];
        $title = $params['title'];
        $class = $params['class'];
        if (!$class): $class = " class='".$lang."_image' "; else: $class = " class='".$params['class']."' "; endif;
        if(!$target):$target=null;endif;
        if($title):$title = " title='".$title."'";endif;
        if($alt): $alt = " alt='".$alt."'";endif;
        if($target):$target = " target='".$target."'";endif; 
        if($lang == $_SESSION['language']):
            if($link): echo "<a href='".$link."'".$target.">"; endif;
            if($src): echo "<img ".$class."src='".$src."'".$alt.$title.">"; endif;
            if($link): echo "</a>"; endif;
        endif;
    endif;
    endif;
    //tags - link, target, src, alt, title, lang, class  %language%_image
}

function t_change_lang()
{
    
    global $wpdb;
    $i = 'SELECT * FROM wp_translate';
    $results = mysql_query($i);
    $numrows = mysql_num_rows($results);
    if($numrows == 0):
        unset($_SESSION['language']);
    endif;
    
    $i = "SELECT * FROM wp_translate WHERE name = '".$_SESSION['language']."'";
    $results = mysql_query($i);
    $numrows = mysql_num_rows($results);
    if($numrows == 0):
        global $wpdb;
        $i = $wpdb->get_results("SELECT * from wp_translate WHERE main = '1'", ARRAY_A);
        if($i):
            foreach($i as $newlang)
            {
                $_SESSION['language'] = $newlang['name'];
            }
        endif;
        
    endif;
    
    $lang = $_GET['lang'];
    $langcheck = lang_check($lang);
    if($langcheck):
        $_SESSION['language']=$lang;
    endif;   
}

function translate_title()
{
    $lang = $_SESSION['language'];
    if($_SESSION['language']):
        global $wpdb;
        global $post;
        $i = $wpdb->get_results('SELECT meta_key, post_id from wp_postmeta WHERE meta_key = "'.$_SESSION['language'].'" AND post_id = "'.$post->ID.'"');
        if($i):
        $title = get_post_meta($post->ID, $_SESSION['language'], true);
        echo $title;
        else: the_title();
        endif;
    else:
    the_title();
    endif;
}

function translate_pages_widget() 
{
     translate_list_pages();
}

function translate_widget()
{
     register_sidebar_widget(__('Translate: Page List'), 'translate_pages_widget');
}




?>