<link href="../lib/animate/animate.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- Template Javascript -->
<script src="../js/main.js"></script>


<script src="../lib/owlcarousel/owl.carousel.min.js"></script>
<link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

<style>
    .header-carousel .owl-carousel-inner {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        display: flex;
        align-items: center;
        /* background: rgba(0, 0, 0, .5); */
    }

    @media (max-width: 768px) {
        .header-carousel .owl-carousel-item {
            position: relative;
            /* min-height: 600px; */
        }

        .header-carousel .owl-carousel-item img {
            position: absolute;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .header-carousel .owl-carousel-item p {
            font-size: 16px !important;
        }
    }

    .header-carousel .owl-nav {
        position: relative;
        width: 80px;
        height: 80px;
        margin: -40px auto 0 auto;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .header-carousel .owl-nav::before {
        position: absolute;
        content: "";
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background: #FFFFFF;
        transform: rotate(45deg);
    }

    .header-carousel .owl-nav .owl-prev,
    .header-carousel .owl-nav .owl-next {
        position: relative;
        font-size: 40px;
        color: #EAA636;
        transition: .5s;
        z-index: 1;
    }

    .header-carousel .owl-nav .owl-prev:hover,
    .header-carousel .owl-nav .owl-next:hover {
        color: #1E1916;
    }

    /*** Testimonial ***/
    .testimonial-carousel .owl-item .testimonial-item img {
        width: 60px;
        height: 60px;
    }

    .testimonial-carousel .owl-item .testimonial-item,
    .testimonial-carousel .owl-item .testimonial-item * {
        transition: .5s;
    }

    .testimonial-carousel .owl-item.center .testimonial-item {
        background: #EAA636 !important;
    }

    .testimonial-carousel .owl-item.center .testimonial-item * {
        color: #FFFFFF !important;
    }

    .testimonial-carousel .owl-nav {
        margin-top: 30px;
        display: flex;
        justify-content: center;
    }

    .testimonial-carousel .owl-nav .owl-prev,
    .testimonial-carousel .owl-nav .owl-next {
        margin: 0 12px;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50px;
        font-size: 22px;
        color: #FDF5EB;
        background: #EAA636;
        transition: .5s;
    }

    .testimonial-carousel .owl-nav .owl-prev:hover,
    .testimonial-carousel .owl-nav .owl-next:hover {
        color: #EAA636;
        background: #1E1916;
    }

    .bg-prime {
        background: #FDF5EB;
    }
</style>

<!-- Carousel Start -->
 <!-- Carousel Start -->
 <div class="container-fluid p-0 wow fadeIn" data-wow-delay="0.1s" id="home">
        <div class="owl-carousel header-carousel position-relative">
            <?php foreach ($heros as $index => $hero) : ?>
            <div class="owl-carousel-item position-relative">
                <video class="img-fluid" playsinline autoplay muted loop src="../vdo/<?= ($hero['vdo_hero']); ?>" type="video/mp4"></video>
            </div>
            <?php endforeach; ?>
            <div class="owl-carousel-item position-relative">
                <video class="img-fluid" playsinline autoplay muted loop src="../img/coffee5.mp4" type="video/mp4"></video>
            </div>
        </div>
    </div>
    <!-- Carousel End -->
     
<!-- Carousel End -->