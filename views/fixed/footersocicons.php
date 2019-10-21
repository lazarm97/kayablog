
<div class="social_icon_area clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="footer-social-area d-flex">
                        <?php $rez = executeQuery("SELECT * FROM `footersocicons`"); foreach ($rez as $red): ?>
                        <div class="single-icon">
                            <a href="<?= $red->href; ?>"><i class="fa <?= $red->class; ?>" aria-hidden="true"></i><span><?= $red->title; ?></span></a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
</div>