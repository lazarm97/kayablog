<?php
    if(isset($_SESSION['User'])):
        if($_SESSION['User']->function_id==2):
            require_once('../../config/connection.php');
            $upitUser = "select * from users where id='".$_SESSION['User']->id."'";
            $users = $conn->query($upitUser)->fetch();
            $upitCont = "select * from content";
            $contents = $conn->query($upitCont)->fetchAll();
            $upitAuthor = "select * from author";
            $authors = $conn->query($upitAuthor)->fetchAll();
?>

<div class="container">
        <div class="col-6">
<form>
<div id="useredit">
    <div class="form-group">
        <label for="exampleFormControlSelect1">User: <?= $users->fname." ".$users->lname; ?></label>
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">First name</label>
        <input type="text" class="form-control" id="userFname" placeholder="1-10 characters">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Last name</label>
        <input type="text" class="form-control" id="userLname" placeholder="1-10 characters">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Email</label>
        <input type="email" class="form-control" id="userEmail" placeholder="name@example.com" readonly>
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Password</label>
        <input type="text" class="form-control" id="userPass" placeholder="1-10 characters">
    </div>
    <button type="button" class="btn btn-primary" name="btnUserUpdate" onclick="updateUser()">Update</button>
    <button type="button" class="btn btn-primary" name="btnUserDelete" onclick="deleteUser()">Delete</button>
</div>

</form>
</div>
</div>
<!-- Jquery-2.2.4 js -->
<script src="../../assets/js/jquery/jquery-2.2.4.min.js"></script>
    <script>
    $(document).ready(function(){
        $('#userFname').val('<?= $users->fname; ?>');
        $('#userLname').val('<?= $users->lname; ?>');
        $('#userEmail').val('<?= $users->email; ?>');
    });
        function updateUser() {
           $.ajax({
                    type: 'POST',
                    url: '../../models/edit/obrada.php',
                    data:{
                        radnja:'UupdateUser',
                        userId : <?= $_SESSION['User']->id; ?>,
                        userFname : $('#userFname').val(),
                        userLname : $('#userLname').val(),
                        userPass : $('#userPass').val()
                    },
                    success:function(podaci,status,jqXHR){
                        if(jqXHR.status == 200){
                            alert("uspelo");
                        }
                    }
                });
        }
        function deleteUser() {
           $.ajax({
                    type: 'POST',
                    url: '../../models/edit/obrada.php',
                    data:{
                        radnja:'UdeleteUser',
                        userId : <?= $_SESSION['User']->id; ?>
                    },
                    success:function(podaci,status,jqXHR){
                        if(jqXHR.status == 200){
                            window.location.replace("logout.php");
                        }
                    }
                });
        }
        
        
    </script>

    <?php endif; else: echo "nije dozvoljen pristup preko url adrese!"; endif; ?>