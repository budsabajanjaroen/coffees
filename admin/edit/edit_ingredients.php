<?php include 'head.php'; ?>
<?php
// ตรวจสอบว่ามีการส่ง ID มาใน URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['error'] = 'ไม่พบข้อมูลที่ต้องการแก้ไข';
    header('Location: ../page_ingredients.php');
    exit();
}

$id_ingredients = $_GET['id'];

// ดึงข้อมูลจากฐานข้อมูล
$query = "SELECT * FROM ingredients WHERE id_ingredients = :id_ingredients";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id_ingredients', $id_ingredients, PDO::PARAM_INT);
$stmt->execute();
$ingredients = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$ingredients) {
    $_SESSION['error'] = 'ไม่พบข้อมูลที่ต้องการแก้ไข';
    header('Location: ../page_ingredients.php');
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
                        <h1 class="h3 mb-2 text-gray-800">ส่วนประกอบ</h1>
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">รายการ ส่วนประกอบ</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="card-body">
                                        <h6 class="card-title">เพิ่ม รูปภาพ</h6>
                                        <form method="POST" enctype="multipart/form-data" action="../edit_save/edit_ingredients.php">
                                            <input type="hidden" name="id_ingredients" value="<?= $ingredients['id_ingredients'] ?>">
                                            <div class="form-group">
                                                <label for="vdo">Upload img</label>
                                                <input type="file" class="form-control" id="img_ingredients" name="img_ingredients" accept="image/*">
                                                <img src = "../../img/ingredients/<?php echo $ingredients['img_ingredients']; ?>" width="100" class="mt-2">
                                            </div>
                                          
                                            <div class="form-group">
                                                <label for="name_ingredients">ชื่อ</label>
                                                <input type="text" class="form-control" id="name_ingredients" name="name_ingredients" value="<?php echo $ingredients['name_ingredients']; ?>" required="ใส่ชื่อ">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="detail_ingredients">รายละเอียด</label>
                                                <textarea class="form-control" id="detail_ingredients" name="detail_ingredients" required="ใส่ตำแหน่ง" ><?php echo $ingredients['detail_ingredients']; ?></textarea>
                                            </div>
                                           
                                           
                                            <button type="submit" class="btn btn-primary mt-3">บันทึก</button>
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