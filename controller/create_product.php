<?php
include("../config/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST["product_name"];
    $price = $_POST["price"];
    $stock = $_POST["stock"];
    $categoryId = $_POST["category_id"];
    try {
        $stmt = $conn->prepare("INSERT INTO products (product_name, price, stock, category_id) VALUES(:product_name, :price, :stock, :category_id)");
        $stmt->bindParam(':product_name' , $productName);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':stock', $stock);
         $stmt->bindParam(':category_id', $categoryId);
        $stmt->execute();
        header("location:../view/list_product.php");
        exit();
    } catch (PDOException $e) {
        echo "error:". $e->getMessage();

    }
}
$conn = null;

?>