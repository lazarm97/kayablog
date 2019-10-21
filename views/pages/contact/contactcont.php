        <?php
          
            include ABSOLUTE_PATH.'/models/contact/functions.php';
            $br = (isset($_SESSION['User'])) ? brojOdgovora($_SESSION['User']->id) : 0;
        ?>
        <input type="hidden" id="brojOdgovora" value="<?= $br ?>"/>
   <!-- ****** Contatc Area Start ****** -->
   <div class="contact-area section_padding_80">
        <div class="container">
            <!-- Contact Form  -->
            <div class="contact-form-area">
                <div class="row">
                    <div class="col-12 col-md-5">
                        <div class="contact-form-sidebar item wow fadeInUpBig" data-wow-delay="0.3s" style="background-image: url(assets/img/bg-img/contact.jpg);">
                        </div>
                    </div>
                    <div class="col-12 col-md-7 item">
                        <div class="contact-form wow fadeInUpBig" data-wow-delay="0.6s">
                            <h2 class="contact-form-title mb-30">If You Have Any Question Contact Me Today !</h2>
                            <!-- Contact Form -->
                            <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="contact-name" name="contact-name" placeholder="Full Name" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" id="contact-email" name="contact-email" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" id="message" name="contact-message" cols="30" rows="30" placeholder="Message" required></textarea>
                                </div>
                                <button type="button" class="btn contact-btn" name="contact-btn" id="contact-btn">Send Message</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if(isset($_SESSION['User'])): ?>
    <input type="hidden" id="isUserSet" value="1"/>
    <input type="hidden" id="userId" value="<?=$_SESSION['User']->id?>"/>
    <div class="contact-area section_padding_80">
        <div class="container">
            <!-- Contact Form  -->
            <div class="contact-form-area">
                <div class="row">
                    <div class="col-12 col-md-5">
                        <div class="contact-form wow fadeInUpBig" data-wow-delay="0.6s">
                            <div id="anketa">    
                                <h2 class="contact-form-title mb-30">Anketa !</h2>
                                <!-- Contact Form -->
                                <form action="#" method="POST">
                                <div class="custom-control custom-radio">
                                    <input type="radio" value="1" id="vote1" name="customRadio">
                                    <label class="custom-control-label" for="customRadio1">Bad</label>
                                </div>
                                <br>
                                <div class="custom-control custom-radio">
                                    <input type="radio" value="2" id="vote2" name="customRadio">
                                    <label class="custom-control-label" for="customRadio2">Medium</label>
                                </div>
                                <br>
                                <div class="custom-control custom-radio">
                                    <input type="radio" value="3" id="vote3" name="customRadio">
                                    <label class="custom-control-label" for="customRadio1">Good</label>
                                </div>
                                <br>
                                <div class="custom-control custom-radio">
                                    <input type="radio" value="4" id="vote4" name="customRadio">
                                    <label class="custom-control-label" for="customRadio2">Perfect</label>
                                </div>
                                <br>
                                <button type="button" class="btn contact-btn" id="voteBtn" name="voteBtn">Vote</button>
                                </form>
                            </div>
                            <div id="statistika">
                                <table class="table table-bordered table-dark">
                                    <thead>
                                        <tr>
                                            <th scope="row" colspan="4">Statistics</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Bad</th>
                                            <td colspan="2" id="bad"></td>
                                            <td colspan="1" id="badP"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Medium</th>
                                            <td colspan="2" id="medium"></td>
                                            <td colspan="1" id="mediumP"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Good</th>
                                            <td colspan="2" id="good"></td>
                                            <td colspan="1" id="goodP"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Perfect</th>
                                            <td colspan="2" id="perfect"></td>
                                            <td colspan="1" id="perfectP"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-7 item">
                    <div class="contact-form-sidebar item wow fadeInUpBig" data-wow-delay="0.3s" style="background-image: url(assets/img/bg-img/contact.jpg);">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php else: ?>
    <input type="hidden" id="isUserSet" value="0"/>
    <?php endif; ?>
    <!-- ****** Contact Area End ****** -->
  