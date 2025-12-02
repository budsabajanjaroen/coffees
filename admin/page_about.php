<?php include 'head.php'; ?>
<?php

// ดึงข้อมูลจากฐานข้อมูล
$stmt = $pdo->prepare("SELECT * FROM about WHERE id_about = 1");
$stmt->execute();
$about = $stmt->fetch(PDO::FETCH_ASSOC); // ดึงข้อมูลแถวเดียว

if (!$about) {
    $_SESSION['error'] = 'ไม่พบข้อมูลในฐานข้อมูล';
    header('Location: ../admin_hero.php');
    exit();
}
?>
<style>
    .row {
        --bs-gutter-x: 1.5rem;
        --bs-gutter-y: 0;
        display: flex;
        flex-wrap: wrap;
        margin-top: calc(var(--bs-gutter-y)* -1);
        margin-right: calc(var(--bs-gutter-x) / -2);
        margin-left: calc(var(--bs-gutter-x) / -2);
    }

    .position-relative {
        position: relative !important;
    }

    .img-twice::before {
        position: absolute;
        content: "";
        width: 60%;
        height: 80%;
        top: 10%;
        left: 20%;
        background: var(--primary);
        border: 25px solid var(--light);
        border-radius: 6px;
        z-index: -1;
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
                    <h1 class="h3 mb-4 text-gray-800">เกี่ยวกับเรา</h1>
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
                            <div class="ระยะหาง">
                                <div class="header-text">
                                    <h6 class="m-0 font-weight-bold text-primary">ตัวอย่างหน้า เกี่ยวกับเรา</h6>
                                </div>
                                <div class="i-con-scroll">
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>

                        </div>
                        <div class="sleep1">
                        <div class="card-body">
                            <?php require 'preview/about.php'; ?>
                            <br>
                        </div>
                        </div>
                    </div>


                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="ระยะหาง">
                                <div class="header-text">
                                    <h6 class="m-0 font-weight-bold text-primary">แก้ไขข้อมูล เกี่ยวกับเรา</h6>
                                </div>
                                <div class="i-con-scroll">
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                           
                        </div>
                        <div class="sleep2">
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" action="edit_save/edit_about.php">
                                <input type="hidden" name="id_about" value="<?php echo $about['id_about']; ?>">
                                <div class="row">
                                    <div class="col form-group">
                                        <label for="image">Upload รูป1</label>
                                        <input type="file" class="form-control" id="image1" name="image1" accept="image/*">
                                        <img src="../img/about/<?= $about['img1_about'] ?>" width="100" class="mt-2">
                                    </div>
                                    <div class="col form-group">
                                        <label for="image">Upload รูป2</label>
                                        <input type="file" class="form-control" id="image2" name="image2" accept="image/*">
                                        <img src="../img/about/<?= $about['img2_about'] ?>" width="100" class="mt-2">
                                    </div>


                                    <div class="form-group">
                                        <label for="name_about">ชื่อ ไทย</label>
                                        <input type="text" class="form-control" id="name_about" name="name_about" value="<?= $about['name_about'] ?>" placeholder="ชื่อ th">
                                    </div>
                                    <div class="col form-group">
                                        <label for="detail_about">รายละเอียด ไทย</label>
                                        <textarea class="form-control" name="detail_about" id="detail" rows="5"><?= $about['detail_about'] ?></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </form>
                        </div>
                    </div></div>
                </div>
                <!-- <?php include '../tableabout.php'; ?> -->
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
        image_title: true,
        valid_elements: '*[*]', // อนุญาตให้ใช้ทุกแท็กและแอตทริบิวต์
        extended_valid_elements: 'i[class|style]', // อนุญาตแท็ก <i> และกำหนด class หรือ style

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