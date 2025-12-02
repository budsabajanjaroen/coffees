<?php
session_start();
include '../../db.php'; // เชื่อมต่อฐานข้อมูล

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // รับค่าจากฟอร์ม
        $id_ingredients = $_POST['id_ingredients'];
        $nameIngredients = $_POST['name_ingredients'];
        $detailIngredients = $_POST['detail_ingredients'];

        // ตรวจสอบว่ามี `id_ingredients`
        if (empty($id_ingredients)) {
            throw new Exception('ไม่พบข้อมูลที่ต้องการแก้ไข');
        }

        // ดึงข้อมูลส่วนประกอบปัจจุบันจากฐานข้อมูล
        $stmt = $pdo->prepare("SELECT * FROM ingredients WHERE id_ingredients = :id_ingredients");
        $stmt->bindParam(':id_ingredients', $id_ingredients, PDO::PARAM_INT);
        $stmt->execute();
        $ingredients = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$ingredients) {
            throw new Exception('ไม่พบข้อมูลที่ต้องการแก้ไข');
        }

        $uploadFolder = '../../img/ingredients/';
        $imgIngredients = $ingredients['img_ingredients']; // ใช้รูปเดิมหากไม่มีการอัปโหลดใหม่

        // จัดการการอัปโหลดรูปภาพ
        if (isset($_FILES['img_ingredients']) && $_FILES['img_ingredients']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['img_ingredients']['tmp_name'];
            $fileName = uniqid('ingredients_', true) . '.' . pathinfo($_FILES['img_ingredients']['name'], PATHINFO_EXTENSION);
            $destination = $uploadFolder . $fileName;

            // ลบรูปภาพเก่าหากมี
            if (!empty($imgIngredients) && file_exists($uploadFolder . $imgIngredients)) {
                unlink($uploadFolder . $imgIngredients);
            }

            // ย้ายไฟล์ใหม่
            if (!move_uploaded_file($fileTmpPath, $destination)) {
                throw new Exception('การย้ายไฟล์รูปภาพล้มเหลว');
            }

            $imgIngredients = $fileName;
        }

        // อัปเดตข้อมูลในฐานข้อมูล
        $stmt = $pdo->prepare("
            UPDATE ingredients 
            SET img_ingredients = :img_ingredients, 
                name_ingredients = :name_ingredients, 
                detail_ingredients = :detail_ingredients
            WHERE id_ingredients = :id_ingredients
        ");
        $stmt->bindParam(':img_ingredients', $imgIngredients, PDO::PARAM_STR);
        $stmt->bindParam(':name_ingredients', $nameIngredients, PDO::PARAM_STR);
        $stmt->bindParam(':detail_ingredients', $detailIngredients, PDO::PARAM_STR);
        $stmt->bindParam(':id_ingredients', $id_ingredients, PDO::PARAM_INT);

        if (!$stmt->execute()) {
            throw new Exception('การอัปเดตข้อมูลล้มเหลว');
        }

        // ตั้งค่าข้อความสำเร็จ
        $_SESSION['success'] = 'แก้ไขข้อมูลสำเร็จ!';
        header('Location: ../page_ingredients.php');
        exit();
    } catch (Exception $e) {
        // ตั้งค่าข้อความผิดพลาด
        $_SESSION['error'] = 'เกิดข้อผิดพลาด: ' . $e->getMessage();
        header('Location: ../page_ingredients.php');
        exit();
    }
} else {
    $_SESSION['error'] = 'วิธีการส่งข้อมูลไม่ถูกต้อง';
    header('Location: ../page_ingredients.php');
    exit();
}
?>
