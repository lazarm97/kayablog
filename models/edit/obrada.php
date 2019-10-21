<?php

include 'functions/functions.php';
include 'functions/adminFunctions.php';
include 'functions/userFunctions.php';

if(isset($_POST['radnja']) && $_POST['radnja']==='AgetUser'){
    $user = aGetUser([$_POST['user_id']]);
    echo json_encode($user); 
}elseif(isset($_POST['radnja']) && $_POST['radnja']==='AgetContent'){
    $content = aGetContent(intval($_POST['content_id']));
    // $content = aGetContent(123);
    echo json_encode($content); 
}elseif(isset($_POST['radnja']) && $_POST['radnja']==='AinsertUser'){
    $parametri = [$_POST['userFname'],$_POST['userLname'],$_POST['userEmail'],MD5($_POST['userPass']),$_POST['userFunction']];
    $uspeh = aInsertUser($parametri);
    if($uspeh==1) http_response_code(201);
    else {upisiGresku("Greska prilikom dodavanja korisnika!"); http_response_code(500);}
}elseif(isset($_POST['radnja']) && $_POST['radnja']==='AupdateUser'){
    $parametri = [$_POST['userFname'],$_POST['userLname'],$_POST['userEmail'],MD5($_POST['userPass']),$_POST['userFunction'],$_POST['userId']];
    $uspeh = aUpdateUser($parametri);
    if($uspeh==1) http_response_code(204);
    else {upisiGresku("Greska prilikom azuriranja korisnika!"); http_response_code(500);}
}elseif(isset($_POST['radnja']) && $_POST['radnja']==='AdeleteUser'){
    $uspeh = aDeleteUser([$_POST['userId']]);
    if($uspeh==1) http_response_code(204);
    else {upisiGresku("Greska prilikom brisanja korisnika!"); http_response_code(500);}
}elseif(isset($_POST['radnja']) && $_POST['radnja']==='AinsertContent'){
    $parametri = [$_POST['contentAlt'],date('Y-m-d',strtotime($_POST['contentDate'])),$_POST['contentHeadline'],$_POST['contentCont'],$_POST['contentFullCont'],intval($_POST['contentPosition']),intval($_POST['contentCategory']),intval($_POST['contentAuthor'])];
    $uspeh = aInsertContent($parametri,$_POST['contentSrc']);
    if($uspeh==1) http_response_code(201);
    else {upisiGresku("Greska prilikom dodavanja sadrzanja!"); http_response_code(500);}
}elseif(isset($_POST['radnja']) && $_POST['radnja']==='AdeleteContent'){
    $uspeh = aDeleteContent([$_POST['contentId']]);
    if($uspeh == 1) http_response_code(204);
    else {upisiGresku("Greska prilikom brisanja sadrzaja!"); http_response_code(500);}
}elseif(isset($_POST['radnja']) && $_POST['radnja']==='AupdateContent'){
    $parametri = [$_POST['contentAlt'],$_POST['contentSlikaOrg'],$_POST['contentSlikaMala'],date('Y-m-d',strtotime($_POST['contentDate'])),$_POST['contentHeadline'],$_POST['contentCont'],$_POST['contentFullCont'],intval($_POST['contentPosition']),intval($_POST['contentCategory']),intval($_POST['contentAuthor']),$_POST['contentId']];
    $uspeh = aUpdateContent($parametri,$_POST['contentSlikaMala'],$_POST['contentSlikaOrg']);
    if($uspeh==1) http_response_code(204);
    else {upisiGresku("Greska prilikom azuriranja sadrzaja!"); http_response_code(500);}
}elseif(isset($_POST['radnja']) && $_POST['radnja']==='AgetMsg'){
    $uspeh = aGetMessages([intval($_POST['sel'])]);
    if($uspeh==0){
        upisiGresku("Greska prilikom dohvatanja poruka za admina!");
        http_response_code(500);
    }else{
        echo json_encode($uspeh); 
        http_response_code(200);
    }
}elseif(isset($_POST['radnja']) && $_POST['radnja']==='getStatistic'){
    $statistika = getStatistic();
    echo json_encode($statistika); 
    http_response_code(200);
}elseif(isset($_POST['radnja']) && $_POST['radnja']==='UdeleteUser'){
    $uspeh = uDeleteUser([$_POST['userId']]);
    if($uspeh == 1) http_response_code(204);
    else {upisiGresku("Greska prilikom brisanja korisnika!"); http_response_code(500);}
}elseif(isset($_POST['radnja']) && $_POST['radnja']==='UupdateUser'){
    $parametri = [$_POST['userFname'],$_POST['userLname'],md5($_POST['userPass']),$_POST['userId']];
    $uspeh = uUpdateUser($parametri);
    if($uspeh==1) http_response_code(204);
    else {upisiGresku("Greska prilikom azuriranja korisnika!"); http_response_code(500);}
}elseif(isset($_POST['radnja']) && $_POST['radnja']==='vote'){
    $userId = [intval($_POST['user_id'])];
    $novOdg = [intval($_POST['checked']),intval($_POST['user_id'])];
    $uspeh = vote($userId,$novOdg);
    if($uspeh==1)   http_response_code(201);
    elseif($uspeh==2)   {upisiGresku("Greska prilikom glasanja!"); http_response_code(404);}
    elseif($uspeh==0)   {upisiGresku("Greska prilikom glasanja!"); http_response_code(500);}
}elseif(isset($_POST['radnja']) && $_POST['radnja']==='provera'){
    $uspeh = provera($_POST['fullName'],$_POST['msg'],$_POST['email']);
    if(($uspeh==0) || ($uspeh==2))   {upisiGresku("Greska prilikom dodavanja poruka!"); http_response_code(500);}
    elseif($uspeh==1) http_response_code(201);
}
