<?php 
session_start();
if(isset($_SESSION["user_id"])) {
    header("Location: index.php");
}

require_once("includes/db_connect.php");

$message = "";

if(isset($_POST["submit"])) {
    $email = mysqli_real_escape_string($connection, $_POST["email"]);
    $password = mysqli_real_escape_string($connection, $_POST["password"]);
    
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($connection, $query);
    
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row["password"])) {
            $_SESSION["user_id"] = $row["id"];
            header("Location: index.php");
        }
        else {
            $message = "Mot de passe incorrect.";
        }
    }
    else {
        $message = "Aucun compte associé à cette adresse email.";
    }
}

include("includes/header.php");
?>

<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <h3 class="text-center mb-4">Connexion</h3>
            <?php if($message != "") { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $message; ?>
                </div>
            <?php } ?>
            <form action="" method="post">
                <div class="form-group">
                    <label for="email">Adresse email :</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe :</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Se connecter</button>
            </form>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>
