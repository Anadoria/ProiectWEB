<?php
// Find out which image should be shown
$number_of_images = 4;  // Number of images available
$image_index = (intval(time() / 60) % $number_of_images) + 1;
$filename = 'bujori' . $image_index . '.jpg';

// Set up header: we will show image not html
header("Content-type: image/jpeg");

// Pass through the image
readfile($filename);
