<?php
  // inclure le fichier de connexion à la base de données
  include_once 'includes/db_connect.php';

  // requête SQL pour sélectionner les 6 derniers articles ajoutés
  $sql = "SELECT * FROM articles ORDER BY date_ajout DESC LIMIT 6";
  $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Place de marché en ligne</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <?php include_once 'includes/header.php'; ?>

  <main>
    <h1>Bienvenue sur notre place de marché en ligne !</h1>
    <p>Vous pouvez acheter, vendre et échanger des articles neufs ou d'occasion.</p>

    <h2>Les derniers articles ajoutés</h2>
    <div class="grid">
      <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="item">
          <a href="item.php?id=<?php echo $row['id']; ?>">
            <img src="images/<?php echo $row['image']; ?>" alt="<?php echo $row['nom']; ?>">
            <h3><?php echo $row['nom']; ?></h3>
            <p><?php echo $row['prix']; ?> €</p>
          </a>
        </div>
      <?php endwhile; ?>
    </div>
  </main>

  <?php include_once 'includes/footer.php'; ?>
</body>
</html>
