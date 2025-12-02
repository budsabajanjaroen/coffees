<?php
session_start();
include '../../db.php'; // ไฟล์สำหรับเชื่อมต่อฐานข้อมูล

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_contact = $_POST['id_contact'];
    $address_th_contact = $_POST['address_th_contact'];
    $email_contact = $_POST['email_contact'];
    $phone_contact = $_POST['phone_contact'];
    $line_contact = $_POST['line_contact'];
    $facebook_contact = $_POST['facebook_contact'];
    $youtube_contact = $_POST['youtube_contact'];
    try {
        // อัปเดตข้อมูลในฐานข้อมูล
        $sql = "UPDATE contact SET 
                    address_th_contact = :address_th_contact,
                    email_contact = :email_contact,
                    phone_contact = :phone_contact,
                    line_contact = :line_contact,
                    facebook_contact = :facebook_contact,
                    youtube_contact = :youtube_contact
                WHERE id_contact = :id_contact";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':address_th_contact', $address_th_contact, PDO::PARAM_STR);
        $stmt->bindParam(':email_contact', $email_contact, PDO::PARAM_STR);
        $stmt->bindParam(':phone_contact', $phone_contact, PDO::PARAM_STR);
        $stmt->bindParam(':line_contact', $line_contact, PDO::PARAM_STR);
        $stmt->bindParam(':facebook_contact', $facebook_contact, PDO::PARAM_STR);
        $stmt->bindParam(':youtube_contact', $youtube_contact, PDO::PARAM_STR);
        $stmt->bindParam(':id_contact', $id_contact, PDO::PARAM_INT);
        $stmt->execute();

        $_SESSION['success'] = 'อัปเดตข้อมูลการติดต่อสำเร็จ!';
        header('Location: ../page_contact.php');
        exit();
    } catch (PDOException $e) {
        $_SESSION['error'] = 'เกิดข้อผิดพลาดในการอัปเดตข้อมูล: ' . $e->getMessage();
        header('Location: ../page_contact.php');
        exit();
    }
} else {
    $_SESSION['error'] = 'วิธีการส่งข้อมูลไม่ถูกต้อง';
    header('Location: ../page_contact.php');
    exit();
}
?>