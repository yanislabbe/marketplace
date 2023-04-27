<?php
    require_once('includes/db_connect.php');
    session_start();
    
    if(!isset($_SESSION['user_id'])){
        header("Location: login.php");
        exit;
    }
    
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM users WHERE id = '$user_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        
        $sql = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', email = '$email' WHERE id = '$user_id'";
        mysqli_query($conn, $sql);
        
        header("Location: profile.php");
        exit;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <?php require_once('includes/header.php'); ?>
</head>
<body>
    <?php require_once('includes/navbar.php'); ?>
    <div class="container mt-5">
        <h2>Edit Profile</h2>
        <form method="POST">
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $row['first_name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $row['last_name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
    <?php require_once('includes/footer.php'); ?>
</body>
</html>
