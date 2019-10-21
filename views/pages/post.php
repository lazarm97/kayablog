<?php

include ABSOLUTE_PATH.'/models/post/functions.php';

    if(isset($_GET['id'])){
        $post_id = $_GET['id'];
        $post = getPost($post_id);
        $like_count = likeCount($post_id);
        $comm_count = commCount($post_id);
    }
 
    $brojZaPrikaz = 5;
    $rezPost = getSortedContentLimit($brojZaPrikaz);
    $comment = getCommentsForPost($post_id);    
    ?>
    
    <!-- ****** Breadcumb Area Start ****** -->
    <div class="breadcumb-area" style="background-image: url(assets/img/bg-img/breadcumb.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="bradcumb-title text-center">
                        <h2>Meal Page</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="breadcumb-nav">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Meal Page</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ****** Breadcumb Area End ****** -->
<section class="blog_area section_padding_0_80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="row">
                    <!-- Single Post -->
                    <div class="col-12">
                        <div class="single-post wow fadeInUp" data-wow-delay=".2s">
                            <!-- Post Thumb -->
                            <div class="post-thumb">
                                <img src="<?= $post->contentsrc; ?>" alt="<?= $post->contentalt; ?>">
                            </div>
                            <!-- Post Content -->
                            <div class="post-content">
                                <div class="post-meta d-flex">
                                    <div class="post-author-date-area d-flex">
                                        <!-- Post Author -->
                                        <div class="post-author">
                                            <a href="<?= $post->href; ?>"><?= $post->fullname; ?></a>
                                        </div>
                                        <!-- Post Date -->
                                        <div class="post-date">
                                            <a href="<?= $post->href; ?>"><?= $post->date; ?></a>
                                        </div>
                                    </div>
                                    <!-- Post Comment & Share Area -->
                                    <div class="post-comment-share-area d-flex">
                                        <!-- Post Favourite -->
                                        <div class="post-favourite">
                                            <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i> <?= $like_count; ?></a>
                                        </div>
                                        <!-- Post Comments -->
                                        <div class="post-comments">
                                            <a href="#"><i class="fa fa-comment-o" aria-hidden="true"></i> <?= $comm_count; ?></a>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?= $post->href; ?>">
                                    <h2 class="post-headline"><?= $post->headline; ?></h2>
                                </a>
                                <p><?= $post->fullcontent; ?></p>
                                <h2>Comments</h2>
                                <?php if($comment): foreach ($comment as $oneComm): ?>
                                 
                                <div class="post-author-date-area d-flex">
                                    <!-- Post Author -->
                                    <div class="post-author">
                                        <a href="<?= "#" ?>"><?= $oneComm->fname." ".$oneComm->lname; ?></a>
                                    </div>
                                    <!-- Post Date -->
                                    <div class="post-date">
                                        <a href="<?= "#" ?>"><?= $oneComm->date; ?></a>
                                    </div>
                                </div>
                                <div class="comment">
                                    <p><?= $oneComm->text; ?><p>
                                </div>
                                <hr style="width:100%; color:black;">
                                <?php endforeach; endif; ?>
                                <!-- Comment Form -->
                                <?php if(isset($_SESSION['User'])): ?>
                            <form action="models/post/comment/addComment.php?id=<?= $post_id; ?>" method="post">
                                <div class="form-group">
                                    <textarea class="form-control" name="txtComment" id="comment" cols="30" rows="10" placeholder="Comment..."></textarea>
                                </div>
                                <button type="submit" name="btnComment" class="btn contact-btn">Comment</button>
                            </form>
                                <?php endif; ?>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            
                        <!-- ****** Blog Sidebar ****** -->
                <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                    <div class="blog-sidebar mt-5 mt-lg-0">
                        <!-- Single Widget Area -->
                        <div class="single-widget-area about-me-widget text-center">
                            <div class="widget-title">
                                <h6>About Author</h6>
                            </div>
                            <div class="about-me-widget-thumb">
                                <img src="<?= $post->authorsrc; ?>" alt="<?= $post->authoralt; ?>">
                            </div>
                            <h4 class="font-shadow-into-light"><?= $post->fullname; ?></h4>
                            <p><?= $post->description; ?></p>
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
                                <img src="<?= $post->velika_slika; ?>" alt="<?= $post->alt; ?>">
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
