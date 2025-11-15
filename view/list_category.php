<?php
include("../config/db.php");

$sql = "SELECT * FROM categories";
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
    <title>List Categories</title>
    <style>
        table {
            border-collapse: collapse;
            width: 60%;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 8px;
            text-align: left;
        }
        th { background: #f2f2f2; }
        a { text-decoration: none; color: blue; }
    </style>
</head>
<body>
    <h2>List of Categories</h2>
    <br><br>

    <table>
        <tr>
            <th>ID</th>
            <th>Category Name</th>
            <th>Action</th>
        </tr>
        <?php if (count($categories) > 0): ?>
            <?php foreach ($categories as $category): ?>
                <tr>
                    <td><?php echo $category["id"] ?></td>
                    <td><?php echo $category["category_name"] ?></td>
                    <td>
                        <a href="update_category.php?id=<?php echo $category["id"] ?>">Edit</a>
                        <a href="../controller/delete_category.php?id=<?= $category['id'] ?>" 
       onclick="return confirm('Are you sure you want to delete this category?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td>No categories found</td></tr>
        <?php endif; ?>
    </table>
</body>
</html>
