<?php
    ob_start();
    session_start();
    // konekcija sa bazom
    include('config/connection.php');
    // ucitavanje head 
    include('views/fixed/header.php');
    // ucitavanje preload sa pocetkom bodija
    include('views/fixed/preload.php');
    // ****** Top Header Area Start ******
    include('views/fixed/soclog.php');
    // ****** Top Header Area End ****** 
    // ****** Header Area with menu Start ******
    include('views/fixed/menu.php');
    // ****** Header Area with menu End ******



    if(isset($_GET['currentpage'])){
        switch($_GET['currentpage']){
            case 'home':
                include 'views/pages/home.php';
                break;
            case 'archive':
                include 'views/pages/archive/paginationAndContent.php';
                break;
            case 'contact':
                include 'views/pages/contact/contactcont.php';
                break;    
            case 'post':
                include 'views/pages/post.php';
                break;   
            case 'login-register':
                include 'views/pages/login.php';
                break; 
            case '404':
                include 'views/pages/404.php';
                break; 
            case '403':
                include 'views/pages/403.php';
                break; 
            default:
                include "views/pages/404.php";
                break;
        }
    }else{
        include 'views/pages/home.php';
    }

    // ****** Instagram Area Start ******
    include('views/fixed/gallery2.php');
    // ****** Our Creative Portfolio Area End ******
    // ****** Footer Social Icon Area Start ******
    include('views/fixed/footersocicons.php');
    // ****** Footer Social Icon Area End *****
    // ****** Footer Menu Area Start ******
    include('views/fixed/footer.php');
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
    <?php
    if(isset($_GET['currentpage'])){
        switch($_GET['currentpage']){
            case 'contact':?>
                <script src="assets/js/contact-vote.js"></script>
                <?php
                break;
            case 'archive':?>
                <script src="assets/js/pagination.js"></script>
                <?php
                break;
        }
    }
    ?>
</body>
</html>