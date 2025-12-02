<?php
// ✅ ดึงข้อมูลติดต่อ

$stmt = $pdo->prepare("SELECT * FROM contact WHERE id_contact = 1");
$stmt->execute();
$contact = $stmt->fetch(PDO::FETCH_ASSOC);

// ✅ ดึงข้อมูลสินค้าทั้งหมด (ใช้ใน nav.php)
$sqlAllProducts = "SELECT id_product, name_product FROM product";
$stmtAllProducts = $pdo->query($sqlAllProducts);
$all_products = $stmtAllProducts->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="container-fluid bg-dark text-light footer my-6 mb-0 py-5 wow fadeIn" data-wow-delay="0.1s" id="con">
    <div class="container py-5">

        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <h4 class="text-light mb-4">Office Address</h4>
                <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>
                    <?php echo $contact['address_th_contact']; ?>
                </p>
                <p class="mb-2"><i class="fa fa-phone-alt me-3"></i><?= $contact['phone_contact'] ?> </p>
                <p class="mb-2"><i class="fa fa-envelope me-3"></i><?= $contact['email_contact'] ?> </p>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-light mb-4">ผลิตภัณฑ์</h4>
                <?php foreach ($all_products as $productItem): ?>
                    <a class="btn btn-link" href="/coffees/<?= $currentLang ?>/productdetails.php?id=<?= (int)$product['id_product'] ?>"><?= $productItem['name_product']; ?></a>
                <?php endforeach; ?>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-light mb-4">Quick Links</h4>
                <a class="btn btn-link" href="index.php">หน้าแรก</a>
                <a class="btn btn-link" href="index.php#about">เกี่ยวกับเรา</a>
                <a class="btn btn-link" href="index.php#Product">ผลิตภัณฑ์</a>
                <a class="btn btn-link" href="index.php#Testimonial">รีวิว</a>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-light mb-4">ช่องทางการติดต่อ</h4>
                <div class="row g-2">
                    <div class="col-4">
                        <a class="btn btn-square btn-outline-light rounded-circle me-1" href="<?= $contact['line_contact'] ?>"><i
                                class="fab fa-line"></i></a>
                    </div>
                    <div class="col-4">
                        <a class="btn btn-square btn-outline-light rounded-circle me-1" href="<?= $contact['facebook_contact'] ?> "><i
                                class="fab fa-facebook-f"></i></a>
                    </div>
                    <div class="col-4">
                        <a class="btn btn-square btn-outline-light rounded-circle me-1" href="<?= $contact['youtube_contact'] ?> "><i
                                class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Office Address</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Happy MPM สำนักงานใหญ่ 35/30 อาคารโนเบิลเฮ้าส์พญาไทถนนพญาไท แขวง ถนนพญาไท เขต ราชเทวี กรุงเทพมหานคร 10400</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>02-642-5425</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@happympm.com</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">ผลิตภัณฑ์</h4>
                    <a class="btn btn-link" href="productdetails.php">HAPPY COFFEE</a>
                    <a class="btn btn-link" href="productdetails.php">HAPPY COFFEE GOLD</a>
                    <a class="btn btn-link" href="productdetails.php">HAPPY COFFEE MAX</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Quick Links</h4>
                    <a class="btn btn-link" href="index.php">หน้าแรก</a>
                    <a class="btn btn-link" href="index.php#about">เกี่ยวกับเรา</a>
                    <a class="btn btn-link" href="index.php#Product">ผลิตภัณฑ์</a>
                    <a class="btn btn-link" href="index.php#Testimonial">รีวิว</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">ช่องทางการติดต่อ</h4>
                    <div class="row g-2">
                        <div class="col-4">
                            <a class="btn btn-square btn-outline-light rounded-circle me-1" href="https://lin.ee/yrVgDug"><i
                                class="fab fa-line"></i></a>
                        </div>
                        <div class="col-4">
                            <a class="btn btn-square btn-outline-light rounded-circle me-1" href="https://www.facebook.com/happympmofficial"><i
                                class="fab fa-facebook-f"></i></a>
                        </div>
                        <div class="col-4">
                            <a class="btn btn-square btn-outline-light rounded-circle me-1" href="https://youtu.be/VJV7RiHlb8E?si=puvyR4ky1gIofX_x"><i
                                class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div> -->
    </div>
</div>
<!-- Footer End -->