
  <div class="instargram_area owl-carousel section_padding_100_0 clearfix" id="portfolio">

        <?php $rez = executeQuery("SELECT * FROM `gallery2`"); foreach ($rez as $red): ?>
         
        <!-- Instagram Item -->
        <div class="instagram_gallery_item">
            <!-- Instagram Thumb -->
            <img src="<?= $red->src; ?>" alt="<?= $red->alt; ?>">
            <!-- Hover -->
            <div class="hover_overlay">
                <div class="yummy-table">
                    <div class="yummy-table-cell">
                        <div class="follow-me text-center">
                            <a href="<?= $red->href; ?>"><i class="fa fa-instagram" aria-hidden="true"></i><?= " ".$red->title; ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach;  ?>

     

    </div>