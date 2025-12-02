 <!-- Product Start -->
 <style>
     .limit-text {
         display: -webkit-box;
         -webkit-line-clamp: 3;
         /* Number of lines to show */
         -webkit-box-orient: vertical;
         overflow: hidden;
         text-overflow: ellipsis;
         height: 4.5em;
         /* Adjust height based on line height */
         line-height: 1.5em;
         /* Adjust line height */
     }

     .bg-light {
         background-color: #fdf5eb !important;
     }
     .text-primarys{
        color: #EAA636 !important;
     }.border-primary{
        border-color: #EAA636 !important;
     }.text-colorss{
        color: #EAA636 !important;
     }
     .fadeInUp :hover .text-colorss{
        color:rgb(255, 255, 255) !important;
     }.container-xxl{
        padding: -50px !important;
     }
 </style>
  <link href="../css/style.css" rel="stylesheet">
 <div class="container-xxl bg-light  py-6 pt-0" id="Product">
     <div class="container">
         <!-- <div class="bg-primary text-light rounded-bottom p-5 my-6 mt-0 wow fadeInUp" data-wow-delay="0.1s">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-6">
                        <h1 class="display-4 text-light mb-0">Happy Coffee</h1>
                    </div>
                    <div class="col-lg-6 text-lg-end">
                        <div class="d-inline-flex align-items-center text-start">
                            <i class="fa fa-phone-alt fa-4x flex-shrink-0"></i>
                            <div class="ms-4">
                                <p class="fs-5 fw-bold mb-0">Call Us</p>
                                <p class="fs-1 fw-bold mb-0">02-642-5425</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
         <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
             <p class="text-primarys text-uppercase mb-2">ผลิตภัณฑ์</p>
             <h1 class="display-6 mb-4">Happy Coffee</h1>
         </div>
         <div class="row g-4">           
             
            <?php foreach ($products as $index => $product): ?>
                 <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                     <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100">
                         <div class="text-center p-4">
                             <div class="d-inline-block border border-primary rounded-pill pt-1 px-3 mb-3">฿  <?php echo $product['price_product']; ?> 
                             </div>
                             <a class="d-inline-block border border-primary rounded-pill px-3 mb-3 text-colorss" href="https://liff.line.me/2004905932-ZvVLn72n">สั่งซื้อผลิตภัณฑ์</a>

                             <h4 class="mb-3"><?= $product['name_product']; ?></h4>
                             <span class="limit-text"><?= $product['detail1_product']; ?></span>
                         </div>
                         <div class="position-relative mt-auto">
                             <img class="img-fluid" src="../img/product/<?= htmlspecialchars($product['img1_product']); ?>" alt="">
                             <div class="product-overlay">
                                 <a class="btn btn-lg-square btn-outline-light rounded-circle" href="#"><i
                                         class="fa fa-eye text-primary"></i></a>
                             </div>
                         </div>
                     </div>
                 </div>
            <?php endforeach; ?>

         </div>
     </div>
 </div>
 <!-- Product End -->