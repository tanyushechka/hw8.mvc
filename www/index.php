<?php
require_once __DIR__ . '/models/gallery.php';
$images = findAllImages();

$c = count($images);
require_once __DIR__.'/views/index.php';

?>