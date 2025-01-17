<?php
include '<layout/header.php';

if (!isset($_SESSION['email'])) {
    header('Location: index.php');
    exit;
}
?>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-6 mx-auto-border shadow p-4">
            <h2 class="text-center mb-4">Profile</h2>
            <hr />

            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" name="first_name" class="form-control" value="<?= $_SESSION['first_name'] ?>" >
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" name="last_name" class="form-control" value="<?= $_SESSION['last_name'] ?>" >
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?= $_SESSION['email'] ?>" >
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="number" name="phone_number" class="form-control" value="<?= $_SESSION['phone_number'] ?>" >
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" name="address" class="form-control" value="<?= $_SESSION['address'] ?>" >
            </div>
            <div class="mb-3">
                <div class="col-sm4">Registered at</div>
                <div class="col-sm8"><?= $_SESSION['created_at'] ?></div>
            </div>
            
        </div>

    </div>
</div>


<?php
include 'layout/footer.php';
?>