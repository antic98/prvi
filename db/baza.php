<?php

$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "utakmice";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Greska prilikom konekcije na bazu: " . $conn->connect_error);
}
