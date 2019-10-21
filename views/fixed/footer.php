<footer class="footer_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="footer-content">
                        <!-- Logo Area Start -->
                        <div class="footer-logo-area text-center">
                            <a href="index.php" class="yummy-logo">Kaya Blog</a>
                        </div>
                        <!-- Menu Area Start -->
                        <nav class="navbar navbar-expand-lg">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#yummyfood-footer-nav" aria-controls="yummyfood-footer-nav" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars" aria-hidden="true"></i> Menu</button>
                            <!-- Menu Area Start -->
                            <div class="collapse navbar-collapse justify-content-center" id="yummyfood-footer-nav">
                                <ul class="navbar-nav">
                                    <?php 
                                        $rez = executeQuery("SELECT * FROM `menu` WHERE `dropdown` = 0");
                                        foreach ($rez as $red):
                                        if($red->position == 1): ?>
                                    <li class="nav-item active">
                                        <a class="nav-link" href="<?= $red->href; ?>"><?= $red->name; ?> <span class="sr-only">(current)</span></a>
                                    </li>
                                    <?php else: ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= $red->href; ?>"><?= $red->name; ?></a>
                                    </li>
                                    <?php endif; endforeach; ?>
            
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Copywrite Text -->
                    <div class="copy_right_text text-center">
                        <p>Copyright @2019 by <a href="https://www.linkedin.com/in/lazar-marojkin-037696182/" target="_blank"> Lazar Marojkin</a></p>
                        <p><a href="data/kaya-documentation-nova.pdf" target="_blank">&nbsp;Dokumentacija</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>