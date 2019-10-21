<?php
    $rez = executeQuery("SELECT * FROM `category`");

?>

<section class="categories_area clearfix" id="about">
    <div class="container">
        <div class="row">


        <?php $br = 3; foreach ($rez as $red): ?>
            
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single_catagory wow fadeInUp" data-wow-delay=".<?= $br; ?>s">
                        <img src="<?= $red->src; ?>" alt="<?= $red->alt; ?>">
                        <div class="catagory-title">
                            <a href="<?= $red->href; ?>">
                                <h5><?= $red->title; ?></h5>
                            </a>
                        </div>
                    </div>
                </div>
                <?php $br+=3; ?>
        <?php endforeach; ?>
            </div>
        </div> 
</section>