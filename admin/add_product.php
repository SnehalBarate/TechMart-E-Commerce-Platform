<?php
session_start();
include '../db.php';

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $cat = $_POST['category'];
    $image = $_FILES['image']['name'];
    $target = "../images/" . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        mysqli_query($conn, "INSERT INTO products (name, price, image, category) VALUES ('$name', '$price', '$image', '$cat')");
        header("location:index.php?success=1");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Product | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h4 class="fw-bold mb-4">Add New Tech Item</h4>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3"><label>Product Name</label><input type="text" name="name" class="form-control" required></div>
                        <div class="mb-3"><label>Price (INR)</label><input type="number" name="price" class="form-control" required></div>
                        <div class="mb-3">
                            <label>Category</label>
                            <select name="category" class="form-select">
                                <option value="Phone">Phone</option>
                                <option value="Laptop">Laptop</option>
                                <option value="Watch">Watch</option>
                            </select>
                        </div>
                        <div class="mb-4"><label>Product Image</label><input type="file" name="image" class="form-control" required></div>
                        <button type="submit" name="submit" class="btn btn-primary w-100 py-3 rounded-pill fw-bold">Upload Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>