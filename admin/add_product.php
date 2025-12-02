<?php include 'head.php'; ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/css/multi-select-tag.css">
<?php

// เชื่อมต่อฐานข้อมูล


$product = null;
$selectedingredientss = [];

// ตรวจสอบว่ามีการส่ง ID มาหรือไม่ (ใช้สำหรับแก้ไข)
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // ดึงข้อมูลสินค้า
    $query = "SELECT * FROM product WHERE id_product = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        echo 'ID สินค้าไม่ถูกต้อง';
        exit;
    }

    // ดึงข้อมูล ingredients ที่เชื่อมโยงกับสินค้า
    $sqlProductingredients = "SELECT id_ingredients FROM product_ingredients WHERE id_product = ?";
    $stmtProductingredients = $pdo->prepare($sqlProductingredients);
    $stmtProductingredients->execute([$product_id]);
    $selectedingredientss = $stmtProductingredients->fetchAll(PDO::FETCH_COLUMN);
}

// ดึงข้อมูลวัตถุดิบทั้งหมด
$sqlingredients = "SELECT * FROM ingredients";
$stmtingredients = $pdo->prepare($sqlingredients);
$stmtingredients->execute();
$ingredientss = $stmtingredients->fetchAll(PDO::FETCH_ASSOC);

?>


