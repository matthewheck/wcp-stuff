[
<?php


// Get name of all files in folder and add it to return string
foreach (new DirectoryIterator("slideshow-gallery") as $file) {
    if (! $file->isDot()) {
        if ($file->isFile()) { ?>
        	{
        	"content": "<div class='slider_inner'><img class='photo' src='wp-content/uploads/slideshow-gallery/<?php echo $file; ?>' alt='I Choose Peace'></div>" },

<?php   }
	}
}
?>

]