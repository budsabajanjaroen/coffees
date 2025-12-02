<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
    <div class="sidebar-brand-icon">
        <img src="../img/HappympmLOGO(2).png" alt="Logo" style="height: 3rem; width: 3rem;">
    </div>
    <div class="sidebar-brand-text mx-3">HappyMPM <sup>Admin</sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">


<!-- Nav Item - Dashboard -->
<li class="nav-item ">
    <a class="nav-link" href="add_home.php">
        <i class="fas fa-home"></i>
        <span>หน้าแรก</span></a>
</li>

<!-- Nav Item - Dashboard -->
<li class="nav-item ">
    <a class="nav-link" href="../table_promotion.php">
        <i class="fas fa-tags"></i>
        <span>เพิ่มโปรโมชั่น</span></a>
</li>

<!-- เกี่ยวกับบริษัท -->
<li class="nav-item ">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAboutCompany" aria-expanded="false" aria-controls="collapseAboutCompany">
        <i class="fas fa-building"></i>
        <span>เกี่ยวกับบริษัท</span>
    </a>
    <div id="collapseAboutCompany" class="collapse" aria-labelledby="headingAboutCompany" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="../page_about.php">หน้าเกียวกับเรา</a>
            <a class="collapse-item" href="../table_history.php">ความเป็นมา</a>
            <a class="collapse-item" href="../table_executives.php">ผู้บริหาร</a>
            <a class="collapse-item" href="../table_vision.php">วิสัยทัศน์</a>
            <a class="collapse-item" href="../table_honor.php">เกียรติรางวัล</a>
            <a class="collapse-item" href="../table_socialactivities.php">กิจกรรมเพื่อสังคม</a>
            <a class="collapse-item" href="../table_businesswithus.php">ร่วมธุรกิจกับเรา</a>
        </div>
    </div>
</li>

<!-- เกี่ยวกับธุรกิจ -->
<li class="nav-item ">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAboutBusiness" aria-expanded="false" aria-controls="collapseAboutBusiness">
        <i class="fas fa-briefcase"></i>
        <span>เกี่ยวกับธุรกิจ</span>
    </a>
    <div id="collapseAboutBusiness" class="collapse" aria-labelledby="headingAboutBusiness" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="../page_business.php">หน้าธุรกิจ</a>
            <a class="collapse-item" href="../table_businessplan.php">แผนธุรกิจ</a>
            <a class="collapse-item" href="../table_rules.php">กฎระเบียบ</a>
            <a class="collapse-item" href="../table_calendar.php">ตารางกิจกรรม</a>
            <a class="collapse-item" href="../table_promotion.php">โปรโมชั่นสำหรับนักธุรกิจ</a>
            <a class="collapse-item" href="../table_lectureguide.php">คู่มือบรรยาย</a>
            <a class="collapse-item" href="../table_award.php">รางวัลและความสำเร็จ</a>
        </div>
    </div>
</li>
<li class="nav-item ">
    <a class="nav-link" href="../table_news.php">
        <i class="fas fa-newspaper"></i>
        <span>ข่าวสารและกิจกรรม</span></a>
</li>
                        
<li class="nav-item ">
    <a class="nav-link" href="../table_gallery.php">                                                        
        <i class="fas fa-images"></i>
        <span>ภาพโมเมนต์พิเศษ</span></a>
</li>

<li class="nav-item ">
    <a class="nav-link" href="page_contact.php">                                                        
        <i class="fas fa-images"></i>
        <span>ติดต่อเรา</span></a>
</li>
<li class="nav-item ">
    <a class="nav-link" href="../logout.php">                                                        
        <i class="fas fa-sign-out-alt"></i>
        <span>ออกจากระบบ</span></a>
</li>

<!-- Divider -->


<!-- Heading -->
<!-- <div class="sidebar-heading">
    Interface
</div> -->

<!-- Nav Item - Pages Collapse Menu -->
<!-- <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-puzzle-piece"></i>
        <span>Components</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <a class="collapse-item" href="buttons.php">Buttons</a>
            <a class="collapse-item" href="cards.php">Cards</a>
        </div>
    </div>
</li> -->
<hr class="sidebar-divider d-none d-md-block">
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sidebarToggle = document.getElementById('sidebarToggle');
        const body = document.body;

        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function () {
                body.classList.toggle('sidebar-toggled');
                const sidebar = document.querySelector('.sidebar');
                if (sidebar) {
                    sidebar.classList.toggle('toggled');
                }
            });
        }
    });
</script>
