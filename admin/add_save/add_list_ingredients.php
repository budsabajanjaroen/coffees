<?php
session_start();
include '../../db.php'; // เชื่อมต่อฐานข้อมูล

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // ตรวจสอบการอัปโหลดรูปภาพ
        if (isset($_FILES['img_ingredients']) && $_FILES['img_ingredients']['error'] === UPLOAD_ERR_OK) {
            $uploadFolder = '../../img/ingredients/'; // โฟลเดอร์เก็บรูปภาพ

            // สร้างชื่อไฟล์ใหม่แบบไม่ซ้ำ
            $fileTmpPath = $_FILES['img_ingredients']['tmp_name'];
            $fileName = uniqid('ingredients_', true) . '.' . pathinfo($_FILES['img_ingredients']['name'], PATHINFO_EXTENSION);
            $destination = $uploadFolder . $fileName;

            // ย้ายไฟล์ไปยังโฟลเดอร์ที่กำหนด
            if (!move_uploaded_file($fileTmpPath, $destination)) {
                throw new Exception('การย้ายไฟล์รูปภาพล้มเหลว');
            }

            // รับข้อมูลจากฟอร์ม
            $nameIngredients = $_POST['name_ingredients'];
            $detailIngredients = $_POST['detail_ingredients'];

            // เพิ่มข้อมูลลงในฐานข้อมูล
            $stmt = $pdo->prepare("
                INSERT INTO ingredients (img_ingredients, name_ingredients, detail_ingredients)
                VALUES (:img_ingredients, :name_ingredients, :detail_ingredients)
            ");
            $stmt->bindParam(':img_ingredients', $fileName, PDO::PARAM_STR);
            $stmt->bindParam(':name_ingredients', $nameIngredients, PDO::PARAM_STR);
            $stmt->bindParam(':detail_ingredients', $detailIngredients, PDO::PARAM_STR);

            if (!$stmt->execute()) {
                throw new Exception('การเพิ่มข้อมูลลงในฐานข้อมูลล้มเหลว');
            }

            // ตั้งค่าข้อความสำเร็จ
            $_SESSION['success'] = 'เพิ่มข้อมูลสำเร็จ!';
            header('Location: ../page_ingredients.php');
            exit();
        } else {
            throw new Exception('กรุณาอัปโหลดรูปภาพ');
        }
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
