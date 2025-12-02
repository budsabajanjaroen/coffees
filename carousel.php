 <!-- Carousel Start -->
 <?php

    // ดึงข้อมูลจากฐานข้อมูล
    $query = "SELECT * FROM hero";
    $stmt = $pdo->query($query); // ใช้ตัวแปร $query ที่กำหนดไว้ด้านบน
    $heros = $stmt->fetchAll(PDO::FETCH_ASSOC); // เก็บข้อมูลทั้งหมดในรูปแบบ array
    ?>
    <!-- <style>
        .owl-carousel-item video {
             width: 100vw; /* แนะนำให้เปลี่ยน */
            height: 100vh;
            object-fit: cover;
        }
        </style> -->
 <div class="container-fluid p-0 wow fadeIn" data-wow-delay="0.1s" id="home">
     <div class="owl-carousel header-carousel position-relative">
         <!-- <div class="owl-carousel-item position-relative">
             <video class="img-fluid" playsinline autoplay muted loop src="img/coffee7.mp4" type="video/mp4"></video>
         </div>
         <div class="owl-carousel-item position-relative">
             <video class="img-fluid" playsinline autoplay muted loop src="img/coffee5.mp4" type="video/mp4"></video>
         </div> -->
         <?php foreach ($heros as $index => $hero) : ?>
             <div class="owl-carousel-item position-relative">
                 <video class="img-fluid" playsinline autoplay muted loop src="/coffees/vdo/<?= ($hero['vdo_hero']); ?>" type="video/mp4"></video>
             </div>
         <?php endforeach; ?>
     </div>
 </div>
 <!-- Carousel End -->

 