<?php
include("../config/db.php");

$id = $_GET["id"] ?? null;
$product = [];
$categories = [];

if ($id) {
    try {
        $stmt = $conn->prepare(query: "SELECT * FROM products WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        
        $catStmt = $conn->query("SELECT * FROM categories");
        $categories = $catStmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
$conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
</head>
<body>
    <h2>Update Product</h2>
    <a href="list_product.php">← Back to Product List</a>
    <br><br>

    <?php if (!empty($product)): ?>
        <form action="../controller/update_product.php" method="post">
            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

            <label for="product_name">Product Name:</label><br>
            <input type="text" name="product_name" value="<?php echo $product['product_name']; ?>" required><br><br>

            <label for="price">Price:</label><br>
            <input type="number" name="price" value="<?php echo $product['price']; ?>" required><br><br>

            <label for="stock">Stock:</label><br>
            <input type="number" name="stock" value="<?php echo $product['stock']; ?>" required><br><br>

            <label for="category_id">Category:</label><br>
            <select name="category_id" required>
                <option value="">-- Select Category --</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?php echo $cat['id']; ?>" 
                        <?php echo ($cat['id'] == $product['category_id']) ? 'selected' : ''; ?>>
                        <?php echo $cat['category_name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br><br>

            <input type="submit" value="Update Product">
        </form>
    <?php else: ?>
        <p>Product not found.</p>
    <?php endif; ?>
</body>
</html>
