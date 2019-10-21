<?php
    session_start();
if(isset($_SESSION['User'])){
    include '../../config/connection.php';
    zabeleziOdjavu($_SESSION['User']->id);
    unset($_SESSION['User']);
    session_destroy();
    header("Location: ../../index.php");
}
?>