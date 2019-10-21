<?php
    include ABSOLUTE_PATH.'/models/content/functions.php';
    $rez = getAllContent();
    $brojZaPrikaz = 5;
    $rezPost = getSortedContentLimit($brojZaPrikaz);
    $like = getLiked();
    $comments = getComment();
    likeCount($rez,$like);
    commentCount($rez,$comments);
?>


<section class="blog_area section_padding_0_80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="row">

                        <?php foreach ($rez as $red):  if($red->position == 1):?>
                        
                        <!-- Single Post -->
                        <div class="col-12">
                            <div class="single-post wow fadeInUp" data-wow-delay=".2s">
                                <!-- Post Thumb -->
                                <div class="post-thumb">
                                    <img src="<?= $red->contentsrc; ?>" alt="<?= $red->contentalt; ?>">
                                </div>
                                <!-- Post Content -->
                                <div class="post-content">
                                    <div class="post-meta d-flex">
                                        <div class="post-author-date-area d-flex">
                                            <!-- Post Author -->
                                            <div class="post-author">
                                                <a href="<?= $red->href; ?>"><?= $red->fullname; ?></a>
                                            </div>
                                            <!-- Post Date -->
                                            <div class="post-date">
                                                <a href="<?= $red->href; ?>"><?= $red->date; ?></a>
                                            </div>
                                        </div>
                                        <!-- Post Comment & Share Area -->
                                        <div class="post-comment-share-area d-flex">
                                            <!-- Post Favourite -->
                                            <div class="post-favourite">
                                                <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i> <?= $red->like_count; ?></a>
                                            </div>
                                            <!-- Post Comments -->
                                            <div class="post-comments">
                                                <a href="#"><i class="fa fa-comment-o" aria-hidden="true"></i> <?= $red->comm_count; ?></a>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="<?= $red->href; ?>">
                                        <h2 class="post-headline"><?= $red->headline; ?></h2>
                                    </a>
                                    <p><?= $red->content; ?></p>
                                    <a href="<?= $red->href; ?>" class="read-more">Continue Reading..</a>
                                </div>
                            </div>
                        </div>
                        <?php $br=4; elseif($red->position == 2):  ?>

                        <!-- Single Post -->
                        <div class="col-12 col-md-6">
                            <div class="single-post wow fadeInUp" data-wow-delay=".<?= $br; ?>s">
                                <!-- Post Thumb -->
                                <div class="post-thumb">
                                    <img src="<?= $red->contentsrc; ?>" alt="<?= $red->contentalt; ?>">
                                </div>
                                <!-- Post Content -->
                                <div class="post-content">
                                    <div class="post-meta d-flex">
                                        <div class="post-author-date-area d-flex">
                                            <!-- Post Author -->
                                            <div class="post-author">
                                                <a href="<?= $red->href; ?>"><?= $red->fullname; ?></a>
                                            </div>
                                            <!-- Post Date -->
                                            <div class="post-date">
                                                <a href="<?= $red->href; ?>"><?= $red->date; ?></a>
                                            </div>
                                        </div>
                                        <!-- Post Comment & Share Area -->
                                        <div class="post-comment-share-area d-flex">
                                            <!-- Post Favourite -->
                                            <div class="post-favourite">
                                                <a href="<?= $red->href; ?>"><i class="fa fa-heart-o" aria-hidden="true"></i> <?= $red->like_count; ?></a>
                                            </div>
                                            <!-- Post Comments -->
                                            <div class="post-comments">
                                                <a href="<?= $red->href; ?>"><i class="fa fa-comment-o" aria-hidden="true"></i> <?= $red->comm_count; ?></a>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="<?= $red->href; ?>">
                                        <h4 class="post-headline"><?= $red->headline; ?></h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php if($br == 8) $br=1; $br+=2; else: $br2 = 2;?>
                        

                        <!-- ******* List Blog Area Start ******* -->

                        <!-- Single Post -->
                        <div class="col-12">
                            <div class="list-blog single-post d-sm-flex wow fadeInUpBig" data-wow-delay=".<?= $br2; ?>s">
                                <!-- Post Thumb -->
                                <div class="post-thumb">
                                    <img src="<?= $red->contentsrc; ?>" alt="<?= $red->contentalt; ?>">
                                </div>
                                <!-- Post Content -->
                                <div class="post-content">
                                    <div class="post-meta d-flex">
                                        <div class="post-author-date-area d-flex">
                                            <!-- Post Author -->
                                            <div class="post-author">
                                                <a href="<?= $red->href; ?>"><?= $red->fullname; ?></a>
                                            </div>
                                            <!-- Post Date -->
                                            <div class="post-date">
                                                <a href="<?= $red->href; ?>"><?= $red->date; ?></a>
                                            </div>
                                        </div>
                                        <!-- Post Comment & Share Area -->
                                        <div class="post-comment-share-area d-flex">
                                            <!-- Post Favourite -->
                                            <div class="post-favourite">
                                                <a href="<?= $red->href; ?>"><i class="fa fa-heart-o" aria-hidden="true"></i> <?= $red->like_count; ?></a>
                                            </div>
                                            <!-- Post Comments -->
                                            <div class="post-comments">
                                                <a href="<?= $red->href; ?>"><i class="fa fa-comment-o" aria-hidden="true"></i> <?= $red->comm_count; ?></a>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="<?= $red->href; ?>">
                                        <h4 class="post-headline"><?= $red->headline; ?></h4>
                                    </a>
                                    <p><?= $red->content; ?></p>
                                    <a href="<?= $red->href; ?>" class="read-more">Continue Reading..</a>
                                </div>
                            </div>
                        </div>
                        <?php if($br2 == 8) $br2=1; $br2+=2; endif; endforeach; ?>
                    </div>
                </div>
                
                
                <!-- ****** Blog Sidebar ****** -->
                <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                    <div class="blog-sidebar mt-5 mt-lg-0">
                        <!-- Single Widget Area -->
                        <div class="single-widget-area about-me-widget text-center">
                            <div class="widget-title">
                                <h6>About Me</h6>
                            </div>
                            <div class="about-me-widget-thumb">
                                <img src="<?= $red->authorsrc; ?>" alt="<?= $red->authoralt; ?>">
                            </div>
                            <h4 class="font-shadow-into-light"><?= $red->fullname; ?></h4>
                            <p><?= $red->description; ?></p>
                        </div>

                        <!-- Single Widget Area -->
                        <div class="single-widget-area subscribe_widget text-center">
                            <div class="widget-title">
                                <h6>Subscribe &amp; Follow</h6>
                            </div>
                            <div class="subscribe-link">
                                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-google" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-vimeo" aria-hidden="true"></i></a>
                            </div>
                        </div>

                        <!-- Single Widget Area -->
                        <div class="single-widget-area popular-post-widget">
                            <div class="widget-title text-center">
                                <h6>Populer Post</h6>
                            </div>
                            <?php foreach($rezPost as $post): ?>
                            <!-- Single Popular Post -->
                            <div class="single-populer-post d-flex">
                                <img src="<?= $post->mala_slika; ?>" alt="<?= $post->alt; ?>">
                                <div class="post-content">
                                    <a href="<?= $post->href; ?>">
                                        <h6><?= $post->headline; ?></h6>
                                    </a>
                                    <p><?= $post->date; ?></p>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="single-widget-area newsletter-widget">
                            <div class="widget-title text-center">
                                <h6>Newsletter</h6>
                            </div>
                            <p>Subscribe our newsletter gor get notification about new updates, information discount, etc.</p>
                            <div class="newsletter-form">
                                <form action="#" method="post">
                                    <input type="email" name="newsletter-email" id="email" placeholder="Your email">
                                    <button type="submit"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>