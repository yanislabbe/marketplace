<?php
// inclure les fichiers nécessaires
include_once('includes/header.php');
include_once('includes/db_connect.php');

// initialiser les variables de recherche
$search_term = "";
$category = "";
$min_price = "";
$max_price = "";

// récupérer les paramètres de recherche de l'URL
if (isset($_GET['search'])) {
    $search_term = htmlspecialchars(trim($_GET['search']));
}
if (isset($_GET['category'])) {
    $category = htmlspecialchars(trim($_GET['category']));
}
if (isset($_GET['min_price'])) {
    $min_price = htmlspecialchars(trim($_GET['min_price']));
}
if (isset($_GET['max_price'])) {
    $max_price = htmlspecialchars(trim($_GET['max_price']));
}

// construire la requête de recherche
$search_query = "SELECT * FROM items WHERE status='active'";

if (!empty($search_term)) {
    $search_query .= " AND (name LIKE '%$search_term%' OR description LIKE '%$search_term%')";
}

if (!empty($category)) {
    $search_query .= " AND category='$category'";
}

if (!empty($min_price)) {
    $search_query .= " AND price >= $min_price";
}

if (!empty($max_price)) {
    $search_query .= " AND price <= $max_price";
}

// exécuter la requête de recherche
$search_result = mysqli_query($mysqli, $search_query);

// afficher les résultats de recherche
if (mysqli_num_rows($search_result) > 0) {
    while ($item = mysqli_fetch_assoc($search_result)) {
        // afficher chaque article trouvé
        echo "<div class='item'>";
        echo "<h3><a href='item.php?id=" . $item['id'] . "'>" . $item['name'] . "</a></h3>";
        echo "<p>" . $item['description'] . "</p>";
        echo "<p><strong>Price:</strong> $" . $item['price'] . "</p>";
        echo "</div>";
    }
} else {
    // si aucun article n'est trouvé, afficher un message approprié
    echo "<p>No items found.</p>";
}

// fermer la connexion à la base de données
mysqli_close($mysqli);

// inclure le pied de page
include_once('includes/footer.php');
?>
