<?php

@include '../../config/connection.php';
if(isset($_POST['radnja']) and $_POST['radnja']==="getCategory"){
    $idCat = $_POST['id'];
    $idPage = $_POST['page'];
    $upit = ($idCat!="") ? categoryIdUpit(intval($idCat)) : categoryUpit();
    $like = getLike();
    $comm = getComment();
    $number_of_results = ($idCat!="") ? rowCountId(intval($idCat)) : countRow();
    $results_per_page = 6;
    $number_of_pages = ceil($number_of_results/$results_per_page);
    $page = ($idPage=="") ? 1 : intval($idPage);
    $current_page = $page;
    $this_page_first_result = ($page-1)*$results_per_page;
    $sql = $upit . ' limit ' . $this_page_first_result . ',' . $results_per_page;
    $rez = executeQuery($sql);
    foreach($rez as $red) {
        if($like){
            foreach ($like as $red1) {
                if($red->id==$red1->content_id){
                    $red->like_count = $red1->like_count;
                    break;}
                else
                    $red->like_count = 0;
            }
        }else
            $red->like_count = 0;
    }
    foreach($rez as $red) {
        if($comm){
            foreach ($comm as $comm1) {
                if($red->id==$comm1->content_id){
                    $red->comm_count = $comm1->comm_count;
                    break;}
                else
                    $red->comm_count = 0;
            }
        }else
            $red->comm_count = 0;
    }
    echo json_encode($rez);
}

function getCategoryId($id){
    global $conn;
    $upit = "SELECT con.id,con.velika_slika,con.alt,con.href,con.date,con.like_count,con.comm_count,con.headline,aut.fullname FROM `content` as con inner join author as aut on con.author_id=aut.id WHERE category_id = ?";
    $rez = $conn->prepare($upit);
    $rez->execute([$id]);
    return $rez->rowCount();
}

function getCategory(){
    global $conn;
    $upit = "SELECT con.id,con.velika_slika,con.alt,con.href,con.date,con.like_count,con.comm_count,con.headline,aut.fullname FROM `content` as con inner join author as aut on con.author_id=aut.id";
    return $conn->query($upit);
}

function getLike(){
    global $conn;
    $upit = "SELECT content_id,COUNT(DISTINCT user_id) as like_count FROM spojna WHERE liked=1 GROUP BY content_id;";
    return executeQuery($upit);
}

function getComment(){
    global $conn;
    $upit = "SELECT content_id,COUNT(comm_id) as comm_count FROM spojna GROUP BY content_id;";
    return executeQuery($upit);
}
function rowCountId($id){
    $broj = getCategoryId($id);
    return $broj;
}
function countRow(){
    $broj = getCategory()->rowCount();
    return $broj;
}

function categoryIdUpit($id){
    $upit = "SELECT con.id,con.velika_slika,con.alt,con.href,con.date,con.like_count,con.comm_count,con.headline,aut.fullname FROM `content` as con inner join author as aut on con.author_id=aut.id WHERE category_id = ".$id;
    return $upit;
}

function categoryUpit(){
    $upit = "SELECT con.id,con.velika_slika,con.alt,con.href,con.date,con.like_count,con.comm_count,con.headline,aut.fullname FROM `content` as con inner join author as aut on con.author_id=aut.id";
    return $upit;
}



