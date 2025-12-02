<?php include 'head.php'; ?>
<?php

// ดึงข้อมูลจากฐานข้อมูล
$query = "SELECT * FROM hero";
$stmt = $pdo->query($query); // ใช้ตัวแปร $query ที่กำหนดไว้ด้านบน
$heros = $stmt->fetchAll(PDO::FETCH_ASSOC); // เก็บข้อมูลทั้งหมดในรูปแบบ array
?>

<body id="page-top">

    <div id="wrapper">
        <?php include 'navbar.php'; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include 'nav.php'; ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Show error or success messages -->
                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger">
                            <?php echo $_SESSION['error']; ?>
                            <?php unset($_SESSION['error']); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success">
                            <?php echo $_SESSION['success']; ?>
                            <?php unset($_SESSION['success']); ?>
                        </div>
                    <?php endif; ?>
                    <div class="container-fluid">
                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800">หน้าแรก</h1>
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <div class="ระยะหาง">
                                    <div class="header-text">
                                        <h6 class="m-0 font-weight-bold text-primary">ตัวอย่าง หน้าแรก</h6>
                                    </div>
                                    <div class="i-con-scroll">
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                </div>

                            </div>
                            <div class="sleep1">
                                <div class="card-body not-padding">
                                    <?php require 'preview/hero.php'; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800">หน้าแรก</h1>
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <div class="ระยะหาง">
                                    <div class="header-text">
                                        <h6 class="m-0 font-weight-bold text-primary">รายการ หน้าแรก</h6>
                                    </div>
                                    <div class="i-con-scroll">
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="sleep2">
                            <div class="card-body">
                                <div class="table-responsive">

                                    <div class="row">
                                        <!-- Table -->
                                        <div class="col-12 col-lg-8 order-1 order-lg-0">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>รูปภาพ</th>
                                                                <th>ลบ</th>
                                                            </tr>
                                                        </thead>
                                                        <tfoot>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>รูปภาพ</th>
                                                                <th>ลบ</th>
                                                            </tr>
                                                        </tfoot>
                                                        <tbody>
                                                            <?php foreach ($heros as $index => $hero): ?>
                                                                <tr>
                                                                    <td><?= $index + 1; ?></td>
                                                                    <td>
                                                                        <video width="200" controls>
                                                                            <source src="../vdo/<?= ($hero['vdo_hero']); ?>" type="video/mp4">
                                                                            Your browser does not support the video tag.
                                                                        </video>
                                                                    </td>
                                                                    <td>
                                                                        <a href="delete/delete_hero.php?id=<?= $hero['id_hero']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('คุณแน่ใจหรือว่าต้องการลบรายการนี้?');">
                                                                            <i class="fas fa-trash-alt"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>

                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Input Form -->
                                        <div class="col-12 col-lg-4 order-0 order-lg-1 mb-4">

                                            <div class="card-body">
                                                <h6 class="card-title">เพิ่ม รูปภาพ</h6>
                                                <form method="POST" enctype="multipart/form-data" action="add_save/add_list_hero.php">
                                                    <div class="form-group">
                                                        <label for="vdo">Upload VDO</label>
                                                        <input type="file" class="form-control" id="vdo" name="vdo" accept="video/*" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary mt-3">บันทึก</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div><?php include 'footer.php'; ?>
        </div>
    </div>

</body>

<script src="../lib/wow/wow.min.js"></script>
<script src="../lib/counterup/counterup.min.js"></script>
<script src="../lib/owlcarousel/owl.carousel.min.js"></script>
<!-- Template Javascript -->
<script src="../js/main.js"></script>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>

</html>