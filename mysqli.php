<?php

$mysqli = new mysqli($db["hostname"], $db["username"], $db["password"], $db["database"]);

if($mysqli->connect_error)
    die("<b>ERROR:</b> ".$mysqli->connect_error."<br>");
else
    echo "<b>Done!</b>";

?>