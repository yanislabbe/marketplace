<?php
// Inclure le fichier de connexion à la base de données
include('includes/db_connect.php');

// Vérifier si l'utilisateur est connecté sinon rediriger vers la page de connexion
if(!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}

// Récupérer l'ID de l'article à afficher
$item_id = $_GET['id'];

// Récupérer les informations de l'article depuis la base de données
$query = "SELECT * FROM items WHERE id = '$item_id'";
$result = mysqli_query($conn, $query);
$item = mysqli_fetch_assoc($result);

// Récupérer les informations de l'utilisateur qui a publié l'article
$user_id = $item['user_id'];
$query = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

?>
<!-- Afficher les détails de l'article -->
<!DOCTYPE html>
<html>
<head>
  <title><?php echo $item['name']; ?></title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <?php include('includes/header.php'); ?>
  <div class="container">
    <h1><?php echo $item['name']; ?></h1>
    <div class="item-details">
  <div class="item-image">
    <img src="<?php echo $item['image_url']; ?>" alt="<?php echo $item['name']; ?>">
  </div>

  <div class="item-info">
    <p><strong>Description :</strong> <?php echo $item['description']; ?></p>
    <p><strong>Prix :</strong> <?php echo $item['price']; ?>€</p>
    <p><strong>Vendeur :</strong> <?php echo $user['username']; ?></p>
    <p><strong>Email du vendeur :</strong> <?php echo $user['email']; ?></p>
  </div>
</div>
</div>
  <?php include('includes/footer.php'); ?>
</body>
</html>