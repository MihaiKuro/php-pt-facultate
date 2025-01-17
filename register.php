<?php
include '<layout/header.php';

if(isset($_SESSION['user_id'])){
    header('Location: index.php');
    exit;
}

$first_name = "";
$last_name = "";
$email = "";
$password = "";
$confirm_password = "";
$address = "";
$phone= "";

$first_name_error = "";
$last_name_error = "";
$email_error = "";
$password_error = "";
$confirm_password_error = "";
$address_error = "";
$phone_error = "";

$error=false;

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $address = $_POST['address'];
    $phone = $_POST['phone_number'];

    if (empty($first_name)){
        $first_name_error = "First name is required";
        $error = true;
    }

    if (empty($last_name)){
        $last_name_error = "Last name is required";
        $error = true;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email_error = "Email is invalid";
        $error = true;
    }
    include 'utilities/db.php';
    $conn = db_connect();
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->store_result();
    if ($stmt->num_rows > 0){
        $email_error = "Email already exists";
        $error = true;
    }

    $stmt->close();


    if(!preg_match("/^[0-9]{10}$/", $phone)){
        $phone_error = "Phone number is invalid";
        $error = true;
    }


    if(strlen($password) < 6){
        $password_error = "Password must be at least 6 characters";
        $error = true;
    }
    if($confirm_password !== $password){
        $confirm_password_error = "Passwords do not match";
        $error = true;
    }

    if(!$error){
        $password = password_hash($password, PASSWORD_DEFAULT);
        $created_at = date('Y-m-d H:i:s');

        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, 
            password, address, phone, created_at)
                VALUES (?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->bind_param("sssssss", $first_name, $last_name, $email, $password, $address, $phone, $created_at);
        
        $stmt->execute();
        $insert_id = $conn->insert_id;
        $stmt->close();

        $_SESSION['user_id'] = $insert_id;
        $_SESSION['first_name'] = $first_name;
        $_SESSION['last_name'] = $last_name;
        $_SESSION['email'] = $email;
        $_SESSION['address'] = $address;
        $_SESSION['phone_number'] = $phone;
        $_SESSION['created_at'] = $created_at;

        header('Location: index.php');
        exit;
    }



}

?>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-6 mx-auto border shadow p-4">
            <h2 class="text-center mb-4">Register</h2>
            <hr />
            <form action="register.php" method="POST">
                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" name="first_name" class="form-control"  value="<?= $first_name; ?>" required>
                    <span class="text-danger"><?=$first_name_error ?></span>
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" name="last_name" class="form-control" value="<?= $last_name ?>" required>
                    <span class="text-danger"><?=$last_name_error ?></span>
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" value="<?= $email ?>">
                    <span class="text-danger"><?=$email_error ?></span>
                </div>
                <div class="mb-3">
                    <label for="phone_nubmer" class="form-label">Phone Number</label>
                    <input type="Number" name="phone_number" class="form-control" id="phone_number" value="<?=$phone ?>" required>
                    <span class="text-danger"><?=$phone_error ?></span>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" id="address" value="<?=$address ?>" required>
                    <span class="text-danger"><?=$address_error ?></span>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                    <span class="text-danger"><?=$password_error ?></span>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" id="confirm_password" required>
                    <span class="text-danger"><?=$confirm_password_error ?></span>
                </div>
                <div class="mb-3">
                    <a href="login.php">you already have an account? </a>
                </div>
                <div class="row mb-3">
                    <div class="offset-sm-2 col-sm-4 d-grid">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                    <div class="col-sm-4 d-grid">
                        <a href="index.php" class="btn btn-outline-primary">Back to the homepage</a>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>


<?php
include 'layout/footer.php';
?>