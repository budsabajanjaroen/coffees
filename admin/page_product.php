<?php include 'head.php'; ?>
<?php

// ดึงข้อมูลจากฐานข้อมูล
$query = "SELECT * FROM product";
$stmt = $pdo->query($query); // ใช้ตัวแปร $query ที่กำหนดไว้ด้านบน
$products = $stmt->fetchAll(PDO::FETCH_ASSOC); // เก็บข้อมูลทั้งหมดในรูปแบบ array
?>
<style>
    .limit-text {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        /* number of lines to show */
        line-clamp: 1;
        -webkit-box-orient: vertical;

    }
</style>

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
                        <h1 class="h3 mb-2 text-gray-800">สินค้า</h1>
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <div class="ระยะหาง">
                                    <div class="header-text">
                                        <h6 class="m-0 font-weight-bold text-primary">ตัวอย่างหน้า สินค้า</h6>
                                    </div>
                                    <div class="i-con-scroll">
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body-diss sleep1">
                                <?php include 'preview/product.php'; ?> </div>
                        </div>

                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <div class="ระยะหาง">
                                    <div class="header-text">
                                    <h6 class="m-0 font-weight-bold text-primary">รายการ สินค้า</h6>
                                    </div>
                                    <div class="i-con-scroll">
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body-diss sleep2">
                                <div class="table-responsive">

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <a href="add_product.php" class="btn btn-success mb-3">เพิ่มสินค้า</a>
                                            <table class="table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>รูปภาพ</th>
                                                        <th>ชื่อ</th>
                                                        <th>รายละเอียด</th>
                                                        <th>แก้ไข/ลบ</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>รูปภาพ</th>
                                                        <th>ชื่อ</th>
                                                        <th>รายละเอียด</th>
                                                        <th>แก้ไข/ลบ</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                    <?php foreach ($products as $index => $product): ?>
                                                        <tr>
                                                            <td><?= $index + 1; ?></td>
                                                            <td>
                                                                <img src="../img/product/<?= htmlspecialchars($product['img1_product']); ?>" alt="Review Image" class="img-fluid mt-2" style="width: 100px; height: auto;">
                                                            </td>
                                                            <td><?= $product['name_product']; ?></td>
                                                            <td class="limit-text"><?= $product['detail1_product']; ?></td>

                                                            <td>
                                                                <a href="add_product.php?id=<?= $product['id_product']; ?>" class="btn btn-warning btn-sm">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <a href="delete/delete_product.php?id=<?= $product['id_product']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('คุณแน่ใจหรือว่าต้องการลบรายการนี้?');">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div><?php include 'footer.php'; ?>
        </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
</body>

</html>