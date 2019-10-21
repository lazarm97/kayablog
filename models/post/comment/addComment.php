<?php

include '../functions.php';


session_start();
addComment($_GET['id'],$_SESSION['User']->id,$_POST['txtComment']);

