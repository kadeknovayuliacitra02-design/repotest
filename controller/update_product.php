<?php
include("../config/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $name = $_POST["product_name"];
    $price = $_POST["price"];
    $stock = $_POST["stock"];
    $category_id = $_POST["category_id"];

    try {
        $stmt = $conn->prepare("UPDATE products 
            SET product_name = :product_name, 
                price = :price, 
                stock = :stock, 
                category_id = :category_id
            WHERE id = :id");

        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":product_name", $name);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":stock", $stock);
        $stmt->bindParam(":category_id", $category_id);
        $stmt->execute();
        echo "Product updated successfully!";
            
    } catch (PDOException $e) {
        echo "Error updating product: " . $e->getMessage();
    }
}
$conn = null;
?>
