<?php
include("../config/db.php");
$sql = "SELECT p.id, p.product_name, p.price, p.stock, c.category_name 
        FROM products p
        JOIN categories c ON p.category_id = c.id";
$result = $conn->query($sql);
$products = [];

if ($result->rowCount() > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $products[] = $row;
    }
}
$conn = null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>List Products</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>All Products</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Category</th>
            <th>Action</th>
        </tr>
        <?php if (count($products) > 0): ?>
            <?php $counter = 1 ?>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo $counter ?></td>
                    <td><?php echo $product["product_name"] ?></td>
                    <td><?php echo $product["price"] ?></td>
                    <td><?php echo $product["stock"] ?></td>
                    <td><?php echo $product['category_name'] ?></td>

                    <td>
                        <a href="update_product.php?id=<?= $product['id'] ?>">Edit</a>
                        <a href="../controller/delete_product.php?id=<?= $product['id'] ?>"
                            onclick="return confirm('Are you sure you want to delete this category?')">Delete</a>
                    </td>
                    </td>

                </tr>
                <?php $counter++; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</body>

</html>