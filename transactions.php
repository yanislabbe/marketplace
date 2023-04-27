<?php
session_start();
require_once('includes/db_connect.php');
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM transactions WHERE buyer_id=$user_id OR seller_id=$user_id ORDER BY date DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Transactions - My Marketplace</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include('includes/header.php'); ?>

    <div class="container">
        <h1>Transactions</h1>

        <table>
            <tr>
                <th>Transaction ID</th>
                <th>Date</th>
                <th>Buyer</th>
                <th>Seller</th>
                <th>Item</th>
                <th>Price</th>
                <th>Status</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['buyer_name']; ?></td>
                    <td><?php echo $row['seller_name']; ?></td>
                    <td><?php echo $row['item_name']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                </tr>
            <?php } ?>

        </table>

    </div>

    <?php include('includes/footer.php'); ?>
</body>

</html>
