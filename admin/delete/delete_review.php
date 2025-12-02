<?php
session_start();
include '../../db.php'; // เชื่อมต่อฐานข้อมูล

if (isset($_GET['id']) && !empty($_GET['id'])) {
    try {
        $id_review = $_GET['id'];

        // ดึงข้อมูลรีวิวจากฐานข้อมูล
        $stmt = $pdo->prepare("SELECT * FROM review WHERE id_review = :id_review");
        $stmt->bindParam(':id_review', $id_review, PDO::PARAM_INT);
        $stmt->execute();
        $review = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$review) {
            throw new Exception('ไม่พบข้อมูลที่ต้องการลบ');
        }

        // ลบรูปภาพหากมี
        $uploadFolder = '../../img/review/';
        if (!empty($review['img_review']) && file_exists($uploadFolder . $review['img_review'])) {
            unlink($uploadFolder . $review['img_review']);
        }

        // ลบข้อมูลรีวิวจากฐานข้อมูล
        $stmt = $pdo->prepare("DELETE FROM review WHERE id_review = :id_review");
        $stmt->bindParam(':id_review', $id_review, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            throw new Exception('การลบข้อมูลล้มเหลว');
        }

        // ตั้งค่าข้อความสำเร็จ
        $_SESSION['success'] = 'ลบข้อมูลสำเร็จ!';
        header('Location: ../page_review.php');
        exit();
    } catch (Exception $e) {
        // ตั้งค่าข้อความผิดพลาด
        $_SESSION['error'] = 'เกิดข้อผิดพลาด: ' . $e->getMessage();
        header('Location: ../page_review.php');
        exit();
    }
} else {
    $_SESSION['error'] = 'ไม่พบข้อมูลที่ต้องการลบ';
    header('Location: ../page_review.php');
    exit();
}
?>
