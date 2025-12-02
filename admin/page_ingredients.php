<?php include 'head.php'; ?>
<?php

// ดึงข้อมูลจากฐานข้อมูล
$query = "SELECT * FROM ingredients";
$stmt = $pdo->query($query); // ใช้ตัวแปร $query ที่กำหนดไว้ด้านบน
$ingredientss = $stmt->fetchAll(PDO::FETCH_ASSOC); // เก็บข้อมูลทั้งหมดในรูปแบบ array

// ดึงข้อมูล id_ingredients ที่เชื่อมโยงกับ id_page = 1
$pageingredientsSql = "SELECT id_ingredients FROM page_ingredients WHERE id_page = 1";
$pageingredientsStmt = $pdo->prepare($pageingredientsSql);
$pageingredientsStmt->execute();
$selectedingredientss = $pageingredientsStmt->fetchAll(PDO::FETCH_COLUMN);

?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/css/multi-select-tag.css">

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
                        <h1 class="h3 mb-2 text-gray-800">สารสกัด</h1>
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <div class="ระยะหาง">
                                    <div class="header-text">
                                        <h6 class="m-0 font-weight-bold text-primary">ตัวอย่างหน้า สารสกัด</h6>
                                    </div>
                                    <div class="i-con-scroll">
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                </div>
                               
                            </div>
                            <div class="sleep1">
                            <div class="card-body not-padding">
                                <?php require 'preview/ingredients.php'; ?>
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800">สารสกัด</h1>
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <div class="ระยะหาง">
                                    <div class="header-text">
                                        <h6 class="m-0 font-weight-bold text-primary">รายการ สารสกัด</h6>
                                    </div>
                                    <div class="i-con-scroll">
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                </div>
                            </div>
                            <div class ="sleep2">
                            <div class="card-body not-padding">
                                <form action="save_page_ingredients.php" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="ingredients">เลือก ingredients:</label>
                                        <select id="ingredients" name="ingredientss[]" class="mult-select-tag" multiple>
                                            <?php foreach ($ingredientss as $ingredients): ?>
                                                <option value="<?= $ingredients['id_ingredients'] ?>" <?= in_array($ingredients['id_ingredients'], $selectedingredientss) ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($ingredients['name_ingredients']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-3">บันทึก</button>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800">สารสกัด</h1>
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <div class="ระยะหาง">
                                    <div class="header-text">
                                        <h6 class="m-0 font-weight-bold text-primary">รายการ สารสกัด</h6>
                                    </div>
                                    <div class="i-con-scroll">
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                </div>
                             
                            </div>
                            <div class="sleep3">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="card-body">
                                        <h6 class="card-title">เพิ่ม รูปภาพ</h6>
                                        <form method="POST" enctype="multipart/form-data" action="add_save/add_list_ingredients.php">
                                            <div class="form-group">
                                                <label for="vdo">Upload img</label>
                                                <input type="file" class="form-control" id="img_ingredients" name="img_ingredients" accept="image/*" required="ใส่รูปภาพ">
                                            </div>

                                            <div class="form-group">
                                                <label for="name_ingredients">ชื่อ</label>
                                                <input type="text" class="form-control" id="name_ingredients" name="name_ingredients" required="ใส่ชื่อ">
                                            </div>

                                            <div class="form-group">
                                                <label for="detail_ingredients">รายละเอียด</label>
                                                <input type="text" class="form-control" id="detail_ingredients" name="detail_ingredients" required="ใส่ตำแหน่ง">
                                            </div>

                                            <button type="submit" class="btn btn-primary mt-3">บันทึก</button>
                                        </form>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                                                    <?php foreach ($ingredientss as $index => $ingredients): ?>
                                                        <tr>
                                                            <td><?= $index + 1; ?></td>
                                                            <td>
                                                                <img src="../img/ingredients/<?= htmlspecialchars($ingredients['img_ingredients']); ?>" alt="Review Image" class="img-fluid mt-2" style="width: 100px; height: auto;">
                                                            </td>
                                                            <td><?= $ingredients['name_ingredients']; ?></td>
                                                            <td><?= $ingredients['detail_ingredients']; ?></td>

                                                            <td>
                                                                <a href="edit/edit_ingredients.php?id=<?= $ingredients['id_ingredients']; ?>" class="btn btn-warning btn-sm">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <a href="delete/delete_ingredients.php?id=<?= $ingredients['id_ingredients']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('คุณแน่ใจหรือว่าต้องการลบรายการนี้?');">
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
                        </div></div>
                    </div>
                </div>
            </div><?php include 'footer.php'; ?>
        </div>


</body>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>
<script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/js/multi-select-tag.js"></script>
<script>
    new MultiSelectTag('ingredients', {
        rounded: true, // default true
        shadow: true, // default false
        placeholder: 'Search...', // default Search...
        tagColor: {
            textColor: '#327b2c',
            borderColor: '#92e681',
            bgColor: '#eaffe6',
        },
        onChange: function(values) {
            console.log(values);
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>


</html>