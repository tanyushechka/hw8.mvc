<?php
require_once __DIR__ . '/models/gallery.php';
$image = findOneImageById($_GET['id']);
$comments = findAllCommentsByImage($_GET['id']);
$c = count($comments);
require_once __DIR__.'/views/image.php';
?>