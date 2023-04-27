<?php
// Informations de connexion à la base de données
$servername = "10.18.200.215";
$username = "xyz";
$password = "0862";
$dbname = "web";

// Connexion à la base de données MySQL
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Vérification de la connexion
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
