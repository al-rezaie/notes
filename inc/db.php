<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'notes2';

$db = mysqli_connect($servername, $username, $password, $dbname);
mysqli_query($db, 'SET NAMES utf8');
// $db = mysqli_connect('localhost', 'root','', 'notes');

if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
} 

