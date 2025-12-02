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
                    <h1 class="h3 mb-4 text-gray-800">Upload news</h1>
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
                            <h6 class="m-0 font-weight-bold text-primary">Upload news</h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" action="../add_save/add_list_news.php">
                                <!-- name -->
                                <h6 class="m-0 font-weight-bold text-primary">ชื่อ</h6>
                                <div class="row ">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="name_th_news">ชื่อ ไทย</label>
                                            <input type="text" class="form-control" id="name_th_news" name="name_th_news" placeholder="ชื่อ th">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group ">
                                            <label for="name_en_news">ชื่อ อังกฤษ</label>
                                            <input type="text" class="form-control" id="name_en_news" name="name_en_news" placeholder="ชื่อ en">
                                        </div>
                                    </div>
                                </div>
                                <!-- name -->
                                <!-- img -->
                                <h6 class="m-0 font-weight-bold text-primary">รูป</h6>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="img_1_news">รูปหน้าปก</label>
                                            <input type="file" class="form-control" id="img_1_news" name="img_1_news" aria-describedby="inputGroupFileAddon01" aria-label="รูปหน้าปก" placeholder="รูปหน้าปก">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="img_2_news">รูปรายละเอียด</label>
                                            <input type="file" class="form-control" id="img_2_news" name="img_2_news" aria-describedby="inputGroupFileAddon02" aria-label="รูปรายละเอียด" placeholder="รูปรายละเอียด">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="img_3_news">รูปเพิ่มเติ่ม</label>
                                            <input type="file" class="form-control" id="img_3_news" name="img_3_news[]" aria-describedby="inputGroupFileAddon03" aria-label="รูปเพิ่มเติ่ม" placeholder="รูปเพิ่มเติ่ม" multiple>
                                        </div>
                                    </div>
                                </div>
                                <!-- img -->
                                <!-- detail -->

                                <h6 class="m-0 font-weight-bold text-primary">รายละเอียด</h6>
                                <div class="row ">
                                    <div class="col form-group">
                                        <label for="detail_th_news">รายละเอียด ไทย</label>
                                        <textarea class="form-control" name="detail_th_news" id="detail" rows="5"></textarea>
                                    </div>
                                    <div class="col form-group">
                                        <label for="detail_en_news">รายละเอียด อังกฤษ</label>
                                        <textarea class="form-control" name="detail_en_news" id="detail" rows="5"></textarea>
                                    </div>
                                </div>
                                <!-- detail -->
                               <a href="../news.php" class="btn btn-secondary">ย้อนกลับ</a>
                                <button type="submit" class="btn btn-primary">บันทึก</button>
                            </form>
                        </div>
                    </div>
                </div>
           
                <?php include '../footer.php'; ?>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.4.1/tinymce.min.js" referrerpolicy="origin"></script>

<script src="../vendor/select2/dist/js/select2.min.js"></script>
<script src="../vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="../vendor/bootstrap-touchspin/js/jquery.bootstrap-touchspin.js"></script>
<script src="../vendor/clock-picker/clockpicker.js"></script>
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
      $('#start_date_promotion').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true
      });

      $('#end_date_promotion').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true
      });
    });
  </script>
</html>
</body>

</html>