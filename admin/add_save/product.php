<?php
session_start();
include '../../db.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // ตรวจสอบว่าเป็นการเพิ่มใหม่หรือแก้ไข
        $isUpdate = isset($_GET['id']) && !empty($_GET['id']);
        $product_id = $isUpdate ? $_GET['id'] : null;

        // ฟังก์ชันอัปโหลดไฟล์ (ลบไฟล์เก่าก่อน)
        function uploadFile($fileKey, $existingFile = null) {
            $uploadPath = "../../img/product/";
            
            if (!empty($_FILES[$fileKey]['name'])) {
                // ลบไฟล์เดิมหากมีการอัปโหลดใหม่
                if ($existingFile && file_exists($uploadPath . $existingFile)) {
                    unlink($uploadPath . $existingFile);
                }

                // อัปโหลดไฟล์ใหม่
                $fileName = uniqid() . '.' . pathinfo($_FILES[$fileKey]['name'], PATHINFO_EXTENSION);
                move_uploaded_file($_FILES[$fileKey]['tmp_name'], $uploadPath . $fileName);
                return $fileName;
            }
            return $existingFile; // ใช้ไฟล์เดิมถ้าไม่มีการอัปโหลดใหม่
        }

        // รับค่าจากฟอร์ม
        $name_product = trim($_POST['name_product']);
        $price_product = trim($_POST['price_product']); // เพิ่มการรับค่า price_product
        $detail1_product = trim($_POST['detail1_product']);
        $consumption_product = trim($_POST['consumption_product']);
        $keeping_product = trim($_POST['keeping_product']);
        $guard_product = trim($_POST['guard_product']);
        $com_product = json_encode($_POST['com_product'] ?? [], JSON_UNESCAPED_UNICODE);
        $amount_product = json_encode($_POST['amount_product'] ?? [], JSON_UNESCAPED_UNICODE);

        if ($isUpdate) {
            // ดึงข้อมูลสินค้าปัจจุบัน
            $stmt = $pdo->prepare("SELECT * FROM product WHERE id_product = ?");
            $stmt->execute([$product_id]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$product) {
                $_SESSION['error'] = "ไม่พบสินค้าที่ต้องการแก้ไข";
                header("Location: ../page_product.php");
                exit();
            }
        }

        // อัปโหลดไฟล์ใหม่ (ถ้ามี) และลบไฟล์เก่า
        $img1_product = uploadFile('img1_product', $isUpdate ? $product['img1_product'] : null);
        $img2_product = uploadFile('img2_product', $isUpdate ? $product['img2_product'] : null);
        $img3_product = uploadFile('img3_product', $isUpdate ? $product['img3_product'] : null);
        $img4_product = uploadFile('img4_product', $isUpdate ? $product['img4_product'] : null);
        $img5_product = uploadFile('img5_product', $isUpdate ? $product['img5_product'] : null);

        if ($isUpdate) {
            // อัปเดตข้อมูลสินค้า
            $stmt = $pdo->prepare("UPDATE product SET 
                name_product = ?, 
                price_product = ?, 
                img1_product = ?, img2_product = ?, img3_product = ?, img4_product = ?, img5_product = ?, 
                detail1_product = ?, consumption_product = ?, keeping_product = ?, guard_product = ?, 
                com_product = ?, amount_product = ?
                WHERE id_product = ?");

            $stmt->execute([
                $name_product, $price_product, $img1_product, $img2_product, $img3_product, $img4_product, $img5_product,
                $detail1_product, $consumption_product, $keeping_product, $guard_product,
                $com_product, $amount_product, $product_id
            ]);

            // ลบรายการวัตถุดิบเก่าก่อนเพิ่มใหม่
            $stmt = $pdo->prepare("DELETE FROM product_ingredients WHERE id_product = ?");
            $stmt->execute([$product_id]);
        } else {
            // เพิ่มสินค้าใหม่
            $stmt = $pdo->prepare("INSERT INTO product 
                (name_product, price_product, img1_product, img2_product, img3_product, img4_product, img5_product, 
                detail1_product, consumption_product, keeping_product, guard_product, com_product, amount_product) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt->execute([
                $name_product, $price_product, $img1_product, $img2_product, $img3_product, $img4_product, $img5_product,
                $detail1_product, $consumption_product, $keeping_product, $guard_product,
                $com_product, $amount_product
            ]);

            // ดึง ID ของสินค้าที่เพิ่มใหม่
            $product_id = $pdo->lastInsertId();
        }

        // เพิ่มรายการวัตถุดิบที่เกี่ยวข้อง
        if (!empty($_POST['ingredientss'])) {
            foreach ($_POST['ingredientss'] as $ingredients_id) {
                $stmt = $pdo->prepare("INSERT INTO product_ingredients (id_product, id_ingredients) VALUES (?, ?)");
                $stmt->execute([$product_id, $ingredients_id]);
            }
        }

        $_SESSION['success'] = $isUpdate ? "อัปเดตสินค้าสำเร็จ!" : "เพิ่มสินค้าสำเร็จ!";
    } catch (Exception $e) {
        $_SESSION['error'] = "เกิดข้อผิดพลาด: " . $e->getMessage();
    }

    header("Location: ../page_product.php");
    exit();
} else {
    $_SESSION['error'] = "Invalid request method.";
    header("Location: ../page_product.php");
    exit();
}
