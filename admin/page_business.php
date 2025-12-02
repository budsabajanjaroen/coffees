<?php include 'head.php'; ?>


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
                    <h1 class="h3 mb-2 text-gray-800">หน้าธุรกิจ</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">รายการ ธุรกิจ</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>รูปภาพ</th>
                                        <th>ชื่อ (ไทย)</th>
                                        <th>ตำแหน่ง (ไทย)</th>
                                        <th>ชื่อ (อังกฤษ)</th>
                                        <th>ตำแหน่ง (อังกฤษ)</th>
                                        <th>แก้ไข/ลบ</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>รูปภาพ</th>
                                        <th>ชื่อ (ไทย)</th>
                                        <th>ตำแหน่ง (ไทย)</th>
                                        <th>ชื่อ (อังกฤษ)</th>
                                        <th>ตำแหน่ง (อังกฤษ)</th>
                                        <th>แก้ไข/ลบ</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                   <td>1</td>
                                   <td>1</td>
                                   <td>1</td>
                                   <td>1</td>
                                   <td>1</td>
                                   <td>1</td>
                                   <td>1</td>
                                   <td>1</td>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>

                    </div>

                </div>

                <?php include 'footer.php'; ?>
            </div>
        </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/demo/datatables-demo.js"></script>
    

</body>

</html>