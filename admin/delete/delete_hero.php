<?php
session_start();
include '../../db.php'; // เชื่อมต่อฐานข้อมูล

if (isset($_GET['id']) && !empty($_GET['id'])) {
    try {
        $id_hero = $_GET['id'];

        // ดึงข้อมูลวิดีโอจากฐานข้อมูล
        $stmt = $pdo->prepare("SELECT * FROM hero WHERE id_hero = :id_hero");
        $stmt->bindParam(':id_hero', $id_hero, PDO::PARAM_INT);
        $stmt->execute();
        $hero = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$hero) {
            throw new Exception('ไม่พบข้อมูลที่ต้องการลบ');
        }

        // ลบวิดีโอหากมี
        $uploadFolder = '../../vdo/';
        if (!empty($hero['vdo_hero']) && file_exists($uploadFolder . $hero['vdo_hero'])) {
            unlink($uploadFolder . $hero['vdo_hero']);
        }

        // ลบข้อมูลวิดีโอจากฐานข้อมูล
        $stmt = $pdo->prepare("DELETE FROM hero WHERE id_hero = :id_hero");
        $stmt->bindParam(':id_hero', $id_hero, PDO::PARAM_INT);

        if (!$stmt->execute()) {
            throw new Exception('การลบข้อมูลล้มเหลว');
        }

        // ตั้งค่าข้อความสำเร็จ
        $_SESSION['success'] = 'ลบข้อมูลสำเร็จ!';
        header('Location: ../page_hero.php');
        exit();
    } catch (Exception $e) {
        // ตั้งค่าข้อความผิดพลาด
        $_SESSION['error'] = 'เกิดข้อผิดพลาด: ' . $e->getMessage();
        header('Location: ../page_hero.php');
        exit();
    }
} else {
    $_SESSION['error'] = 'ไม่พบข้อมูลที่ต้องการลบ';
    header('Location: ../page_hero.php');
    exit();
}
?>
