<?php
session_start();

// check if inventory array already exist
if (!isset($_SESSION['inventory'])) {
    $_SESSION['inventory'] = [];
}

$system_message = "";
$search_result = "";

// Add item to inventory
if (isset($_POST['add_item'])) {
    $item_name = trim($_POST['item_name']);
    $quantity = intval($_POST['quantity']);

    // Validation rules
    if ($item_name == "") {
        $system_message = "Item name cannot be blank.";
    } elseif (array_key_exists($item_name, $_SESSION['inventory'])) {
        $system_message = "Item already exists in the inventory.";
    } elseif ($quantity <= 0) {
        $system_message = "Quantity must be greater than zero.";
    } else {
        // Add to inventory
        $_SESSION['inventory'][$item_name] = $quantity;
        $system_message = '<p style="color:green">Item added successfully.</p>';
    }
}

// Search item in inventory
if (isset($_POST['search_item'])) {
    $search_name = trim($_POST['search_name']);
    if (array_key_exists($search_name, $_SESSION['inventory'])) {
        $search_result = ("Item: " . $search_name . " <br> Quantity: " . $_SESSION['inventory'][$search_name]);
    } else {
        $search_result = "Product not found.";
    }
}

if (isset($_POST['search_item'])) {
    $search_name = trim($_POST['search_name']);
    if (array_key_exists($search_name, $_SESSION['inventory'])) {
        $search_result = ("Item: " . $search_name . " <br> Quantity: " . $_SESSION['inventory'][$search_name]);
    } else {
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Inventory Management System</title>
</head>

<body>
    <h1>Inventory Management System</h1>

    <!-- Add Item Form -->
    <h2>Add New Item</h2>
    <form method="POST">
        <label for="item_name">Item Name:</label>
        <input type="text" name="item_name" id="item_name" required>
        <br><br>
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" required>
        <br><br>
        <button type="submit" name="add_item">Add Item</button>
    </form>

    <p><?php echo $system_message; ?></p>

    <!-- Search Item Form -->
    <h2>Search the Inventory</h2>
    <form method="POST">
        <label for="search_name">Item Name:</label>
        <input type="text" name="search_name" id="search_name" required>
        <br><br>
        <button type="submit" name="search_item">Search</button>
    </form>

    <!-- Inventory Dashboard -->
    <h2>Inventory Dashboard</h2>
    <?php if (!empty($_SESSION['inventory'])): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['inventory'] as $item_name => $quantity): ?>
                    <tr>
                        <td><?php echo $item_name; ?></td>
                        <td><?php echo $quantity; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p style="color:red">No items in inventory.</p>
    <?php endif; ?>

    <p><?php echo "<h2>Search Result</h2>" . $search_result; ?></p>

</body>

</html>