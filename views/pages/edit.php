<?php session_start();
    if(isset($_SESSION['User'])):
    include '../../config/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="../../assets/img/core-img/favicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Edit</title>
</head>
<body>
    <a class="btn btn-success" href="../../index.php" role="button">Home</a>
    <a class="btn btn-success" href="../../models/export/authorToWord.php" role="button">Export informations of author</a>
    <?php 
    if($_SESSION['User']->function_id == 1) include('user/admin.php'); 
    if($_SESSION['User']->function_id == 2) include('user/user.php'); 
    ?>
<!-- Popper js -->
<script src="../../assets/js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap-4 js -->
<script src="../../assets/js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins JS -->
<script src="../../assets/js/others/plugins.js"></script>
    <!-- Active JS -->
<script src="../../assets/js/active.js"></script>
</body>
</html>
    <?php else:echo "zabranjen pristup preko url adrese!"; endif; ?>