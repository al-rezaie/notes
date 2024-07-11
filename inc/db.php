<?php

$db = mysqli_connect("localhost", "root", "", "notes");
mysqli_query($db, 'SET NAMES utf8');

if(!$db) {
    die('connected failed :' . mysqli_connect_error());
}

?>