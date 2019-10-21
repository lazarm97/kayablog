

<div class="top_header_area">
        <div class="container">
            <div class="row">
                <div class="col-4 col-sm-4">
                    <!--  Top Social bar start -->
                    <div class="top_social_bar">
                        <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-skype" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="col-4 col-sm-4">
                    <!--  Admin/user setup -->
                    <div id="setup" class="align-items-center justify-content-center text-center">
                        <?php if(isset($_SESSION['User'])): ?>
                        <a href="views/pages/edit.php"><?= $_SESSION['User']->fname." ".$_SESSION['User']->lname; ?> <i class="fa fa-cog" aria-hidden="true"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
                <!--  Login Register Area -->
                <div class="col-4 col-sm-4">
                    <div class="signup-search-area d-flex align-items-center justify-content-end">
                        <div class="login_register_area d-flex">
                            <?php if(!isset($_SESSION['User'])): ?>
                            <div class="login">
                                <a href="index.php?currentpage=login-register">Sing in</a>
                            </div>
                            <div class="register">
                                <a href="index.php?currentpage=login-register">Sing up</a>
                            </div>
                            <?php endif; ?>
                            <?php if(isset($_SESSION['User'])): ?>
                            <div class="register">
                                <a href="models/log_reg/logout.php">Logout</a>
                            </div>
                            <?php endif; ?>
                        </div>
                        <!-- Search Button Area -->
                        
                        <div class="search_button">
                            <a class="searchBtn" href="#"><i class="fa fa-search" aria-hidden="true"></i></a>
                        </div>
                        <!-- Search Form -->
                        <div class="search-hidden-form">
                            <form action="#" method="get">
                                <input type="search" name="search" id="search-anything" placeholder="Search Anything...">
                                <input type="submit" value="" class="d-none">
                                <span class="searchBtn"><i class="fa fa-times" aria-hidden="true"></i></span>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>