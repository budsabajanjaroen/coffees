<!-- Sidebar -->

<style>


</style>

<div class="navbar-nav bg-gradient-primary sidebar sidebar-narrow  sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
            <img src="img/HappympmLOGO(2).png" alt="Logo" style="height: 3rem; width: 3rem;">
        </div>
        <div class="sidebar-brand-text mx-3">HappyMPM <sup>Admin</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <?php
    $current_page = basename($_SERVER['PHP_SELF']);
    ?>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= $current_page == 'page_hero.php' ? 'active' : '' ?>">
        <a class="nav-link" href="page_hero.php">
            <i class="fas fa-home"></i>
            <span>หน้าแรก</span></a>
    </li>
    <!-- Nav Item - Dashboard -->

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= $current_page == 'page_about.php' ? 'active' : '' ?>">
        <a class="nav-link" href="page_about.php">
            <i class="fa fa-info-circle"></i>
            <span>เกี่ยวกับเรา</span></a>
    </li>

    <!-- Nav Item - Dashboard -->
    <!-- <li class="nav-item <?= $current_page == 'page_nutrition.php' ? 'active' : '' ?>">
    <a class="nav-link" href="page_nutrition.php">
        <i class="fas fa-apple-alt"></i>
        <span>โภชนาการ</span></a>
</li> -->

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= $current_page == 'page_product.php' ? 'active' : '' ?>">
        <a class="nav-link" href="page_product.php">
            <i class="fas fa-box"></i>
            <span>รายการสินค้า</span></a>
    </li>

    <!-- <li class="nav-item <?= $current_page == 'page_satisfaction.php' ? 'active' : '' ?>">
    <a class="nav-link" href="page_satisfaction.php">                                                        
        <i class="fas fa-smile"></i>
        <span>ความพึงพอใจ</span></a>
</li> -->

    <li class="nav-item <?= $current_page == 'page_ingredients.php' ? 'active' : '' ?>">
        <a class="nav-link" href="page_ingredients.php">
            <i class="fas fa-leaf"></i>
            <span>สารสกัด</span></a>
    </li>

    <li class="nav-item <?= $current_page == 'page_review.php' ? 'active' : '' ?>">
        <a class="nav-link" href="page_review.php">
            <i class="fa fa-envelope"></i>
            <span>รีวิว</span></a>
    </li>

    <li class="nav-item <?= $current_page == 'page_contact.php' ? 'active' : '' ?>">
        <a class="nav-link" href="page_contact.php">
            <i class="fa fa-envelope"></i>
            <i class="fa fa-envelope"></i>
            <span>ติดต่อเรา</span></a>
    </li>
    <li class="nav-item <?= $current_page == 'logout.php' ? 'active' : '' ?>">
        <a class="nav-link" href="logout.php">
            <i class="fas fa-sign-out-alt"></i>
            <span>ออกจากระบบ</span></a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarToggle = document.getElementById('sidebarToggle');
        const body = document.body;

        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                body.classList.toggle('sidebar-toggled');
                const sidebar = document.querySelector('.sidebar');
                if (sidebar) {
                    sidebar.classList.toggle('toggled');
                }
            });
        }
    });
</script>
