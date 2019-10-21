<?php

function addComment($postId,$userId,$comment){
    require_once '../../../config/connection.php';
    // global $conn;
    // var_dump($conn);
    if(!empty($comment)){
        $upit = "INSERT INTO `comment` VALUES (NULL, ?, CURRENT_TIMESTAMP);";
        $rez = $conn->prepare($upit);
        if($rez->execute([$comment])){
            $id_comm = $conn->lastInsertId();
            $upitLike = "SELECT * FROM `spojna` WHERE `content_id`=? AND `user_id`=? GROUP BY `content_id`";
            $newRez = $conn->prepare($upitLike);
            $newRez->execute([$postId,$userId]);
            // $newRez->fetch();
            // var_dump($newRez);
            if($newRez->rowCount()>0) { $newRez = $newRez->fetch(); var_dump($newRez); $id_like = $newRez->liked;}
            else $id_like = 2;
            $upitSpojna = "INSERT INTO `spojna` VALUES (?,?,?,?);";
            $insertSpojna = $conn->prepare($upitSpojna);
            $parametri = [$postId,$id_like,$id_comm,$userId];
            if($insertSpojna->execute($parametri))  header('Location: ../../../index.php?currentpage=post&id='.$postId);
        }
    }else header('Location: ../../../index.php?currentpage=post&id='.$postId);
}

function getPost($postId){
    global $conn;
    $upit = "SELECT con.fullcontent,con.id,con.alt as contentalt,con.comm_count,con.content,con.date,con.headline,con.href,con.like_count,con.position,con.velika_slika as contentsrc,aut.fullname,aut.description,aut.src as authorsrc,aut.alt as authoralt FROM `content` as con inner join author as aut on con.author_id = aut.id WHERE con.id=?";
    $rez = $conn->prepare($upit);
    $rez->execute([$postId]);
    return $rez->fetch();
}

function likeCount($postId){
    global $conn;
    $upit = "SELECT COUNT(DISTINCT user_id) as like_count FROM spojna WHERE liked=1 AND content_id = ?;";
    $rez = $conn->prepare($upit);
    if($rez->execute([$postId])) return $rez->fetch()->like_count;
    else return 0;
}

function commCount($postId){
    global $conn;
    $upit = "SELECT COUNT(comm_id) as comm_count FROM spojna WHERE content_id = ?;";
    $rez = $conn->prepare($upit);
    if($rez->execute([$postId])) return $rez->fetch()->comm_count;
    else return 0;
}

function getCommentsForPost($postId){
    global $conn;
    $upit = "SELECT usr.fname,usr.lname,comm.text,comm.date FROM `comment` as comm inner join spojna as spoj on comm.id=spoj.comm_id inner join users as usr on spoj.user_id=usr.id WHERE spoj.content_id = ? order by comm.date desc;";
    $rez = $conn->prepare($upit);
    if($rez->execute([$postId])) return $rez->fetchAll();
    else return 0;
}

function getSortedContentLimit($brojZaPrikaz){
    $upit = "SELECT * FROM content ORDER BY like_count DESC,comm_count DESC,date DESC LIMIT ".$brojZaPrikaz.";";
    return executeQuery($upit);
}