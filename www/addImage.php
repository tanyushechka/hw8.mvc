<?php
require_once __DIR__ . '/models/gallery.php';


define('PATH_ROOT', '/OpenServer/domains/hw8.mvc/www');
define('PATH_BASE', '/gallery/');


require_once __DIR__ . '/views/loadFile.php';

    if (!file_exists(PATH_ROOT . PATH_BASE)) {
        mkdir(PATH_ROOT . PATH_BASE);
    }

//var_dump(loadFile(PATH_ROOT, PATH_BASE));
//var_dump($_SESSION['error']);
    if ($id = loadFile(PATH_ROOT, PATH_BASE)) {
        header('Location: index.php?id='.$id);
    } else {
        echo $_SESSION['error'];
    }



?>