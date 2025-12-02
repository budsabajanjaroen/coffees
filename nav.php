<?php
$query = "SELECT * FROM product";
$stmt = $pdo->prepare($query);
$stmt->execute();
$productssss = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?php
// อ่านภาษาจาก URL: /coffees/{lang}/...
$supported = ['th', 'en', 'lo', 'km'];
$currentLang = 'th';
if (preg_match('#^/coffees/(th|en|lo|km)(?:/|$)#i', $_SERVER['REQUEST_URI'], $m)) {
  $currentLang = strtolower($m[1]);
}
$base = "/coffees/{$currentLang}/index.php";
?>

<style>
  /* กัน Google Translate ดัน layout */
  html {
    margin-top: 0 !important;
  }

  body {
    top: 0 !important;
    position: relative !important;
  }

  .goog-te-banner-frame.skiptranslate {
    display: none !important;
  }

  body>.skiptranslate {
    display: none !important;
  }

  .language-switcher img {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    /* ทำให้เป็นวงกลม */
    object-fit: cover;
    /* ครอบให้เต็มวงกลม */
    border: 2px solid #ddd;
    /* เส้นขอบบางๆ ดูเรียบหรู */
    cursor: pointer;
    transition: transform 0.2s ease, border-color 0.2s ease;
  }

  .language-switcher img:hover {
    transform: scale(1.1);
    border-color: #007bff;
    /* เปลี่ยนสีขอบตอน hover */
  }
</style>

<nav id="navbar" class="navbar navbar-expand-lg navbar-dark fixed-top py-lg-0 px-lg-5">
  <a href="<?= $base ?>" class="navbar-brand ms-4 ms-lg-0">
    <h1 class="text-primary m-0">HAPPY COFFEE</h1>
  </a>

  <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarCollapse">
    <div class="navbar-nav mx-auto p-4 p-lg-0">

      <!-- Language Switcher: คลิกแล้ว "เปลี่ยน URL" ไป ../coffees/{lang}/index.php -->
      <div class="language-switcher toggler-3" translate="no" style="display:flex;gap:10px;align-items:center">
        <a href="#" data-lang="th"><img src="https://flagcdn.com/w40/th.png" alt="ภาษาไทย" width="30" height="20"></a>
        <a href="#" data-lang="en"><img src="https://flagcdn.com/w40/us.png" alt="English" width="30" height="20"></a>
        <!-- เปิดเพิ่มภายหลังได้ -->
        <!-- <a href="#" data-lang="lo"><img src="https://flagcdn.com/w40/la.png"></a> -->
        <!-- <a href="#" data-lang="km"><img ...></a> -->
      </div>
      <div id="google_translate_element" style="display:none"></div>

      <!-- เมนูหลัก: ใช้ฐานลิงก์ตามภาษาปัจจุบัน -->
      <a href="<?= $base ?>" class="nav-item nav-link">หน้าแรก</a>
      <a href="<?= $base ?>#about" class="nav-item nav-link">เกี่ยวกับเรา</a>
      <a href="<?= $base ?>#Testimonial" class="nav-item nav-link">รีวิว</a>

      <div class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">ผลิตภัณฑ์</a>
        <div class="dropdown-menu m-0">
          <?php foreach ($productssss as $product): ?>
            <a class="dropdown-item"
              href="/coffees/<?= $currentLang ?>/productdetailss.php?id=<?= (int)$product['id_product'] ?>">
              <?= htmlspecialchars($product['name_product']) ?>
            </a>
          <?php endforeach; ?>
        </div>
      </div>

    </div>
  </div>
</nav>