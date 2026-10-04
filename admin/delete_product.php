<?php
include '../db.php'; 
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
   
    $query = "DELETE FROM products WHERE id = $id";
    
    if(mysqli_query($conn, $query)) {
        
        header("Location: index.php?deleted=1");
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    header("Location: index.php");
}
?>