<?php
include("../config/db.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    try {
        $check = $conn->prepare("SELECT COUNT(*) FROM products WHERE category_id = :id");
        $check->bindParam(":id", $id);
        $check->execute();
        $count = $check->fetchColumn();

        if ($count > 0) {
            echo'Tidak bisa menghapus kategori ini karena masih ada produk yang terkait.';   
            exit;
        }

        
        $stmt = $conn->prepare("DELETE FROM categories WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        echo "<script>
            alert('Kategori berhasil dihapus.');
            window.location.href = '../view/list_category.php';
        </script>";

    } catch (PDOException $e) {
        echo "Error deleting category: " . $e->getMessage();
    }
}
$conn = null;
?>