<body id="page-top">
    <div id="wrapper">
        <?php include 'navbar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include 'nav.php'; ?>
                <div class="container-fluid">
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
                        <h1 class="h3 mb-2 text-gray-800">สินค้า</h1>
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">เพิ่มรายการ สินค้า</h6>
                            </div>
                            <div class="card-body">
                                <form method="POST" enctype="multipart/form-data" action="add_save/product.php?id=<?= isset($product['id_product']) ? $product['id_product'] : ''; ?>">
                                    <div class="form-group">
                                        <label for="vdo">รูปสินค้า</label>
                                        <input type="file" class="form-control" id="img1_product" name="img1_product" accept="image/*">
                                        <?php if (isset($product['img1_product']) && !empty($product['img1_product'])): ?>
                                            <img id="preview_img1" src="../img/product/<?= htmlspecialchars($product['img1_product']); ?>" alt="Preview Image 3" style="width:250px; height:250px; margin-top:10px;">
                                        <?php else: ?>

                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="name_product">ชื่อสินค้า</label>
                                        <input type="text" class="form-control" id="name_product" name="name_product" value="<?= isset($product['name_product']) ? htmlspecialchars($product['name_product']) : ''; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="price_product">ราคาสินค้า</label>
                                        <input type="number" class="form-control" id="price_product" name="price_product" value="<?= isset($product['price_product']) ? htmlspecialchars($product['price_product']) : ''; ?>">
                                    </div>
                                    <div class="row">
                                        <div class="col form-group">
                                            <label for="img2_product">รูปแนะนำสินค้า 1</label>
                                            <input type="file" class="form-control" id="img2_product" name="img2_product" accept="image/*">
                                            <?php if (isset($product['img2_product']) && !empty($product['img2_product'])): ?>
                                                <img id="preview_img2" src="../img/product/<?= htmlspecialchars($product['img2_product']); ?>" alt="Preview Image 3" style="width:250px; height:250px; margin-top:10px;">
                                            <?php else: ?>

                                            <?php endif; ?>
                                        </div>
                                        <div class="col form-group">
                                            <label for="img3_product">รูปแนะนำสินค้า 2</label>
                                            <input type="file" class="form-control" id="img3_product" name="img3_product" accept="image/*">
                                            <?php if (isset($product['img3_product']) && !empty($product['img3_product'])): ?>
                                                <img id="preview_img4" src="../img/product/<?= htmlspecialchars($product['img3_product']); ?>" alt="Preview Image 3" style="width:250px; height:250px; margin-top:10px;">
                                            <?php else: ?>

                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col form-group">
                                        <label for="detail1_product">รายละเอียด สินค้า</label>
                                        <textarea class="form-control" name="detail1_product" id="detail" rows="5"><?= isset($product['detail1_product']) ? htmlspecialchars($product['detail1_product']) : ''; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="ingredientss" class="col-sm-2 col-form-label">เลือก วัตถุดิบ ที่เกี่ยวข้อง</label>

                                        <select class="form-edit select2" id="ingredientss" name="ingredientss[]" multiple="multiple">
                                            <?php foreach ($ingredientss as $ingredients) : ?>
                                                <option value="<?= htmlspecialchars($ingredients['id_ingredients']); ?>"
                                                    <?php if (in_array($ingredients['id_ingredients'], $selectedingredientss)) echo 'selected'; ?>>
                                                    <?= htmlspecialchars($ingredients['name_ingredients']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <label for="ingredients_list" class="col-sm-2 col-form-label">รายการวัตถุดิบและปริมาณ</label>
                                        <table class="table table-bordered" id="ingredients_table">
                                            <thead>
                                                <tr>
                                                    <th>วัตถุดิบ</th>
                                                    <th>ปริมาณ</th>
                                                    <th>การกระทำ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // ตรวจสอบว่ามีข้อมูลและเป็น JSON ที่สามารถแปลงเป็นอาร์เรย์ได้
                                                $com_product_array = isset($product['com_product']) ? json_decode($product['com_product'], true) : [];
                                                $amount_product_array = isset($product['amount_product']) ? json_decode($product['amount_product'], true) : [];

                                                if (!empty($com_product_array) && !empty($amount_product_array)): ?>
                                                    <?php foreach ($com_product_array as $index => $com_product): ?>
                                                        <tr>
                                                            <td>
                                                                <input type="text" class="form-control" name="com_product[]" value="<?= htmlspecialchars($com_product); ?>">
                                                            </td>
                                                            <td>
                                                                <input type="number" step="0.01" class="form-control" name="amount_product[]" min="0.01"
                                                                    value="<?= htmlspecialchars($amount_product_array[$index]); ?>">
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-danger remove-row">ลบ</button>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td>
                                                            <input type="text" class="form-control" name="com_product[]">
                                                        </td>
                                                        <td>
                                                            <input type="number" step="0.01" class="form-control" name="amount_product[]" min="0.01">
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger remove-row">ลบ</button>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>

                                        </table>
                                        <button type="button" class="btn btn-success mt-2" id="add_row">เพิ่มแถว</button>
                                    </div>
                                    <div class="row">
                                        <div class="col form-group">
                                            <label for="img4_product">รูปแนะนำสินค้า 3</label>
                                            <input type="file" class="form-control" id="img4_product" name="img4_product" accept="image/*" onchange="previewImage(event, 'preview_img4')">
                                            <?php if (isset($product['img4_product']) && !empty($product['img4_product'])): ?>
                                                <img id="preview_img4" src="../img/product/<?= htmlspecialchars($product['img4_product']); ?>" alt="Preview Image 3" style="width:250px; height:250px; margin-top:10px;">
                                            <?php else: ?>

                                            <?php endif; ?>
                                        </div>
                                        <div class="col form-group">
                                            <label for="img5_product">รูปแนะนำสินค้า 4</label>
                                            <input type="file" class="form-control" id="img5_product" name="img5_product" accept="image/*" onchange="previewImage(event, 'preview_img5')">
                                            <?php if (isset($product['img5_product']) && !empty($product['img5_product'])): ?>
                                                <img id="preview_img5" src="../img/product/<?= htmlspecialchars($product['img5_product']); ?>" alt="Preview Image 4" style="width:250px; height:250px; margin-top:10px;">
                                            <?php else: ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="consumption_product"> วิธีเตรียมและบริโภค</label>
                                        <input type="text" class="form-control" id="consumption_product" name="consumption_product" value="<?= isset($product['consumption_product']) ? htmlspecialchars($product['consumption_product']) : ''; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="keeping_product">การเก็บรักษา</label>
                                        <input type="text" class="form-control" id="keeping_product" name="keeping_product" value="<?= isset($product['keeping_product']) ? htmlspecialchars($product['keeping_product']) : ''; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="guard_product">ข้อควรระวัง</label>
                                        <input type="text" class="form-control" id="guard_product" name="guard_product" value="<?= isset($product['guard_product']) ? htmlspecialchars($product['guard_product']) : ''; ?>">
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
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.4.1/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/js/multi-select-tag.js"></script>
    <script>
        new MultiSelectTag('ingredientss', {
            rounded: true,
            shadow: true,
            placeholder: 'Search',
            tagColor: {
                textColor: '#327b2c',
                borderColor: '#92e681',
                bgColor: '#eaffe6',
            },
            onChange: function(values) {
                console.log(values)
            }
        })
    </script>
    <script>
      tinymce.init({
    selector: 'textarea#detail',
    plugins: 'advlist autolink lists link image charmap print preview anchor code fullscreen insertdatetime media table paste code help wordcount',
    toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | image | fullscreen preview | code',
    menubar: 'file edit view insert format tools table help',
    height: 300,
    branding: false,
    automatic_uploads: true,
    file_picker_types: 'image',
    paste_data_images: true,
    images_file_types: 'jpg,svg,webp',
    image_title: true,
    valid_elements: '*[*]',  // อนุญาตให้ใช้ทุกแท็กและแอตทริบิวต์
    extended_valid_elements: 'i[class|style]',  // อนุญาตแท็ก <i> และกำหนด class หรือ style

    file_picker_callback: (cb, value, meta) => {
        const input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'img/*');
        input.addEventListener('change', (e) => {
            const file = e.target.files[0];
            const reader = new FileReader();
            reader.addEventListener('load', () => {
                const id = 'blobid' + (new Date()).getTime();
                const blobCache = tinymce.activeEditor.editorUpload.blobCache;
                const base64 = reader.result.split(',')[1];
                const blobInfo = blobCache.create(id, file, base64);
                blobCache.add(blobInfo);
                cb(blobInfo.blobUri(), {
                    title: file.name
                });
            });
            reader.readAsDataURL(file);
        });
        input.click();
    },
    setup: function(editor) {
        editor.on('PreProcess', function(e) {
            let lists = e.node.querySelectorAll('ul, ol');
            lists.forEach(list => {
                list.classList.add('row', 'g-2', 'mb-4'); // เพิ่ม class ให้ <ul> และ <ol>
                list.querySelectorAll('li').forEach(li => {
                    li.classList.add('col-sm-6'); // เพิ่ม class ให้ <li>
                    
                    // ตรวจสอบว่ามีไอคอนหรือไม่ ถ้ายังไม่มีให้เพิ่ม
                    if (!li.querySelector('i')) {
                        li.innerHTML = `<i class="fa fa-check text-primary me-2"></i> ` + li.innerHTML;
                    }
                });
            });
        });
    },
    content_style: 'ul.row.g-2.mb-4 { padding: 0; } li.col-sm-6 { list-style: none; margin-bottom: 10px; }'
});

    </script>
    <script>
        document.getElementById('add_row').addEventListener('click', function() {
            var table = document.getElementById('ingredients_table').getElementsByTagName('tbody')[0];
            var newRow = table.rows[0].cloneNode(true);
            newRow.querySelectorAll('input').forEach(input => input.value = '');
            table.appendChild(newRow);
        });

        document.getElementById('ingredients_table').addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-row')) {
                var row = e.target.closest('tr');
                if (document.getElementById('ingredients_table').rows.length > 2) {
                    row.remove();
                }
            }
        });
    </script>
</body>

</html>