<?php
    if(isset($_POST['btnLogin'])){
        $email = $_POST['emailLogin'];
        $password = md5($_POST['passwordLogin']);

        $upit1 = "SELECT * FROM `users` WHERE email=:email AND password=:password";
        $priprema = $conn->prepare($upit1);
        $priprema->bindParam(':email', $email);
        $priprema->bindParam(':password', $password);

        $rezultat = $priprema->execute();

        if($rezultat){
            if($priprema->rowCount() == 1){
                $user = $priprema->fetch();
                $_SESSION['User'] =  $user;
                zabeleziLogovanje($user->id);
                header('Location: index.php');
            }else{
                if($priprema->rowCount() == 0){
                    upisiGresku("Greska prilikom logovanja! Korisnik sa ovim emailom i pasvordom nepostoji!");
                    posaljiMejl($email);
                    echo "niste registrovani";
                }
            }
        }
    }
