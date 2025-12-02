<!-- Team Start -->
<div class="container-xxl py-6" id="Team">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="text-primary text-uppercase mb-2">HAPPY COFFEE & HAPPY COFFEE GOLD & HAPPY COFFEE MAX</p>
            <h1 class="display-6 mb-4">สารสกัดจากธรรมชาติมากกว่า 
            <?= count($selectedingredientss); ?>
            
            ชนิด</h1>
        </div>
        <div class="row g-4">

            <?php if (!empty($selectedingredientss)): ?>
                <?php foreach ($ingredientss as $index => $ingredients): ?>
                    <?php if (in_array($ingredients['id_ingredients'], $selectedingredientss)): ?>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item text-center rounded overflow-hidden">
                            <img class="img-fluid" src="../img/ingredients/<?= $ingredients['img_ingredients']; ?>" alt="">
                            <div>
                                <div>
                                    <h5><?= $ingredients['name_ingredients']; ?></h5>
                                    <span><?= $ingredients['detail_ingredients']; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- Team End -->