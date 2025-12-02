<?php
session_start();
include '../../db.php'; // เชื่อมต่อฐานข้อมูล

if (isset($_GET['id']) && !empty($_GET['id'])) {
    try {
        $id_ingredients = $_GET['id'];

        // ดึงข้อมูลส่วนประกอบจากฐานข้อมูล
        $stmt = $pdo->prepare("SELECT * FROM ingredients WHERE id_ingredients = :id_ingredients");
        $stmt->bindParam(':id_ingredients', $id_ingredients, PDO::PARAM_INT);
        $stmt->execute();
        $ingredients = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$ingredients) {
            throw new Exception('ไม่พบข้อมูลที่ต้องการลบ');
        }

        // ลบรูปภาพหากมี
        $uploadFolder = '../../img/ingredients/';
        if (!empty($ingredients['img_ingredients']) && file_exists($uploadFolder . $ingredients['img_ingredients'])) {
            unlink($uploadFolder . $ingredients['img_ingredients']);
        }

        // ลบข้อมูลส่วนประกอบจากฐานข้อมูล
        $stmt = $pdo->prepare("DELETE FROM ingredients WHERE id_ingredients = :id_ingredients");
        $stmt->bindParam(':id_ingredients', $id_ingredients, PDO::PARAM_INT);

        if (!$stmt->execute()) {
            throw new Exception('การลบข้อมูลล้มเหลว');
        }

        // ตั้งค่าข้อความสำเร็จ
        $_SESSION['success'] = 'ลบข้อมูลสำเร็จ!';
        header('Location: ../page_ingredients.php');
        exit();
    } catch (Exception $e) {
        // ตั้งค่าข้อความผิดพลาด
        $_SESSION['error'] = 'เกิดข้อผิดพลาด: ' . $e->getMessage();
        header('Location: ../page_ingredients.php');
        exit();
    }
} else {
    $_SESSION['error'] = 'ไม่พบข้อมูลที่ต้องการลบ';
    header('Location: ../page_ingredients.php');
    exit();
}
?>
