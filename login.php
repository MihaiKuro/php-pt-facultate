<?php

include "layout/header.php";

if(isset($_SESSION['email'])){
    header('Location: index.php');
    exit;
}

$email = "";
$error = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($email) || empty($password)){
        $error = "Email and password are required";
    }else{
        include 'utilities/db.php';
        $conn = db_connect();
        $stmt = $conn->prepare("SELECT id, first_name, last_name, email, password, created_at FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $stmt->bind_result($id, $first_name, $last_name, $email, $hashed_password, $created_at);

        if($stmt->fetch()){
            if(password_verify($password, $hashed_password)){
                $_SESSION['user_id'] = $id;
                $_SESSION['first_name'] = $first_name;
                $_SESSION['last_name'] = $last_name;
                $_SESSION['email'] = $email;
                $_SESSION['created_at'] = $created_at;

                header('location: index.php');
                exit;
            }
    }
    $stmt->close();
    $error = "Invalid email or password";
    }
}
?>

<div class="container py-5">
    <div class="mx-auto border shadow p-4" style="width: 400px;">
        <h2 class="text-center mb-4">Login</h2>
        <hr />
        <?php if(!empty($error)){?>
            <div class="alert alert-danger allert-dismissible fade show" role="alert">
                <strong><?= $error ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>
        <form action="login.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" value="<?= $email ?>">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password"  >
            </div>
            <div class="mb-3">
                <a href="register.php">Don't have an account? Register</a>
            </div>
            <div class="row mb-2">
                <div class="offset-sm-1 col-sm-5 d-grid">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
                <div class="col-sm-5 d-grid">
                    <a href="index.php" class="btn btn-outline-primary">Back to the homepage</a>
                </div>
            </div>

        </form>
    </div>
</div>
<?php
include "layout/footer.php";
?>