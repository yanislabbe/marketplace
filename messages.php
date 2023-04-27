<?php
session_start();
include 'includes/db_connect.php';
include 'includes/header.php';

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Récupère les messages reçus par l'utilisateur connecté
$query = "SELECT messages.*, users.username
          FROM messages
          JOIN users ON messages.from_user_id = users.id
          WHERE messages.to_user_id = '$user_id'
          ORDER BY messages.timestamp DESC";
$result = mysqli_query($conn, $query);
$messages_received = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Récupère les messages envoyés par l'utilisateur connecté
$query = "SELECT messages.*, users.username
          FROM messages
          JOIN users ON messages.to_user_id = users.id
          WHERE messages.from_user_id = '$user_id'
          ORDER BY messages.timestamp DESC";
$result = mysqli_query($conn, $query);
$messages_sent = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <h2>Messages reçus</h2>
            <?php if (!empty($messages_received)) : ?>
                <ul class="list-group">
                    <?php foreach ($messages_received as $message) : ?>
                        <li class="list-group-item">
                            <strong><?php echo $message['username']; ?></strong>
                            <span class="float-right"><?php echo date('d/m/Y H:i', strtotime($message['timestamp'])); ?></span>
                            <p><?php echo $message['message']; ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <p>Aucun message reçu.</p>
            <?php endif; ?>
        </div>
        <div class="col-md-6">
            <h2>Messages envoyés</h2>
            <?php if (!empty($messages_sent)) : ?>
                <ul class="list-group">
                    <?php foreach ($messages_sent as $message) : ?>
                        <li class="list-group-item">
                            <strong><?php echo $message['username']; ?></strong>
                            <span class="float-right"><?php echo date('d/m/Y H:i', strtotime($message['timestamp'])); ?></span>
                            <p><?php echo $message['message']; ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <p>Aucun message envoyé.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
