<?php
require_once __DIR__ . '/models/gallery.php';
if (!empty($_POST['comment'])) {
    $ret = addCommentByImage($_GET['id'], 1, $_POST['comment']);

}
header('Location: details.php?id='.$_GET["id"].'&newComment='.$ret);
require_once __DIR__.'/views/image.php';

?>