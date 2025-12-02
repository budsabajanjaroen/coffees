<?php
session_start();
include '../../db.php'; // เชื่อมต่อฐานข้อมูล

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $id_review = $_POST['id_review'];

        // ตรวจสอบว่า id_review มีค่า
        if (empty($id_review)) {
            throw new Exception('ไม่พบข้อมูลที่ต้องการแก้ไข');
        }

        // ดึงข้อมูลรีวิวปัจจุบันจากฐานข้อมูล
        $stmt = $pdo->prepare("SELECT * FROM review WHERE id_review = :id_review");
        $stmt->bindParam(':id_review', $id_review, PDO::PARAM_INT);
        $stmt->execute();
        $review = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$review) {
            throw new Exception('ไม่พบข้อมูลที่ต้องการแก้ไข');
        }

        $uploadFolder = '../../img/review/';
        $imgReview = $review['img_review']; // ใช้รูปเดิมหากไม่มีการอัปโหลดใหม่

        // จัดการการอัปโหลดรูปภาพ
        if (isset($_FILES['img_review']) && $_FILES['img_review']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['img_review']['tmp_name'];
            $fileName = uniqid('review_', true) . '.' . pathinfo($_FILES['img_review']['name'], PATHINFO_EXTENSION);
            $destination = $uploadFolder . $fileName;

            // ลบไฟล์เก่าหากมี
            if (!empty($imgReview) && file_exists($uploadFolder . $imgReview)) {
                unlink($uploadFolder . $imgReview);
            }

            // ย้ายไฟล์ใหม่
            if (!move_uploaded_file($fileTmpPath, $destination)) {
                throw new Exception('การย้ายไฟล์รูปภาพล้มเหลว');
            }

            $imgReview = $fileName;
        }

        // เตรียมข้อมูลสำหรับอัปเดตในฐานข้อมูล
        $nameReview = $_POST['name_review'];
        $positionReview = $_POST['position_review'];
        $reviewText = $_POST['review'];

        $stmt = $pdo->prepare("
            UPDATE review 
            SET img_review = :img_review, 
                name_review = :name_review, 
                position_review = :position_review, 
                review = :review 
            WHERE id_review = :id_review
        ");
        $stmt->bindParam(':img_review', $imgReview, PDO::PARAM_STR);
        $stmt->bindParam(':name_review', $nameReview, PDO::PARAM_STR);
        $stmt->bindParam(':position_review', $positionReview, PDO::PARAM_STR);
        $stmt->bindParam(':review', $reviewText, PDO::PARAM_STR);
        $stmt->bindParam(':id_review', $id_review, PDO::PARAM_INT);

        if (!$stmt->execute()) {
            throw new Exception('การอัปเดตข้อมูลล้มเหลว');
        }

        // ตั้งค่าข้อความสำเร็จ
        $_SESSION['success'] = 'แก้ไขข้อมูลสำเร็จ!';
        header('Location: ../page_review.php');
        exit();
    } catch (Exception $e) {
        // ตั้งค่าข้อความผิดพลาด
        $_SESSION['error'] = 'เกิดข้อผิดพลาด: ' . $e->getMessage();
        header('Location: ../page_review.php');
        exit();
    }
} else {
    $_SESSION['error'] = 'วิธีการส่งข้อมูลไม่ถูกต้อง';
    header('Location: ../page_review.php');
    exit();
}
?>
