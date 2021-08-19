<?php

define('DB_SERVER', 'sql208.epizy.com');
define('DB_USERNAME', 'epiz_29478706');
define('DB_PASSWORD', 'OW2dUS72rI');
define('DB_NAME', 'epiz_29478706_taskdb');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
