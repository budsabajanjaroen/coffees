<?php
session_start();
include '../../db.php'; // ไฟล์สำหรับเชื่อมต่อฐานข้อมูล

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $id_about = $_POST['id_about']; // รับ ID ของ about จากฟอร์ม

        // ดึงข้อมูลปัจจุบันจากฐานข้อมูล
        $stmt = $pdo->prepare("SELECT * FROM about WHERE id_about = :id_about");
        $stmt->bindParam(':id_about', $id_about, PDO::PARAM_INT);
        $stmt->execute();
        $about = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$about) {
            throw new Exception('ไม่พบข้อมูลสำหรับ ID ที่ระบุ');
        }

        $uploadFolder = '../../img/about/';
        $img1 = $about['img1_about']; // ใช้รูปเดิมถ้าไม่มีการอัปโหลดใหม่
        $img2 = $about['img2_about']; // ใช้รูปเดิมถ้าไม่มีการอัปโหลดใหม่

        // จัดการการอัปโหลดไฟล์ image1
        if (isset($_FILES['image1']) && $_FILES['image1']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath1 = $_FILES['image1']['tmp_name'];
            $fileName1 = uniqid('img1_', true) . '.' . pathinfo($_FILES['image1']['name'], PATHINFO_EXTENSION);
            $destination1 = $uploadFolder . $fileName1;

            // ลบรูปเดิมถ้ามี
            if (!empty($img1) && file_exists($uploadFolder . $img1)) {
                unlink($uploadFolder . $img1);
            }

            // ย้ายไฟล์ใหม่
            if (!move_uploaded_file($fileTmpPath1, $destination1)) {
                throw new Exception('การย้ายไฟล์ image1 ล้มเหลว');
            }

            $img1 = $fileName1;
        } else {
            echo "image1 ไม่ถูกอัปโหลดหรือมีข้อผิดพลาด: " . ($_FILES['image1']['error'] ?? 'ไม่มีข้อมูล');
        }

        // จัดการการอัปโหลดไฟล์ image2
        if (isset($_FILES['image2']) && $_FILES['image2']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath2 = $_FILES['image2']['tmp_name'];
            $fileName2 = uniqid('img2_', true) . '.' . pathinfo($_FILES['image2']['name'], PATHINFO_EXTENSION);
            $destination2 = $uploadFolder . $fileName2;

            // ลบรูปเดิมถ้ามี
            if (!empty($img2) && file_exists($uploadFolder . $img2)) {
                unlink($uploadFolder . $img2);
            }

            // ย้ายไฟล์ใหม่
            if (!move_uploaded_file($fileTmpPath2, $destination2)) {
                throw new Exception('การย้ายไฟล์ image2 ล้มเหลว');
            }

            $img2 = $fileName2;
        } else {
            echo "image2 ไม่ถูกอัปโหลดหรือมีข้อผิดพลาด: " . ($_FILES['image2']['error'] ?? 'ไม่มีข้อมูล');
        }

        // อัปเดตข้อมูลในฐานข้อมูล
        $sql = "UPDATE about SET name_about = :name_about, detail_about = :detail_about, img1_about = :img1_about, img2_about = :img2_about WHERE id_about = :id_about";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name_about', $_POST['name_about'], PDO::PARAM_STR);
        $stmt->bindParam(':detail_about', $_POST['detail_about'], PDO::PARAM_STR);
        $stmt->bindParam(':img1_about', $img1, PDO::PARAM_STR);
        $stmt->bindParam(':img2_about', $img2, PDO::PARAM_STR);
        $stmt->bindParam(':id_about', $id_about, PDO::PARAM_INT);

        if (!$stmt->execute()) {
            throw new Exception('การอัปเดตฐานข้อมูลล้มเหลว');
        }

        $_SESSION['success'] = 'อัปเดตข้อมูลสำเร็จ!';
        header('Location: ../page_about.php');
        exit();
    } catch (Exception $e) {
        $_SESSION['error'] = 'เกิดข้อผิดพลาด: ' . $e->getMessage();
        header('Location: ../page_about.php');
        exit();
    }
} else {
    $_SESSION['error'] = 'วิธีการส่งข้อมูลไม่ถูกต้อง';
    header('Location: ../page_about.php');
    exit();
}
?>
