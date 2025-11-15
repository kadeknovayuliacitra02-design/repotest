<?php 
include("../config/db.php");

$id = $_GET["id"];

try {
    $stmt = $conn->prepare("DELETE FROM products WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    header("Location: ../view/list_product.php");
    exit();

} catch (PDOException $e) {
    echo"error delete record:". $e->getMessage();

}
$conn = null;
?>