<?php
include 'db.php';
session_start();
if (isset($_SESSION['user'])) { header("location:index.php"); exit(); }

$message = "";
if (isset($_POST['register'])) {
    // Treat the email input as the 'username' for your database column
    $user = mysqli_real_escape_string($conn, $_POST['email']); 
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Check if email already exists
    $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$user'");
    if (mysqli_num_rows($check) > 0) {
        $message = "<div class='alert alert-warning py-1 small text-center'>Email already registered!</div>";
    } else {
        $query = "INSERT INTO users (username, password) VALUES ('$user', '$pass')";
        if (mysqli_query($conn, $query)) {
            $message = "<div class='alert alert-success py-1 small text-center'>Account Created! <a href='login.php' class='fw-bold'>Login Now</a></div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | Tech Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            /* Keeps your original tech background */
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), 
                        url('https://images.unsplash.com/photo-1550009158-9ebf69173e03?auto=format&fit=crop&w=1500&q=80');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
        }
        .register-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(8px);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center">
        <div class="card register-card p-4 shadow-lg border-0" style="width: 400px;">
            <div class="text-center mb-4">
                <i class="bi bi-person-plus-fill text-success" style="font-size: 3rem;"></i>
                <h3 class="fw-bold">Create Account</h3>
                <p class="text-muted small">Join our Tech Community</p>
            </div>
            
            <?php echo $message; ?>
            
            <form method="POST" autocomplete="off">
                <div class="mb-3">
                    <label class="form-label small fw-bold">Email Address</label>
                    <input type="email" name="email" class="form-control" autocomplete="off" placeholder="example@mail.com" required>
                </div>
                <div class="mb-4">
                    <label class="form-label small fw-bold">Create Password</label>
                    <input type="password" name="password" class="form-control" autocomplete="new-password" placeholder="Create password" required>
                </div>
                <button type="submit" name="register" class="btn btn-success w-100 fw-bold py-2 shadow">Register Now</button>
            </form>
            <p class="text-center mt-3 small text-muted">Already a member? <a href="login.php" class="text-decoration-none fw-bold">Login</a></p>
        </div>
    </div>
</body>
</html>
