<?php

include '../../config/connection.php';

function aGetUser($userId){
    global $conn;
    $upit = "SELECT * FROM users where id = ?";
    $user = $conn->prepare($upit);
    $user->execute($userId);
    return $user->fetch();
}

function aGetContent($contentId){
    global $conn;
    $upit = "SELECT con.alt,con.author_id,con.content,con.date,con.fullcontent,con.headline, con.href, con.position,con.mala_slika,con.velika_slika,con.category_id FROM content as con inner join author on con.author_id=author.id where con.id = ?";
    $content = $conn->prepare($upit);
    $content->bindParam(1, $contentId);
    $content->execute();
    return $content->fetch();
}

function aInsertUser($queryParams){
    global $conn;
    $upitnici = "null";
    $brojUpitnika = count($queryParams);
    while($brojUpitnika>0){
        $upitnici.= ' ?';
        $brojUpitnika--;
    }
    $upitniciNiz = explode(" ", trim($upitnici));
    $upit = "INSERT INTO users VALUES (".implode(',',$upitniciNiz).");";
    $rez = $conn->prepare($upit);
    if($rez->execute($queryParams)) return 1;
    else return 0;
}

function aUpdateUser($queryParams){
    global $conn;
    $upit = "UPDATE `users` SET `fname` = ?, `lname` = ?, `email` = ?, `password` = ?, `function_id` = ? WHERE `users`.`id` = ?;";
    $rez = $conn->prepare($upit);
    if($rez->execute($queryParams)) return 1;
    else return 0;
}

function aDeleteUser($userId){
    global $conn;
    $upit = "DELETE FROM `users` WHERE `users`.`id` = ?";
    $rez = $conn->prepare($upit);
    if($rez->execute($userId)) return 1;
    else return 0;
}

function aInsertContent($queryParams,$orgSlika){
    global $conn;
    $tmp_putanjaMala = ABSOLUTE_PATH.'/assets/img/tmp/mala_'.$orgSlika;
    $tmp_putanjaOrg = ABSOLUTE_PATH.'/assets/img/tmp/org_'.$orgSlika;
    $malaSlika = ABSOLUTE_PATH.'/assets/img/blog-img/male_slike/mala_'.$orgSlika;
    $novaPutanjaOrg = ABSOLUTE_PATH.'/assets/img/blog-img/originalne_slike/org_'.$orgSlika;
    rename($tmp_putanjaMala,$malaSlika);
    rename($tmp_putanjaOrg,$novaPutanjaOrg);
    $upit = "INSERT INTO `content` (`id`, `href`, `alt`, `date`, `headline`, `content`, `like_count`, `comm_count`, `fullcontent`, `position`, `category_id`, `author_id`) VALUES (NULL, '#', ?, ?, ?, ?,'0', '0', ?, ?, ?, ?);";
    $rez = $conn->prepare($upit);
    if($rez->execute($queryParams)){
        $cont_last_id = $conn->lastInsertId();
        $putanjaMala = 'assets/img/blog-img/male_slike/mala_'.$orgSlika;
        $putanjaOrg = 'assets/img/blog-img/originalne_slike/org_'.$orgSlika;
        $upit = 'UPDATE content SET href = "index.php?currentpage=post&id="?, velika_slika =?, mala_slika=? where id=?;';
        $parametar = [$cont_last_id,$putanjaOrg,$putanjaMala,$cont_last_id];
        $rezUpdate = $conn->prepare($upit);
        if($rezUpdate->execute($parametar)) return 1;
        else return 0;
    }
}

function aDeleteContent($contentId){
    global $conn;
    $upit = "DELETE FROM `content` WHERE `id` = ?";
    $rez = $conn->prepare($upit);
    if($rez->execute($contentId)) return 1;
    else return 0;
}

function aUpdateContent($queryParams,$mala,$velika){
    global $conn;
    if(!file_exists(ABSOLUTE_PATH.'/'.$mala)):
        $mala_tmp = str_replace("blog-img/male_slike/","tmp/",$mala);
        $velika_tmp = str_replace("blog-img/originalne_slike/","tmp/",$velika);
        $tmp_putanjaMala = ABSOLUTE_PATH.'/'.$mala_tmp;
        $tmp_putanjaOrg = ABSOLUTE_PATH.'/'.$velika_tmp;
        rename($tmp_putanjaMala,ABSOLUTE_PATH.'/'.$mala);
        rename($tmp_putanjaOrg,ABSOLUTE_PATH.'/'.$velika);
    endif;    
    $upit = "UPDATE content SET alt=?, velika_slika=?, mala_slika=?, date=?, headline=?, content=?, fullcontent=?, position=?, category_id=?, author_id=? WHERE id=?;";
    $rez = $conn->prepare($upit);
    if($rez->execute($queryParams)) return 1;
    else return 0;
}

function aGetMessages($sel){
    global $conn;
    $upit = "SELECT * FROM messages where id = ?";
    $rez = $conn->prepare($upit);
    if($rez->execute($sel)) return $rez->fetch(PDO::FETCH_ASSOC); 
    else return 0;
}