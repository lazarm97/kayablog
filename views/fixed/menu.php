
<header class="header_area">
        <div class="container">
            <div class="row">
                <!-- Logo Area Start -->
                <div class="col-12">
                    <div class="logo_area text-center">
                        <a href="index.php" class="yummy-logo">Kaya Blog</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#yummyfood-nav" aria-controls="yummyfood-nav" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars" aria-hidden="true"></i> Menu</button>
                        <!-- Menu Area Start -->
                        <div class="collapse navbar-collapse justify-content-center" id="yummyfood-nav">
                            <ul class="navbar-nav" id="yummy-nav">
                                <?php $rez = executeQuery("SELECT * FROM menu ORDER BY `position`,`dropdown`");
                                    foreach ($rez as $red):
                                        if($red->dropdown == 0){
                                            if($red->position == 1){
                                                echo "<li class='nav-item'><a class='nav-link' href='$red->href'>$red->name<span class='sr-only'>(current)</span></a></li>";
                                            }else
                                                echo "<li class='nav-item'><a class='nav-link' href='$red->href'>$red->name</a></li>";
                                        }else if($red->dropdown == 1){
                                            echo "<li class='nav-item dropdown'><a class='nav-link dropdown-toggle' href='$red->href' id='yummyDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>$red->name</a>";
                                            echo "<div class='dropdown-menu' aria-labelledby='yummyDropdown'>";
                                            foreach ($rez as $dropdown) {
                                                if($dropdown->dropdown == 2){
                                                    echo "<a class='dropdown-item' href='$dropdown->href'>$dropdown->name</a>";
                                                }
                                            }
                                            echo "</div></li>";
                                        }
                                    endforeach;
                                ?>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>