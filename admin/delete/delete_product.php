<?php
session_start();
include '../../db.php'; // Include your database connection file

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    try {
        // Fetch product images
        $stmt = $pdo->prepare("SELECT img1_product, img2_product, img3_product, img4_product, img5_product FROM product WHERE id_product = ?");
        $stmt->execute([$product_id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($product) {
            // Delete images from the server
            $images = ['img1_product', 'img2_product', 'img3_product', 'img4_product', 'img5_product'];
            foreach ($images as $image) {
                if (!empty($product[$image])) {
                    unlink("../../img/product/" . $product[$image]);
                }
            }

            // Delete product ingredients
            $stmt = $pdo->prepare("DELETE FROM product_ingredients WHERE id_product = ?");
            $stmt->execute([$product_id]);

            // Delete product
            $stmt = $pdo->prepare("DELETE FROM product WHERE id_product = ?");
            $stmt->execute([$product_id]);

            $_SESSION['success'] = "Product deleted successfully!";
        } else {
            $_SESSION['error'] = "Product not found.";
        }
    } catch (Exception $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
    }

    header("Location: ../page_product.php");
    exit();
} else {
    $_SESSION['error'] = "Invalid request.";
    header("Location: ../page_product.php");
    exit();
}
?>
