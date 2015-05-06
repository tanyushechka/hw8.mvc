<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <link type="text/css" rel="stylesheet" href="style.css"/>
</head>
<body>
<a href="views/loadFile.php">Добавить изображение</a>
<br><br>
<?php if ($c > 0) : ?>
<?php
        foreach ($images as $img) : ?>

<a href="details.php?id=<?php echo $img['id']; ?>" target="_blank"><img class="imageGallery"
                                                                 src="<?php echo $img['path']; ?>"
                                                                 title="<?php echo $img['name']; ?>"></a>
<?php endforeach; ?>
<?php else : ?>
<h3>Ещё никто не добавил картинки в галерею. Будьте первым!</h3>
<?php endif; ?>
</body>
</html>