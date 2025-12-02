 <!-- About Start -->

     <!-- Google Web Fonts -->
     <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Playfair+Display:wght@600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="../lib/animate/animate.min.css" rel="stylesheet">
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <link href="../css/bootstrap.min.css" rel="stylesheet">

 <link href="../css/style.css" rel="stylesheet">
 <style>
ul li{
    list-style-type: none;
}

    </style>
 <div class="container-xxl" id="about">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="row img-twice position-relative h-100">
                        <div class="col-6">
                            <img class="img-fluid rounded" src="../img/coffee400500/22.png" alt="">
                        </div>
                        <div class="col-6 align-self-end">
                            <img class="img-fluid rounded" src="../img/coffee400500/19.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="h-100">
                        <p class="text-primary text-uppercase mb-2">เกี่ยวกับเรา</p>
                        <h1 class="display-6 mb-4"><?=$about['name_about']?></h1>
                        <?= $about['detail_about']; ?>
                        <!-- <a class="btn btn-primary rounded-pill py-3 px-5" href="">Read More</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->