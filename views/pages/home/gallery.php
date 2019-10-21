<?php
    include ABSOLUTE_PATH.'/models/gallery/functions.php';
    $rez = executeQuery("SELECT * FROM content;");
    $comments = executeQuery("SELECT content_id,COUNT(comm_id) as comm_count FROM spojna where comm_id <> 1 group by content_id;");
    commCount($rez,$comments);
?>


<section class="welcome-post-sliders owl-carousel">
    <?php
        if($rez):
            foreach($rez as $red) {
                echo " <!-- Single Slide -->
                <div class='welcome-single-slide'>
                    <!-- Post Thumb -->
                    <img src='$red->velika_slika' alt='$red->alt'>
                    <!-- Overlay Text -->
                    <div class='project_title'>
                        <div class='post-date-commnents d-flex'>
                            <a href='$red->href'>$red->date</a>
                            <a href='$red->href'>$red->comm_count Comment</a>
                        </div>
                        <a href='$red->href'>
                            <h5>$red->headline</h5>
                        </a>
                    </div>
                </div>";
            }
        endif;
    ?>
</section>