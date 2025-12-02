<?php include 'head.php'; ?>
<link href="vendor/clock-picker/clockpicker.css" rel="stylesheet">
<link href="vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
  <link href="vendor/bootstrap-touchspin/css/jquery.bootstrap-touchspin.css" rel="stylesheet">
<body id="page-top">

    <div id="wrapper">
        <!-- Sidebar -->
        <?php include '../navbar.php'; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include '../nav.php'; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">ประวัติความเป็นมา</h1>
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
                            <h6 class="m-0 font-weight-bold text-primary">เพิ่ม ประวัติความเป็นมา</h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" action="../add_save/add_list_history.php">
                                <!-- name -->
                                <h6 class="m-0 font-weight-bold text-primary">ชื่อ</h6>
                                <div class="row ">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="name_th_history">ชื่อ ไทย</label>
                                            <input type="text" class="form-control" id="name_th_history" name="name_th_history" placeholder="ชื่อ th">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group ">
                                            <label for="name_en_history">ชื่อ อังกฤษ</label>
                                            <input type="text" class="form-control" id="name_en_history" name="name_en_history" placeholder="ชื่อ en">
                                        </div>
                                    </div>
                                </div>
                                <!-- name -->
                                
                                <!-- detail -->

                                <h6 class="m-0 font-weight-bold text-primary">รายละเอียด</h6>
                                <div class="row ">
                                    <div class="col form-group">
                                        <label for="detail_th_history">รายละเอียด ไทย</label>
                                        <textarea class="form-control" name="detail_th_history" id="detail" rows="5"></textarea>
                                    </div>
                                    <div class="col form-group">
                                        <label for="detail_en_history">รายละเอียด อังกฤษ</label>
                                        <textarea class="form-control" name="detail_en_history" id="detail" rows="5"></textarea>
                                    </div>
                                </div>
                                <!-- detail -->
                                <!-- start date - end date -->
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h6 class="m-0 font-weight-bold text-primary">เวลาประวัติ</h6>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group" id="simple-date3">
                                                    <label for="start_date_history">date</label>
                                                    <div class="input-group date">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="start_date_history" name="start_date_history" value="<?php echo date('d/m/Y'); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                                <!-- date -->
                                <a href="../table_history.php" class="btn btn-secondary">ย้อนกลับ</a>
                                <button type="submit" class="btn btn-primary">บันทึก</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php include '../footer.php'; ?>
        </div>
    </div>
    <!-- <?php include '../script.php'; ?> -->

</body>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.4.1/tinymce.min.js" referrerpolicy="origin"></script>

  <script src="vendor/select2/dist/js/select2.min.js"></script>
  <script src="vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
  <script src="vendor/bootstrap-touchspin/js/jquery.bootstrap-touchspin.js"></script>
  <script src="vendor/clock-picker/clockpicker.js"></script>
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