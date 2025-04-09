<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'Pak';

$db = mysqli_connect($servername, $username, $password, $dbname);
mysqli_query($db, 'SET NAMES utf8');


if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
} 

