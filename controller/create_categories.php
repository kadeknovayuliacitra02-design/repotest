<?php
include("../config/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_name = $_POST["category_name"];

    $name = $conn->prepare("SELECT COUNT(*) FROM categories WHERE category_name = :category_name");
    $name->bindParam(":category_name", $category_name);
    $name->execute();
    $check = $name->fetchColumn();
    

    if ($check > 0) {
         echo "Tidak Boleh ada nama yang sama!";
         return;
    }

    try {
        $stmt = $conn->prepare("INSERT INTO categories (category_name) VALUES(:category_name)");
        $stmt->bindParam(':category_name' , $category_name);
        $stmt->execute();
        header("location:../view/list_category.php");
        exit();
    } catch (PDOException $e) {
        echo "error:". $e->getMessage();

    }
}
$conn = null;
?>