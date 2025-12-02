<?php include 'head.php'; ?>
<?php
// ตรวจสอบว่ามีการส่ง ID มาใน URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['error'] = 'ไม่พบข้อมูลที่ต้องการแก้ไข';
    header('Location: ../page_review.php');
    exit();
}

$id_review = $_GET['id'];

// ดึงข้อมูลจากฐานข้อมูล
$query = "SELECT * FROM review WHERE id_review = :id_review";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id_review', $id_review, PDO::PARAM_INT);
$stmt->execute();
$review = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$review) {
    $_SESSION['error'] = 'ไม่พบข้อมูลที่ต้องการแก้ไข';
    header('Location: ../page_review.php');
    exit();
}
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
                        <h1 class="h3 mb-2 text-gray-800">ภาพโมเมนต์พิเศษ</h1>
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">แก้ไขรีวิว</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="card-body">
                                        <h6 class="card-title">เพิ่ม รูปภาพ</h6>
                                        <form method="POST" enctype="multipart/form-data" action="../edit_save/edit_review.php">
                                        <input type="hidden" name="id_review" value="<?php echo $review['id_review']; ?>">
                                            <div class="form-group">
                                                <label for="vdo">Upload img</label>
                                                <input type="file" class="form-control" id="img_review" name="img_review" accept="image/*" >
                                                <img src="../../img/review/<?= $review['img_review'] ?>" width="100" class="mt-2">
                                            </div>
                                            <div class="row">
                                            <div class="col form-group">
                                                <label for="name_review">name</label>
                                                <input type="text" class="form-control" id="name_review" name="name_review" placeholder="ชื่อ th" value="<?= $review['name_review'] ?>">
                                            </div>
                                            <div class="col form-group">
                                                <label for="position_review">ตำแหน่ง</label>
                                                <input type="text" class="form-control" id="position_review" name="position_review" placeholder="ชื่อ th" value="<?= $review['position_review'] ?>">
                                            </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="review">รีวิว</label>
                                                <input type="text" class="form-control" id="review" name="review" placeholder="ชื่อ th"value="<?= $review['review'] ?>">
                                            </div>
                                            <a href="../page_review.php" class="btn btn-secondary">ย้อนกลับ</a>
                                            <button type="submit" class="btn btn-primary">บันทึก</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><?php include '../footer.php'; ?>
        </div>
    </div>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>
</body>

</html>