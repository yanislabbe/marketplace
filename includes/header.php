<!DOCTYPE html>
<html>
<head>
	<title>Place de marché en ligne</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<header>
		<div class="container">
			<div id="branding">
				<h1><span class="highlight">Place de marché</span> en ligne</h1>
			</div>
			<nav>
				<ul>
					<li class="current"><a href="index.php">Accueil</a></li>
					<li><a href="search.php">Rechercher des articles</a></li>
					<?php if(isset($_SESSION['user_id'])) : ?>
						<li><a href="sell.php">Vendre un article</a></li>
						<li><a href="transactions.php">Mes transactions</a></li>
						<li><a href="profile.php">Mon profil</a></li>
						<li><a href="logout.php">Déconnexion</a></li>
					<?php else : ?>
						<li><a href="login.php">Se connecter</a></li>
						<li><a href="register.php">S'inscrire</a></li>
					<?php endif; ?>
				</ul>
			</nav>
		</div>
	</header>
