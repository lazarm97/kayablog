<?php
if($_FILES['contentSrc']['name'] != ''){
    $file = $_FILES['contentSrc'];
    $name = $file['name'];
    $size = $file['size'];
    $tip = $file['type'];
    $tmp_name = $file['tmp_name'];
    $greske = [];
    $dozvoljeniTipovi = ['image/jpg', 'image/jpeg', 'image/png'];
    if(!in_array($tip,$dozvoljeniTipovi))   $greske[] = 'Tip nije dobar!';
    if($size > 2000000) $greske[] = 'Slika je prevelika!';

    if(count($greske)!=0){
        while(count($greske))   echo $greske;
    }else{
        list($sirina,$visina) = getimagesize($tmp_name);

        $postojecaSlika = null;
        switch($tip){
            case 'image/jpeg':
                $postojecaSlika = imagecreatefromjpeg($tmp_name);
                break;
            case 'image/png':
                $postojecaSlika = imagecreatefrompng($tmp_name);
                break;
        }

        $novaSirina = 225;
        $novaVisina = 150;

        $novaSlika = imagecreatetruecolor($novaSirina,$novaVisina);

        imagecopyresampled($novaSlika, $postojecaSlika, 0, 0, 0, 0, $novaSirina, $novaVisina, $sirina, $visina);
        $naziv = time().$name;

        $putanjaNovaSlika = 'assets/img/tmp/mala_'.$naziv;

        switch($tip){
            case 'image/jpeg':
                imagejpeg($novaSlika, '../../'.$putanjaNovaSlika, 75);
                break;
            case 'image/png':
                imagepng($novaSlika, '../../'.$putanjaNovaSlika);
                break;
        }

        $putanjaOriginalnaSlika = 'assets/img/tmp/org_'.$naziv;

        if(move_uploaded_file($tmp_name, '../../'.$putanjaOriginalnaSlika)){
            echo $naziv;
        }

        // brisanje iz memorije
        imagedestroy($postojecaSlika);
        imagedestroy($novaSlika);

    }

}


?>