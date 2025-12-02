<!DOCTYPE html>
<?php
// อ่านค่าภาษา (ตามระบบใหม่)
$supported = ['th','en','lo','km'];
$lang = $_COOKIE['selectedLanguage'] ?? $_GET['lang'] ?? 'th';
if (!in_array($lang, $supported, true)) $lang = 'th';
?>
<?php include('head.php'); ?>
<?php include('db.php'); ?>
<body>
<?php


$stmt = $pdo->prepare("SELECT * FROM contact WHERE id_contact = 1");
$stmt->execute();
$contact = $stmt->fetch(PDO::FETCH_ASSOC);

$query = "SELECT * FROM product";
$stmt = $pdo->query($query); // ใช้ตัวแปร $query ที่กำหนดไว้ด้านบน
$products = $stmt->fetchAll(PDO::FETCH_ASSOC); // เก็บข้อมูลทั้งหมดในรูปแบบ array
// ✅ ดึงข้อมูลสินค้าทั้งหมด (ใช้ใน nav.php)

?>
    <?php include('spinner.php'); ?>
    <?php include('nav.php'); ?>
    <?php include('carousel.php'); ?>
    <?php include('about.php'); ?>
    <?php include('product.php'); ?>
    <?php include('team.php'); ?>
    <?php include('testimonial.php'); ?>
    <?php include('footer.php'); ?>
    <?php include('script.php'); ?>

</body>

</html>