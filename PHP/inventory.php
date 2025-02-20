<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'inventory_db';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    
    if (isset($_POST['item_id']) && !empty($_POST['item_id'])) {
        
        $item_id = $_POST['item_id'];
        $sql = "UPDATE items SET name='$name', quantity='$quantity', price='$price' WHERE id=$item_id";
    } else {
       
        $sql = "INSERT INTO items (name, quantity, price) VALUES ('$name', '$quantity', '$price')";
    }

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Item saved successfully!'); window.location.href = 'inventory.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


$sql = "SELECT * FROM items ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Inventory Management System</h2>

        <div class="card mb-4">
            <div class="card-header bg-primary text-white">Add / Edit Item</div>
            <div class="card-body">
                <form action="" method="POST">
                    <input type="hidden" name="item_id" id="item_id"> 
                    <div class="mb-3">
                        <label for="name" class="form-label">Item Name</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" name="quantity" id="quantity" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" step="0.01" class="form-control" name="price" id="price" required>
                    </div>
                    <button type="submit" class="btn btn-success">Save Item</button>
                </form>
            </div>
        </div>

        <!-- Inventory List -->
        <div class="card">
            <div class="card-header bg-dark text-white">Inventory List</div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Added On</th>
                            <th>Actions</th> <!-- New column for actions -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>{$row['id']}</td>
                                        <td>{$row['name']}</td>
                                        <td>{$row['quantity']}</td>
                                        <td>{$row['price']}</td>
                                        <td>{$row['created_at']}</td>
                                        <td>
                                            <button class='btn btn-warning btn-sm' onclick='editItem({$row['id']}, \"{$row['name']}\", {$row['quantity']}, {$row['price']})'>Edit</button>
                                            <a href='delete.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this item?\")'>Delete</a>
                                        </td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center'>No items found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function editItem(id, name, quantity, price) {
            document.getElementById("item_id").value = id;
            document.getElementById("name").value = name;
            document.getElementById("quantity").value = quantity;
            document.getElementById("price").value = price;
        }
    </script>
</body>
</html>
