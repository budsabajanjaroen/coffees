<?php include 'head.php'; ?>
<?php

// ดึงข้อมูลจากฐานข้อมูล
$query = "SELECT * FROM executives";
$stmt = $pdo->query($query); // ใช้ตัวแปร $query ที่กำหนดไว้ด้านบน
$executivess = $stmt->fetchAll(PDO::FETCH_ASSOC); // เก็บข้อมูลทั้งหมดในรูปแบบ array
?>

<body id="page-top">

    <div id="wrapper">
        <?php include 'navbar.php'; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include 'nav.php'; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">ผู้บริหาร</h1>
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

                    <!-- Upload Form -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">เพิ่มรายชื่อ ผู้บริหาร</h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" action="../add_save/add_list_executives.php">
                            <div class="form-group">
                                    <label for="image">รูปประจำตัว</label>
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="name_th_executives">ชื่อ (ภาษาไทย)</label>
                                            <input type="text" class="form-control" id="name_th_executives" name="name_th_executives" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="position_th_executives">ตำแหน่ง (ภาษาไทย)</label>
                                            <input type="text" class="form-control" id="position_th_executives" name="position_th_executives" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="name_en_executives">ชื่อ (ภาษาอังกฤษ)</label>
                                            <input type="text" class="form-control" id="name_en_executives" name="name_en_executives" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="position_en_executives">ตำแหน่ง (ภาษาอังกฤษ)</label>
                                            <input type="text" class="form-control" id="position_en_executives" name="position_en_executives" required>
                                        </div>
                                    </div>
                                </div>
                            <a href="../table_executives.php" class="btn btn-secondary">ย้อนกลับ</a>
                                <button type="submit" class="btn btn-primary">บันทึก</button>
                            </form>
                        </div>
                    </div>
                </div>
               
                
            </div><?php include '../footer.php'; ?>
        </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


</body>

</html>