<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once "config.php";

zabeleziPristupStranici();

try {
    $conn = new PDO("mysql:host=".SERVER.";dbname=".DATABASE.";charset=utf8", USERNAME, PASSWORD);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $ex){
    echo $ex->getMessage();
}

function executeQuery($query){
    global $conn;
    return $conn->query($query)->fetchAll();
}

function zabeleziPristupStranici(){
    $open = fopen(LOG_FAJL, "a");
    if($open){
        $date = date('d-m-Y H:i:s');
        fwrite($open, "{$_SERVER['PHP_SELF']}\t{$date}\t{$_SERVER['REMOTE_ADDR']}\t\n");
        fclose($open);
    }
}

function zabeleziLogovanje($userId){
    $podaci = file(ACITIVE_USERS_FAJL);
    $delovi = explode("\t",trim($podaci[0]));
    if(!in_array($userId,$delovi)){
        $open = fopen(ACITIVE_USERS_FAJL,'a');
        fwrite($open, "{$userId}\t");
        fclose($open);
    }
}

function zabeleziOdjavu($userId){
    $podaci = file(ACITIVE_USERS_FAJL);
    $delovi = explode("\t", $podaci[0]);
    $tmp = array();
    foreach($delovi as $deo){
        if($deo != $userId) $tmp[] = $deo;
    }
    $niz = implode("\t",$tmp);
    $open = fopen(ACITIVE_USERS_FAJL,"w");
    fwrite($open,$niz);
    fclose($open);
}

function upisiGresku($tekst){
    $open = fopen(GRESKE_FAJL, "a");
    if($open){
        fwrite($open, $tekst."\n");
        fclose($open);
    }
}

function posaljiMejl($email){
    
    require ABSOLUTE_PATH.'/assets/plugins/PHPMailer/src/Exception.php';
    require ABSOLUTE_PATH.'/assets/plugins/PHPMailer/src/PHPMailer.php';
    require ABSOLUTE_PATH.'/assets/plugins/PHPMailer/src/SMTP.php';
    
    
    $mail = new PHPMailer(true);
    
    try {
        //Server settings
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->SMTPDebug = 0;                                       // Enable verbose debug output
        $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'pokerstarssrb1993@gmail.com';                     // SMTP username
        $mail->Password   = 'phptester123';                               // SMTP password
        $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to
    
        //Recipients
        $mail->setFrom('lmarojkin@gmail.com', 'Lazar Marojkin');
        $mail->addAddress($email);     // Add a recipient
    
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Obavestenje';
        $mail->Body    = 'Neuspesno logovanje!<b>OPREZ</b>';

        $mail->send();
        // echo 'Message has been sent';
    } catch (Exception $e) {
        upisiGresku("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
    }   
    
}