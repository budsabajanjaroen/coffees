
 <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="text-center my-auto">
                        <span>Happy coffee &copy; Your Website 2025</span>
                    </div>
                </div>
            </footer>
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
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        const iconScrolls = document.querySelectorAll('.i-con-scroll');

        iconScrolls.forEach(iconScroll => {
            // หาส่วนที่ต้องการเปิด/ปิด
            const card = iconScroll.closest('.card');
            const tableResponsive = card.querySelector('.sleep1, .sleep2, .sleep3');

            // ตั้งค่าเริ่มต้นให้แสดงเต็มที่
            tableResponsive.style.height = 'auto';
            tableResponsive.style.overflow = 'visible';
            tableResponsive.style.transition = 'height 0.5s ease-in-out';

            // เปลี่ยนไอคอนเป็น "chevron-up" เพื่อให้สื่อว่าปิดได้
            const icon = iconScroll.querySelector('i');
            icon.classList.remove('fa-chevron-down');
            icon.classList.add('fa-chevron-up');

            iconScroll.addEventListener('click', function() {
                if (tableResponsive.style.height === 'auto' || tableResponsive.style.height === tableResponsive.scrollHeight + 'px') {
                    // ปิด (ตั้งค่า height เป็น 0px)
                    tableResponsive.style.height = tableResponsive.scrollHeight + 'px'; // ตั้งค่าก่อน transition
                    setTimeout(() => {
                        tableResponsive.style.height = '0px';
                        tableResponsive.style.overflow = 'hidden';
                    }, 10);
                    
                    icon.classList.remove('fa-chevron-up');
                    icon.classList.add('fa-chevron-down');
                } else {
                    // เปิด (ตั้งค่า height เป็น auto)
                    tableResponsive.style.height = tableResponsive.scrollHeight + 'px';
                    tableResponsive.style.overflow = 'visible';

                    setTimeout(() => {
                        tableResponsive.style.height = 'auto';
                    }, 500); // ตั้งเป็น auto หลังจาก transition
                    
                    icon.classList.remove('fa-chevron-down');
                    icon.classList.add('fa-chevron-up');
                }
            });
        });
    });
</script>





