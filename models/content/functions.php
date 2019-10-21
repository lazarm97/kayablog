<?php

function getAllContent(){
    $upit = "SELECT con.id,con.alt as contentalt,con.comm_count,con.content,con.date,con.headline,con.href,con.like_count,con.position,con.velika_slika as contentsrc,aut.fullname,aut.description,aut.src as authorsrc,aut.alt as authoralt FROM `content` as con inner join author as aut on con.author_id = aut.id";
    return executeQuery($upit);
}

function getSortedContentLimit($brojZaPrikaz){
    $upit = "SELECT * FROM content ORDER BY like_count DESC,comm_count DESC,date DESC LIMIT ".$brojZaPrikaz.";";
    return executeQuery($upit);
}

function getLiked(){
    $upit = "SELECT content_id,COUNT(DISTINCT user_id) as like_count FROM spojna WHERE liked=1 GROUP BY content_id;";
    return executeQuery($upit);
}

function getComment(){
    $upit = "SELECT content_id,COUNT(comm_id) as comm_count FROM spojna where comm_id <> 1 group by content_id;";
    return executeQuery($upit);
}

function likeCount($rez,$like){
    foreach($rez as $red) {
        foreach ($like as $red1) {
            if($red->id==$red1->content_id){
                $red->like_count = $red1->like_count;
                break;}
            else
                $red->like_count = 0;
        }
    }
}

function commentCount($rez,$comments){
    foreach($rez as $red) {
        foreach ($comments as $comment) {
            if($red->id==$comment->content_id){
                $red->comm_count = $comment->comm_count;
                break;}
            else
                $red->comm_count = 0;
        }
    }
}