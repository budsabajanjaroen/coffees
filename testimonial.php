
<?php

// ดึงข้อมูลจากฐานข้อมูล
$query = "SELECT * FROM review";
$stmt = $pdo->query($query); // ใช้ตัวแปร $query ที่กำหนดไว้ด้านบน
$reviews = $stmt->fetchAll(PDO::FETCH_ASSOC); // เก็บข้อมูลทั้งหมดในรูปแบบ array
?>
<div class="container-xxl bg-light my-6 py-6 pb-0" id="Testimonial">
        
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="text-primary text-uppercase mb-2">Review</p>
                <h1 class="display-6 mb-4">รีวิวจากผู้ดื่มจริง</h1>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                <?php for ($i = 0; $i < 2; $i++): ?>
                <?php foreach ($reviews as $review): ?>
                <div class="testimonial-item bg-white rounded p-4">
                    <div class="d-flex align-items-center mb-4">
                        <img class="flex-shrink-0 rounded-circle border p-1" src="/coffees/img/review/<?= htmlspecialchars($review['img_review']); ?>" alt="">
                        <div class="ms-4">
                            <h5 class="mb-1"><?= htmlspecialchars($review['name_review']); ?></h5>
                            <span><?= htmlspecialchars($review['position_review']); ?></span>
                        </div>
                    </div>
                    <p class="mb-0"><?= htmlspecialchars($review['review']); ?></p>
                </div>
            <?php endforeach; ?>
            <?php endfor; ?>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
