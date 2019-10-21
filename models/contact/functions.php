<?php

function brojOdgovora($userId){
    global $conn;
    $upit = "SELECT * FROM answers where user_id = ?";
    $rez = $conn->prepare($upit);
    $broj = $rez->execute([$userId]);
    return $rez->rowCount();
}