<?php
$host = 'mysql';
$user = 'root';
$pass = 'rootpassword';
$dbname = 'mysql';
$con = new mysqli($host, $user, $pass, $dbname);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} else {}?>