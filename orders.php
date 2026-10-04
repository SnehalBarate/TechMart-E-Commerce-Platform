<?php
session_start();
if (!isset($_SESSION['user'])) { header("Location: login.php"); exit(); }
include 'db.php';
$email = $_SESSION['user'];
// Database se user ke orders fetch karein
$orders = mysqli_query($conn, "SELECT * FROM orders WHERE user_email='$email' ORDER BY order_date DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Order History | Mini Store Elite</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f5f5f7; font-family: 'SF Pro Display', sans-serif; }
        .history-card { background: white; border-radius: 25px; padding: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="fw-bold mb-4">Your Order History</h2>
    <div class="history-card shadow-sm">
        <table class="table align-middle">
            <thead>
                <tr><th>Product</th><th>Amount</th><th>Date</th></tr>
            </thead>
            <tbody>
                <?php while($o = mysqli_fetch_assoc($orders)): ?>
                <tr>
                    <td class="fw-bold"><?php echo $o['product_name']; ?></td>
                    <td>₹<?php echo number_format($o['price'], 2); ?></td>
                    <td><?php echo date('d M Y', strtotime($o['order_date'])); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="profile.php" class="btn btn-outline-primary rounded-pill mt-3">Back to Profile</a>
    </div>
</div>
</body>
</html>
