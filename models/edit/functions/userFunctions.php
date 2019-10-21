<?php

function uDeleteUser($id){
    global $conn;
    $upit = "DELETE FROM `users` WHERE `users`.`id` = ?";
    $rez = $conn->prepare($upit);
    if($rez->execute($id)) return 1;
    else return 0;
}

function uUpdateUser($queryParams){
    global $conn;
    $upit = "UPDATE `users` SET `fname` = ?, `lname` = ? , `password` = ? WHERE `users`.`id` = ?;";
    $rez = $conn->prepare($upit);
    if($rez->execute($queryParams)) return 1;
    else return 0;
}