<?php include 'head.php'; ?>
<?php

// ดึงข้อมูลจากฐานข้อมูล
$stmt = $pdo->prepare("SELECT * FROM satisfaction WHERE id_satisfaction = 1");
$stmt->execute();
$satisfaction = $stmt->fetch(PDO::FETCH_ASSOC); // ดึงข้อมูลแถวเดียว


?>

<body id="page-top">

    <div id="wrapper">
        <?php include 'navbar.php'; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include 'nav.php'; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">banner หน้าหลัก</h1>
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
                            <h6 class="m-0 font-weight-bold text-primary">แก้ไขข้อมูล ความพึงพอใจ</h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" action="edit_save/edit_satisfaction.php">
                                <input type="hidden" name="id_satisfaction" value="<?php echo $satisfaction['id_satisfaction']; ?>">
                                <div class="row">
                                <div class="col form-group">
                                        <label for="method_satisfaction">วิธีเตรียมและบริโภค</label>
                                        <input type="text" class="form-control" id="method_satisfaction" name="method_satisfaction" value="<?= $satisfaction['method_satisfaction'] ?>" placeholder="ชื่อ th">
                                    </div>
                                    <div class="col form-group">
                                        <label for="maintenance_satisfaction">วิธีการเก็บรักษา</label>
                                        <input type="text" class="form-control" id="maintenance_satisfaction" name="maintenance_satisfaction" value="<?= $satisfaction['maintenance_satisfaction'] ?>" placeholder="ชื่อ th">
                                    </div>
                                    <div class="col form-group">
                                        <label for="caution_satisfaction">ข้อควรระวัง</label>
                                        <input type="text" class="form-control" id="caution_satisfaction" name="caution_satisfaction" value="<?= $satisfaction['caution_satisfaction'] ?>" placeholder="ชื่อ th">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col form-group">
                                        <label for="img1_satisfaction">Upload รูป1</label>
                                        <input type="file" class="form-control" id="img1_satisfaction" name="img1_satisfaction" accept="image/*">
                                        <img src="../img/satisfaction/<?= $satisfaction['img1_satisfaction'] ?>" width="100" class="mt-2">
                                    </div>
                                    <div class="col form-group">
                                        <label for="img2_satisfaction">Upload รูป2</label>
                                        <input type="file" class="form-control" id="img2_satisfaction" name="img2_satisfaction" accept="image/*">
                                        <img src="../img/satisfaction/<?= $satisfaction['img2_satisfaction'] ?>" width="100" class="mt-2">
                                    </div>                                  
                                </div>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- <?php include '../tablesatisfaction.php'; ?> -->
                <?php include 'footer.php'; ?>
            </div>
        </div>
    </div>


</body>

</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.4.1/tinymce.min.js" referrerpolicy="origin"></script>

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
        /* enable title field in the Image dialog*/
        image_title: true,
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
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
    });
</script>

<script>
    $(document).ready(function() {
        $('.select2-single').select2();

        // Date Picker Initialization
        $('#start_date_history').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            todayHighlight: true
        });

        $('#end_date_history').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            todayHighlight: true
        });
    });
</script>

</html>