 <!-- About Start -->
 <?php

// ดึงข้อมูลจากฐานข้อมูล
$stmt = $pdo->prepare("SELECT * FROM about WHERE id_about = 1");
$stmt->execute();
$about = $stmt->fetch(PDO::FETCH_ASSOC); // ดึงข้อมูลแถวเดียว

if (!$about) {
    $_SESSION['error'] = 'ไม่พบข้อมูลในฐานข้อมูล';
    header('Location: ../admin_hero.php');
    exit();
}
?>

 <div class="container-xxl" id="about">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="row img-twice position-relative h-100">
                        <div class="col-6">
                            <img class="img-fluid rounded" src="/coffees/img/about/<?= $about['img1_about'] ?>" alt="">
                        </div>
                        <div class="col-6 align-self-end">
                            <img class="img-fluid rounded" src="/coffees/img/about/<?= $about['img2_about'] ?>" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="h-100">
                        <p class="text-primary text-uppercase mb-2">เกี่ยวกับเรา</p>
                        <h1 class="display-6 mb-4"><?=$about['name_about'] ?></h1>
                        <?=$about['detail_about']; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->