<?php

include("../config/db.php");

$sql = "SELECT * FROM categories;";
$result = $conn->query($sql);

$categories = [];

if ($result->rowCount() > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $categories[] = $row;
    }
}
$conn = null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create product</title>
</head>
<body>
    <h2>Create Product</h2>
    <br><br>
    <form action="../controller/create_product.php" method="post">
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" required><br>
        <label for="price" >Price:</label>
        <input type="text" name="price" required><br>
        <label for="stock">Stock:</label>
        <input type="text" name="stock" required><br>
        <label for="category_id">Category:</label><br>
        <select name="category_id" required>
        <option value="">Select Category</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo ($category['id']) ?>">
                    <?php echo ($category['category_name']) ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>
        <input type="submit" value="add product">
    </form>
</body>
</html>
</body>
</html>