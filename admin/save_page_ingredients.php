<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../login.php");
    exit;
}

require("../db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // กำหนด id_page ที่เกี่ยวข้อง
        $idPage = 1; // กำหนดเป็น id ของหน้าเพจ (ในกรณีนี้คือ About Page)
        
        // รับค่า ingredientss ที่เลือกจากฟอร์ม
        $ingredientss = isset($_POST['ingredientss']) ? $_POST['ingredientss'] : [];

        // เริ่มการทำงานใน Transaction
        $pdo->beginTransaction();

        // ลบข้อมูลเก่าทั้งหมดสำหรับ id_page นี้
        $deleteSql = "DELETE FROM page_ingredients WHERE id_page = :id_page";
        $deleteStmt = $pdo->prepare($deleteSql);
        $deleteStmt->execute(['id_page' => $idPage]);

        // เพิ่มข้อมูลใหม่
        if (!empty($ingredientss)) {
            $insertSql = "INSERT INTO page_ingredients (id_page, id_ingredients) VALUES (:id_page, :id_ingredients)";
            $insertStmt = $pdo->prepare($insertSql);

            foreach ($ingredientss as $idingredients) {
                $insertStmt->execute([
                    'id_page' => $idPage,
                    'id_ingredients' => $idingredients
                ]);
            }
        }

        // Commit การเปลี่ยนแปลง
        $pdo->commit();

        // Redirect กลับไปที่หน้าฟอร์มพร้อมแสดงข้อความสำเร็จ
        header("Location: page_ingredients.php");
        exit;

    } catch (Exception $e) {
        // Rollback การเปลี่ยนแปลงหากเกิดข้อผิดพลาด
        $pdo->rollBack();

        // Redirect กลับไปที่หน้าฟอร์มพร้อมแสดงข้อความข้อผิดพลาด
        header("Location: page_ingredients.php?error=1&message=" . urlencode($e->getMessage()));
        exit;
    }
} else {
    // หากไม่ใช่ POST Request ให้ Redirect กลับไปที่หน้าเดิม
    header("Location: page_ingredients.php");
    exit;
}
