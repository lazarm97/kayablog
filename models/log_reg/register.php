<?php
    if(isset($_POST['btnReg'])){
        $fname = $_POST['regFname'];
        $lname = $_POST['regLname'];
        $email = $_POST['regEmail'];
        $pass = MD5($_POST['regPass']);
        $passconf = MD5($_POST['regPassConfirm']);
        $upit1 = "INSERT INTO users (fname,lname,email,password,function_id) VALUES(:fname,:lname,:email,:pass,'2')";
        $priprema = $conn->prepare($upit1);
        $priprema->bindParam(':fname', $fname);
        $priprema->bindParam(':lname', $lname);
        $priprema->bindParam(':email', $email);
        $priprema->bindParam(':pass', $pass);
        if($pass == $passconf){
            $priprema->execute();
            $upit12 = "SELECT * FROM `users` WHERE email=:email AND password=:password";
            $priprema2 = $conn->prepare($upit12);
            $priprema2->bindParam(':email', $email);
            $priprema2->bindParam(':password', $pass);
    
            $rezultat = $priprema2->execute();
    
            if($rezultat){
                if($priprema2->rowCount() == 1){
                    $user = $priprema2->fetch();
                    $_SESSION['User'] =  $user;
                    zabeleziLogovanje($user->id);
                    header('Location: index.php');
                }else{
                    if($priprema2->rowCount() == 0){
                        upisiGresku("Greska prilikom registracije! Pokusajte da se ulogujete!");
                        echo "Registracija nije uspela!";
                    }
                }
            }
        }else{
            upisiGresku("Greska prilikom registracije! Sifre nisu iste!");
            echo "Passwords are not equals!";
        }
    }