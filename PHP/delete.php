<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'inventory_db';

// Create a connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if ID is set
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Delete query
    $sql = "DELETE FROM items WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Item deleted successfully!'); window.location.href = 'inventory.php';</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Invalid ID";
}
?>
