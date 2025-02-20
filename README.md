# 📦 Inventory Management System

A simple **Inventory Management System** built using **PHP & MySQL** with CRUD functionality (Create, Read, Update, Delete).  
This system allows users to **add, edit, delete, and view inventory items** efficiently.

---

## 🚀 Features

✅ Add new items to the inventory  
✅ Edit existing items  
✅ Delete items from the inventory  
✅ View all items in a structured table  
✅ Bootstrap-styled UI for better design  

---

## 🛠️ Installation

### 1️⃣ Clone the Repository

```sh
git clone https://github.com/your-username/inventory-management.git
cd inventory-management


2️⃣ Setup Database
Select the database:
sql
Copy
Edit
USE inventory_db;
Create the items table:
sql
Copy
Edit

CREATE TABLE items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


3️⃣ Configure Database Connection
Open inventory.php and delete.php
Make sure your database credentials match:
php
Copy
Edit

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'inventory_db';


▶️ Usage
Adding an Item
Fill in the Item Name, Quantity, and Price in the form.
Click "Add Item" to save it to the database.
Editing an Item
Click the "Edit" button next to an item in the table.
The form will populate with the item's data.
Modify the details and click "Save Item".
Deleting an Item
Click the "Delete" button next to an item.
A confirmation message will appear.
Click "OK" to permanently remove the item.
