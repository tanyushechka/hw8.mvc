<?php
require_once __DIR__ . '/../functions/db.php';

function findAllImages()  // получение массива из БД для загрузки галереи
{
    $sql = 'SELECT * FROM images ORDER BY date DESC';
    $ret = findAllByQuery($sql);
    return $ret;
}

function findOneImageById($id)
{
    $sql = 'SELECT * FROM images WHERE id = ' . $id;
    $ret = findOneByQuery($sql);
    return $ret;
}

function findAllCommentsByImage($idImg)
{
    $sql = 'SELECT * FROM comments WHERE id_img = ' . $idImg . ' ORDER BY date DESC';
    $ret = findAllByQuery($sql);
    return $ret;
}

function addCommentByImage($idImg, $idUser, $text)
{
    $sql = 'INSERT INTO comments (id_img, id_user, date, text) VALUES (' . $idImg . ', ' . $idUser . ', \'' . date("d.m.y H:i:s",
            time()) . '\', \'' . $text . '\')';
    return addNewByQuery($sql);
}
function getIdUserByUsername($username) {
    $sql = 'SELECT id FROM users WHERE username = \''.$username.'\'';
    $ret = findOneByQuery($sql)['id'];
    return $ret;
}

function insertImageToBase($name, $date, $path, $username, $width, $height, $size)   // записываем информацию в БД о новой загруженной картинке
{
    $idUser = getIdUserByUsername($username);
    //var_dump($idUser);
    $sql = 'INSERT INTO images (name, date, path, id_user, width, height, size) VALUES
            (\'' . $name . '\', \'' . $date . '\', \'' . $path . '\', ' . $idUser . ', ' . $width . ', ' . $height . ', ' . $size . ')';
    //var_dump($sql);
    return addNewByQuery($sql);
}

function isImage($f)  // проверка на картинку по расширению
{
    $ff = strtolower(pathinfo($f)['extension']);
    return (($ff == 'gif') || ($ff == 'jpg') || ($ff == 'jpeg') || ($ff == 'png'));
}


function isReadable($pach)  // читаемо ли
{
    return ((is_readable($pach)) && (filesize($pach) > 0));
}


function loadFile($pathRoot, $pathBase)  //  загрузка новой картинки в нужный каталог
{
    $newName = $pathRoot . $pathBase . basename($_FILES['image']['name']);
    //var_dump($newName);
    $name = $pathBase . basename($_FILES['image']['name']);
    switch (true) {
        case !is_uploaded_file($_FILES['image']['tmp_name']) :
            switch ($_FILES['image']['error']) {
                case 1:
                    $_SESSION['error'] = 'UPLOAD_ERR_INI_SIZE';
                    return false;
                case 2:
                    $_SESSION['error'] = 'UPLOAD_ERR_FORM_SIZE';
                    return false;
                case 3:
                    $_SESSION['error'] = 'UPLOAD_ERR_PARTIAL';
                    return false;
                case 4:
                    $_SESSION['error'] = 'UPLOAD_ERR_NO_FILE';
                    return false;
                case 6:
                    $_SESSION['error'] = 'UPLOAD_ERR_NO_TMP_DIR';
                    return false;
                case 7:
                    $_SESSION['error'] = 'UPLOAD_ERR_CANT_WRITE';
                    return false;
                case 8:
                    $_SESSION['error'] = 'UPLOAD_ERR_EXTENSION';
                    return false;
            }
            return false;

        case file_exists($newName) :
            $_SESSION['error'] = 'FILE_EXISTS';
            return false;

        case !isImage($_FILES['image']['name']) :
            $_SESSION['error'] = 'NOT_AN_IMAGE';
            return false;

        case !isReadable($_FILES['image']['tmp_name']) || ('' == getimagesize($_FILES['image']['tmp_name'])[3]) :
            $_SESSION['error'] = 'NOT_FOR_READ';
            return false;
/*
        case getimagesize($_FILES['image']['tmp_name'])[3] < 20 :
            $_SESSION['error'] = $_FILES['image']['tmp_name'][3].' is_TOO_SMALL';
            return false;
*/
        case move_uploaded_file($_FILES['image']['tmp_name'], $newName) :
        return    insertImageToBase(basename($_FILES['image']['name']), date("d.m.y H:i:s", filectime($newName)), $name, $_SESSION['login'],
                getimagesize($newName)[0], getimagesize($newName)[1], filesize($newName));


        default :
            $_SESSION['error'] = 'UNKNOWN_ERROR';
            return false;
    }

}

?>