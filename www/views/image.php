<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>imageDetails</title>
    <link type="text/css" rel="stylesheet" href="style.css"/>
</head>
<body>

<div id="main">


        <img id="img" src="<?php echo $image['path']; ?>"
            <?php if ($image['height'] > 500) {
                echo 'height="500"';
            } ?>  >


        <h4><?php echo $image['description']; ?></h4>
        <h4><?php echo 'Добавлено ' . $image['date'] . ', &nbsp;&nbsp;' . $image['width'] . 'x' . $image['height'] . ',
        &nbsp;&nbsp;' . $image['size'] . ' KB'; ?></h4>
    <h4>Комментировать</h4>

    <form id="edit" action="addComment.php?id=<?php echo $image['id']; ?>" method="post"
          enctype="multipart/form-data" name="editcomment">
        <textarea form="edit" name="comment" cols="100" rows="3"></textarea><br/>
        <input type="submit" form="edit" name="edit" value="Сохранить"/>
    </form>
    <?php
    if ($c > 0) : ?>

        <h4>Комментариев <?php echo $c; ?></h4>


        <?php foreach ($comments as $comment) : ?>


            <h4><?php echo ' ' . $comment['date']; ?></h4>


            <pre><?php echo $comment['text']; ?></pre>

        <?php endforeach; ?>
    <?php else : ?>
        <h4>Ещё никто не прокомментировал это. Будьте первым!</h4>
    <?php endif; ?>
</div>

</body>
</html>