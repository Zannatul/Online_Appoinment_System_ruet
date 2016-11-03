<?php

$server = "localhost";
$username = "root";
$password = "";
$databaseName = "ruet_online_appoinment";

$conn = mysql_connect($server, $username, $password);

if (!$conn) {
    echo 'Database Connection Error:' . mysql_error();
} else {
    $db_connect = mysql_select_db($databaseName);
    if (!$db_connect) {
        echo 'Database Not Found:' . mysql_error();
    }
}

