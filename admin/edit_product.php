<?php
include '../db.php';

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM products WHERE id = $id");
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    
    // Update query
    $update_query = "UPDATE products SET name='$name', price='$price', category='$category' WHERE id=$id";
    
    if(mysqli_query($conn, $update_query)) {
        header("Location: index.php?updated=1");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Product | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card border-0 shadow-sm p-4 mx-auto" style="max-width: 500px; border-radius: 20px;">
            <h4 class="fw-bold mb-4">Edit Product Details</h4>
            <form method="POST">
                <div class="mb-3">
                    <label>Product Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>" required>
                </div>
                <div class="mb-3">
                    <label>Price (INR)</label>
                    <input type="number" name="price" class="form-control" value="<?php echo $row['price']; ?>" required>
                </div>
                <div class="mb-3">
                    <label>Category</label>
                    <select name="category" class="form-select">
                        <option value="Phone" <?php if($row['category']=='Phone') echo 'selected'; ?>>Phone</option>
                        <option value="Laptop" <?php if($row['category']=='Laptop') echo 'selected'; ?>>Laptop</option>
                        <option value="Watch" <?php if($row['category']=='Watch') echo 'selected'; ?>>Watch</option>
                    </select>
                </div>
                <button type="submit" name="update" class="btn btn-primary w-100 rounded-pill py-2 fw-bold">Update Product</button>
            </form>
        </div>
    </div>
</body>
</html>