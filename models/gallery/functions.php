<?php

function commCount($rez,$comments){
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