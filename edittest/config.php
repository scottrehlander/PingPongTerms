<?php
// connect to db
$link = mysql_connect('db391398570.db.1and1.com', 'dbo391398570', 'highres123');
if (!$link) {
    die('Not connected : ' . mysql_error());
}

if (! mysql_select_db('db391398570') ) {
    die ('Can\'t use db391398570 : ' . mysql_error());
}
?>