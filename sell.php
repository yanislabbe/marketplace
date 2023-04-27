<?php
// Inclure le fichier de connexion à la base de données
include('includes/db_connect.php');

// Vérifier si l'utilisateur est connecté sinon rediriger vers la page de connexion
if(!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}

// Initialiser les variables d'article
$name = '';
$description = '';
$price = '';

// Vérifier si le formulaire de vente a été soumis
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Récupérer les valeurs de formulaire soumises par l'utilisateur
  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = $_POST['price'];

  // Valider les données de formulaire
  $errors = array();

  if(empty($name)) {
    $errors['name'] = 'Veuillez entrer un nom pour votre article';
  }

  if(empty($description)) {
    $errors['description'] = 'Veuillez entrer une description pour votre article';
  }

  if(empty($price) || !is_numeric($price)) {
    $errors['price'] = 'Veuillez entrer un prix valide pour votre article';
  }

  // Si il n'y a pas d'erreur, insérer les données de formulaire dans la base de données
  if(empty($errors)) {
    $user_id = $_SESSION['user_id'];

    $query = "INSERT INTO items (name, description, price, user_id) VALUES ('$name', '$description', '$price', '$user_id')";

    mysqli_query($conn, $query);

    header('Location: index.php');
    exit;
  }
}

?>

<!-- Afficher le formulaire de vente pour l'utilisateur connecté -->
<!DOCTYPE html>
<html>
<head>
  <title>Vendre un article</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <?php include('includes/header.php'); ?>

  <div class="container">
    <h1>Vendre un article</h1>

    <form method="POST" action="">
      <div>
        <label for="name">Nom de l'article</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>">
        <?php if(isset($errors['name'])) echo '<p class="error">' . $errors['name'] . '</p>'; ?>
      </div>

      <div>
        <label for="description">Description de l'article</label>
        <textarea name="description"><?php echo htmlspecialchars($description); ?></textarea>
        <?php if(isset($errors['description'])) echo '<p class="error">' . $errors['description'] . '</p>'; ?>
      </div>

      <div>
        <label for="price">Prix de l'article</label>
        <input type="text" name="price" value="<?php echo htmlspecialchars($price); ?>">
        <?php if(isset($errors['price'])) echo '<p class="error">' . $errors['price'] . '</p>'; ?>
      </div>

      <button type="submit">Vendre l'article</button>
    </form>
  </div>
  <?php
// Include footer file
include 'includes/footer.php';
?>
</body>
</html>