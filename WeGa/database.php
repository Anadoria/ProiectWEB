<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$dbname = 'wega';

$conn = new mysqli($hostname, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexiunea a eșuat: " . $conn->connect_error);
}
