<?php
    session_start();
    // konekcija sa bazom
    require_once('konekcija.php');
    // ucitavanje head 
    require_once('header.php');
    // ucitavanje preload sa pocetkom bodija
    require_once('preload.php');
    // ****** Top Header Area Start ******
    require_once('soclog.php');
    // ****** Top Header Area End ****** 
    // ****** Header Area with menu Start ******
    require_once('menu.php');



    // ****** Header Area with menu End ******
    require_once('contactcont.php');
    // ****** Instagram Area Start ******






    
    require_once('gallery2.php');
    // ****** Our Creative Portfolio Area End ******
    // ****** Footer Social Icon Area Start ******
    require_once('footersocicons.php');
    // ****** Footer Social Icon Area End *****
    // ****** Footer Menu Area Start ******
    require_once('footer.php');
?>


    

   

    <!-- Jquery-2.2.4 js -->
    <script src="assets/js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="assets/js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap-4 js -->
    <script src="assets/js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins JS -->
    <script src="assets/js/others/plugins.js"></script>
    <!-- Active JS -->
    <script src="assets/js/active.js"></script>
    
</body>
</html>