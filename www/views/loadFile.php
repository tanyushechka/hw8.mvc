<?php $_SESSION['login'] = 'tagedo'; ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>loadNewFile</title>
    <link type="text/css" rel="stylesheet" href="style.css"/>
</head>
<body>
<div id="wrapper">
    <div id="header">

        <?php if (!isset($_SESSION['login'])) : ?>
        Чтобы загрузить изображение, нужно
        <a href="authorize.php">войти</a><label>&nbsp;|&nbsp;<a href="registry.php">зарегистрироваться</a>
            <?php else : ?>
                Вы вошли как <?php echo $_SESSION['login']; ?>
            <?php endif; ?>
            <br><br>
    </div>

    <form id="load" action="/../addImage.php" method="post" enctype="multipart/form-data" name="uploadform">
        <fieldset>
            <input type="file" form="load" name="image" <?php if (!isset($_SESSION['login'])) {
                echo 'disabled="disabled"';
            } ?>/>
            <input type="submit" form="load" value="Загрузить"
                <?php if (!isset($_SESSION['login'])) {
                    echo 'disabled="disabled"';
                } ?>
                />
            <label class="redlabel"><?php echo $_SESSION['error'];
                unset($_SESSION['error']); ?></label><br><br>
        </fieldset>
    </form>
</div>
</body>
</html>