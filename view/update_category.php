<?php
include("../config/db.php");

$id = $_GET["id"] ?? null;
$row = [];

if ($id) {
    try {
        $stmt = $conn->prepare("SELECT * FROM categories WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        }
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
    <title>Update Category</title>
</head>
<body>
    <h2>Update Category</h2>
    <a href="list_category.php">Back to Category List</a>
    <br><br>

    <?php if (!empty($row)): ?>
        <form action="../controller/update_category.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
            
            <label for="category_name">Category Name:</label><br>
            <input type="text" name="category_name" value="<?php echo ($row['category_name']) ?>" required><br><br>
            
            <input type="submit" value="Update Category">
        </form>
    <?php else: ?>
        <p>Category not found.</p>
    <?php endif; ?>
</body>
</html>