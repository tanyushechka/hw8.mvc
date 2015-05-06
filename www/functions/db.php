<?php
function dbConnect()
{
    mysql_connect('localhost', 'root', '');
    mysql_select_db('php1test');
}

function findAllByQuery($sql)
{
    dbConnect();
    $res = mysql_query($sql);
    $ret = [];
    while (false !== ($row = mysql_fetch_array($res))) {
        $ret[] = $row;
    }
    return $ret;
}

function findOneByQuery($sql)
{
    return findAllByQuery($sql)[0];
}

function addNewByQuery($sql) {
    dbConnect();
    mysql_query($sql);
    return mysql_insert_id();
}
?>