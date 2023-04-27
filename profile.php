<?php
// Vérifie si l'utilisateur est connecté
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Inclut le fichier de connexion à la base de données
require_once 'includes/db_connect.php';

// Récupère les informations de l'utilisateur connecté
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Affiche les informations de l'utilisateur
?>

<!DOCTYPE html>
<html>
<head>
	<title>Mon profil</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<?php include 'includes/header.php'; ?>

	<div class="container">
		<h1>Mon profil</h1>
		<p>Nom d'utilisateur : <?php echo $user['username']; ?></p>
		<p>Adresse email : <?php echo $user['email']; ?></p>
		<p>Nom : <?php echo $user['first_name']; ?></p>
		<p>Prénom : <?php echo $user['last_name']; ?></p>
		<p>Date de naissance : <?php echo $user['birthdate']; ?></p>
		<a href="edit_profile.php">Editer mon profil</a>
	</div>

	<?php include 'includes/footer.php'; ?>
</body>
</html>
