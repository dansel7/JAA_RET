<?php
$link = mysql_connect('mysql9.000webhost.com', 'a3970988_jaa', 'qwe123');

if (!$link) {
    die('Not connected : ' . mysql_error());
}

// make foo the current db
$db_selected = mysql_select_db('a3970988_bd', $link);
if (!$db_selected) {
    die ('Can\'t use foo : ' . mysql_error());
}

?>