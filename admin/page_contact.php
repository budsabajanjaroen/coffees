<?php include "head.php"; ?>

<?php

// ดึงข้อมูลจากฐานข้อมูลตาม ID
$stmt = $pdo->prepare("SELECT * FROM contact WHERE id_contact = 1");
$stmt->execute();
$contact = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT* FROM product");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<style>
    .fadeIn {
        background-color: #1E1916 !important;
    }

    .text-light {
        /* color: #000 !important; */
    }
</style>

<body id="page-top">
    <div id="wrapper">
        <?php include 'navbar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include 'nav.php'; ?>
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">ช่องทางการติดต่อ</h1>
                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger">
                            <?php echo $_SESSION['error'];
                            unset($_SESSION['error']); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success">
                            <?php echo $_SESSION['success'];
                            unset($_SESSION['success']); ?>
                        </div>
                    <?php endif; ?>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="ระยะหาง">
                                <div class="header-text">
                                    <h6 class="m-0 font-weight-bold text-primary">ตัวอย่างหน้า ช่องทางการติดต่อ</h6>
                                </div>

                                <div class="i-con-scroll">
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                        </div>
                        <!-- Footer Start -->
                        <div class="sleep1">
                            <div class=" container-fluid text-light footer my-6 mb-0 py-5 wow fadeIn" data-wow-delay="0.1s" id="con">
                                <div class="container  py-5">
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
                                            <?php foreach ($products as $product) : ?>
                                                <a class="text-light " href="../productdetails.php?id=<?php echo $product['id_product']; ?>"><?php echo $product['name_product']; ?></a><br><br>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <h4 class="text-light mb-4">Quick Links</h4>
                                            <a class="btn btn-link" href="../index.php">หน้าแรก</a>
                                            <a class="btn btn-link" href="../index.php#about">เกี่ยวกับเรา</a>
                                            <a class="btn btn-link" href="../index.php#Product">ผลิตภัณฑ์</a>
                                            <a class="btn btn-link" href="../index.php#Testimonial">รีวิว</a>
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
                                </div>
                            </div>
                        </div>
                        <!-- Footer End -->

                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="ระยะหาง">
                                <div class="header-text">
                                    <h6 class="m-0 font-weight-bold text-primary">แก้ไขข้อมูล ช่องทางการติดต่อ</h6>
                                </div>

                                <div class="i-con-scroll">
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                        </div>
                        <div class="sleep2">
                        <div class="card-body ">
                            <form method="POST" action="edit_save/contact.php" data-parsley-validate class="form-horizontal form-label-left">
                                <input type="hidden" name="id_contact" value="<?php echo htmlspecialchars($contact['id_contact']); ?>">
                                <div class="row">
                                    <div class="col col-sm-6">
                                        <div class="form-group">
                                            <label for="address_th_contact">ที่อยู่ </label>
                                            <textarea class="form-control" id="address_th_contact" name="address_th_contact"><?php echo htmlspecialchars($contact['address_th_contact']); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col col-sm-6">
                                        <div class="form-group">
                                            <label for="email_contact">อีเมล</label>
                                            <input type="email" class="form-control" id="email_contact" name="email_contact" value="<?php echo htmlspecialchars($contact['email_contact']); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col col-sm-6">
                                        <div class="form-group">
                                            <label for="phone_contact">โทรศัพท์</label>
                                            <input type="text" class="form-control" id="phone_contact" name="phone_contact" value="<?php echo htmlspecialchars($contact['phone_contact']); ?>">
                                        </div>
                                    </div>
                                    <div class="col col-sm-6">
                                        <div class="form-group">
                                            <label for="line_contact">LINE</label>
                                            <input type="text" class="form-control" id="line_contact" name="line_contact" value="<?php echo htmlspecialchars($contact['line_contact']); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col col-sm-6">
                                        <div class="form-group">
                                            <label for="facebook_contact">Facebook</label>
                                            <input type="text" class="form-control" id="facebook_contact" name="facebook_contact" value="<?php echo htmlspecialchars($contact['facebook_contact']); ?>">
                                        </div>
                                    </div>
                                    <div class="col col-sm-6">
                                        <div class="form-group">
                                            <label for="youtube_contact">YouTube</label>
                                            <input type="text" class="form-control" id="youtube_contact" name="youtube_contact" value="<?php echo htmlspecialchars($contact['youtube_contact']); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col ระยะหาง form-group">
                                        <button type="button" class="btn btn-secondary mt-3" onclick="window.history.back();">ย้อนกลับ</button>
                                        <button type="submit" class="btn btn-primary mt-3">บันทึก</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <?php include 'footer.php'; ?>
        </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>