<?php



function getStatistic(){
    global $conn;
    $upit = "SELECT q.id as status_id, count(a.status_id) as broj,round((100/(select count(*) from questionnaire q LEFT OUTER join answers a on q.id=a.status_id where status_id is not null)*count(a.status_id)),2) as procenat FROM questionnaire q left outer join answers a on q.id=a.status_id GROUP BY status;";
    $rez = $conn->query($upit)->fetchAll(PDO::FETCH_ASSOC); 
    return $rez;
}

function vote($userId,$queryParam){
    global $conn;
    $upit = "SELECT * FROM answers where user_id = ?";
    $rez = $conn->prepare($upit);
    if($rez->execute($userId)){
        $odg = $rez->fetchAll();
        $br = 0;
        foreach($odg as $red) $br++;
        if($br == 0){
            $novUpit = "INSERT INTO `answers` VALUES (?,?);";
            $novRez = $conn->prepare($novUpit);
            if($novRez->execute($queryParam))  return 1;
            else return 0;
        }
    }else   return 2;
}

function provera($name,$email,$message){
    global $conn;
    $regName = "/^([A-Z][a-z]{2,9}){1}\s{1}([A-Z][a-z]{2,11}){1}$/";
    if($name=='' || $message=='' || $email==''){
        return 0;
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match($regName,$name)){
        return 0;
    }else{
        $parametri = [$name,$message,$email];
        $upit = "INSERT INTO `messages` (`name`, `text`, `email`) VALUES (?, ?, ?);";
        $rez = $conn->prepare($upit);
        if($rez->execute($parametri))   return 1;
        else return 2;
    }
}

function insert($putanjaOriginalnaSlika, $putanjaNovaSlika){
    global $conn;
    $insert = $conn->prepare("INSERT INTO slike VALUES('', ?, ?)");
    $isInserted = $insert->execute([$putanjaOriginalnaSlika, $putanjaNovaSlika]);
    return $isInserted;
}

function brojPosecenostiStranice($stranica){
    $file = fopen(LOG_FAJL, 'r');
    $podaci = file(LOG_FAJL);
    foreach($podaci as $podatak=>$value){
        $delovi[] = explode("\t",trim($value)); 
    }
    fclose($file);
    $br = 0;
    $brojStranice = 0;
    while($br<count($delovi)){
        if($delovi[$br][0]==$stranica)  $brojStranice++;
        $br++;
    }
    return $brojStranice;
}

function brojPosecenostiStraniceProtekla24Sata($stranica){
    $trenutnoVremeUmanjenoZa24h = time() - 24*60*60;
    $file = fopen(LOG_FAJL, 'r');
    $podaci = file(LOG_FAJL);
    foreach($podaci as $podatak=>$value){
        $delovi[] = explode("\t",trim($value)); 
    }
    fclose($file);
    $br = 0;
    $brojStranice = 0;
    while($br<count($delovi)){
        if($delovi[$br][0]==$stranica){
            $vremePristupa = strtotime($delovi[$br][1]);
            if($vremePristupa>=$trenutnoVremeUmanjenoZa24h) $brojStranice++;
        }  
        $br++;
    }
    return $brojStranice;
}

function brojUlogovanih(){
    $podaci = file(ACITIVE_USERS_FAJL);
    $delovi = explode("\t", trim($podaci[0]));
    return count($delovi);
}

function ukupanBrojStranica($sveStranice){
    $br = 0;
    $i = 0;
    while($i<count($sveStranice)){
        $br+= brojPosecenostiStranice($sveStranice[$i]);
        $i++;
    }
    return $br;                
}

function poseceneStranice(){
    $file = fopen(ABSOLUTE_PATH.'/data/log.txt', 'r');
    $podaci = file(ABSOLUTE_PATH.'/data/log.txt');
    foreach($podaci as $podatak=>$value){
        $delovi[] = explode("\t",trim($value)); 
    }
    fclose($file);
    $poseceneStranice = [];
    $br=0;
    while($br<count($delovi)){
        if(!in_array($delovi[$br][0],$poseceneStranice)) $poseceneStranice[] = $delovi[$br][0];
        $br++;
    }
    return $poseceneStranice;
}