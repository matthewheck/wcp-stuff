<?php

// Declare return string
$fileNames = "";

// Get name of all files in folder and add it to return string
   foreach (new DirectoryIterator("wp-content/uploads/slideshow-gallery") as $file) {
    if (! $file->isDot()) {
        if ($file->isFile()) {
            $fileNames .= $file . ":";
    }
}
}

// Return string
echo $fileNames;

?>