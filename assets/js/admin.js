$(document).ready(function(){
    $('#useredit').hide();
    $('#contentedit').hide();
    $('.form-msg').hide();
});
var imgSrc = "";
var putanjaSlike = "";
var putanjaSlikeOrg = "";
function uploadImg() {
    var property = document.getElementById("contentSrc").files[0];
        var image_name = property.name;
        var image_extension = image_name.split(".").pop().toLowerCase();
        if(jQuery.inArray(image_extension, ['png', 'jpg', 'jpeg']) == -1){
            alert('Invalid image file!');
        }
        var image_size = property.size;
        if(image_size > 2000000){
            alert('Image size is very big!');
        }
        var form_data = new FormData();
        form_data.append("contentSrc", property);
        $.ajax({
            url:"../../models/edit/upload.php",
            method:"POST",
            data:form_data,
            contentType:false,
            cache:false,
            processData:false,
            success:function(data){
                imgSrc = data;
                putanjaSlike = 'assets/img/blog-img/male_slike/mala_'+imgSrc;
                putanjaSlikeOrg = 'assets/img/blog-img/originalne_slike/org_'+imgSrc;
                let ispis = `<img src ="../../assets/img/tmp/org_`+imgSrc+`" class="img-thumbnail" />`;
                $('#uploaded_img').html(ispis);
            }
        });
}
function izaberi(sel) {
    var value = sel.value;
    if(value == 1){
        $('#useredit').show();
        $('#contentedit').hide();
    }else if(value == 2){
        $('#contentedit').show();
        $('#useredit').hide();
    }else{
        $('#contentedit').hide();
        $('#useredit').hide();
    }
}
function selectMsg(sel) {
    if(sel != 0){
        $.ajax({
            type: 'POST',
            url: '../../models/edit/obrada.php',
            data:{radnja:'AgetMsg', sel},
            dataType: 'json',
            success:function(podaci){
                $('#msgEmail').val(podaci.email);
                $('#msgText').val(podaci.text);
                $('#msgDate').val(podaci.date);
                $('.form-msg').show();
            }
        });
    }else{
        $('.form-msg').hide();
    }
}

function selectedUser(user_id) {
    if(user_id==0){
        $('#userFname').val("");
        $('#userLname').val("");
        $('#userEmail').val("");
        $('#userPass').val("");
        $('#userFunction').val(0);
    }else{
        $.ajax({
            type: 'POST',
            url: '../../models/edit/obrada.php',
            data:{radnja:'AgetUser', user_id},
            dataType: 'json',
            success:function(podaci){
                // console.log('usao');
                // console.log(podaci.fname);
                $('#userFname').val(podaci.fname);
                $('#userLname').val(podaci.lname);
                $('#userEmail').val(podaci.email);
                $('#userPass').val(podaci.password);
                $('#userFunction').val(podaci.function_id);
            }
        });
    }
}

function selectedContent(content_id) {
    if(content_id==0){
        $('#contentHref').val("");
        $('#uploaded_img').html("");
        $('#contentAlt').val("");
        $('#contentSrc').val("");
        $('#contentDate').val("");
        $('#contentHeadline').val("");
        $('#contentCont').val("");
        $('#contentFullCont').val("");
        $('#contentPosition').val(0);
        $('#contentCategory').val(0);
        $('#contentAuthor').val(0);
    }else{
        $.ajax({
            type: 'POST',
            url: '../../models/edit/obrada.php',
            data:{radnja:'AgetContent', content_id},
            dataType: 'json',
            success:function(podaci){
                
                if(!podaci) console.log('1');
                $('#contentHref').val(podaci.href);
                $('#contentAlt').val(podaci.alt);
                if(podaci.mala_slika!=""){
                    $('#uploaded_img').html('<img src = "../../'+podaci.mala_slika+'" class="img-thumbnail" />');
                }else  $('#uploaded_img').html("Nema slike!");
                $('#contentDate').val(podaci.date);
                $('#contentHeadline').val(podaci.headline);
                $('#contentCont').val(podaci.content);
                $('#contentFullCont').val(podaci.fullcontent);
                $('#contentPosition').val(podaci.position);
                $('#contentCategory').val(podaci.category_id);
                $('#contentAuthor').val(podaci.author_id);
                putanjaSlike = podaci.mala_slika;
                putanjaSlikeOrg = podaci.velika_slika;
            }
        });
    }
}
function insertUser() {
   $.ajax({
    type: 'POST',
            url: '../../models/edit/obrada.php',
            data:{
                radnja:'AinsertUser',
                userFname : $('#userFname').val(),
                userLname : $('#userLname').val(),
                userEmail : $('#userEmail').val(),
                userPass : $('#userPass').val(),
                userFunction : $('#userFunction').val()
            },
            success:function(podaci,status,jqXHR){
                if(jqXHR.status == 200){
                    $('#userFname').val("");
                    $('#userLname').val("");
                    $('#userEmail').val("");
                    $('#userPass').val("");
                    $('#userFunction').val(0);
                }
            }
        });
}
function updateUser() {
   $.ajax({
            type: 'POST',
            url: '../../models/edit/obrada.php',
            data:{
                radnja:'AupdateUser',
                userId : $('#userId').val(),
                userFname : $('#userFname').val(),
                userLname : $('#userLname').val(),
                userEmail : $('#userEmail').val(),
                userPass : $('#userPass').val(),
                userFunction : $('#userFunction').val()
            },
            success:function(podaci,status,jqXHR){
                if(jqXHR.status == 200){
                    $('#userFname').val("");
                    $('#userLname').val("");
                    $('#userEmail').val("");
                    $('#userPass').val("");
                    $('#userFunction').val(0);
                }
            }
        });
}
function deleteUser() {
   $.ajax({
            type: 'POST',
            url: '../../models/edit/obrada.php',
            data:{
                radnja:'AdeleteUser',
                userId : $('#userId').val()
            },
            success:function(podaci,status,jqXHR){
                if(jqXHR.status == 200){
                    $('#userFname').val("");
                    $('#userLname').val("");
                    $('#userEmail').val("");
                    $('#userPass').val("");
                    $('#userFunction').val(0);
                }
            }
        });
}
function insertContent() {
    if(imgSrc != ""){
        putanjaSlike = imgSrc;
    }
    if($('#contentId').val() == 0)
    {
        $.ajax({
            type: 'POST',
                    url: '../../models/edit/obrada.php',
                    data:{
                        radnja:'AinsertContent',
                        contentAlt : $('#contentAlt').val(),
                        contentSrc : putanjaSlike,
                        contentDate : $('#contentDate').val(),
                        contentHeadline : $('#contentHeadline').val(),
                        contentCont : $('#contentCont').val(),
                        contentFullCont : $('#contentFullCont').val(),
                        contentPosition : $('#contentPosition').val(),
                        contentCategory : $('#contentCategory').val(),
                        contentAuthor : $('#contentAuthor').val()
                    },
                    success:function(podaci,status,jqXHR){
                        if(jqXHR.status == 200){
                            $('#contentId').val(0);
                            $('#contentHref').val("");
                            $('#contentAlt').val("");
                            $('#contentSrc').val("");
                            $('#contentDate').val("");
                            $('#contentHeadline').val("");
                            $('#contentCont').val("");
                            $('#contentFullCont').val("");
                            $('#contentPosition').val(0);
                            $('#contentCategory').val(0);
                            $('#contentAuthor').val(0);
                            $('#uploaded_img').html("");
                        }else{
                            // console.log("greska");
                        }
                    }
                });
    }
    else    alert('Selected content must be New!');
}
function deleteContent() {
   $.ajax({
            type: 'POST',
            url: '../../models/edit/obrada.php',
            data:{
                radnja:'AdeleteContent',
                contentId : $('#contentId').val()
            },
            
            success:function(podaci,status,jqXHR){
                if(jqXHR.status == 200){
                    $('#contentId').val(0);
                    $('#contentHref').val("");
                    $('#contentAlt').val("");
                    $('#contentSrc').val("");
                    $('#contentDate').val("");
                    $('#contentHeadline').val("");
                    $('#contentCont').val("");
                    $('#contentFullCont').val("");
                    $('#contentPosition').val(0);
                    $('#contentCategory').val(0);
                    $('#contentAuthor').val(0);
                    $('#uploaded_img').html("");
                }
                
            }
        });
}
function updateContent() {
    // if(imgSrc != ""){
    //     putanjaSlike = imgSrc;
    // }
    console.log(putanjaSlike);
    console.log(putanjaSlikeOrg);
   $.ajax({
            type: 'POST',
            url: '../../models/edit/obrada.php',
            data:{
                radnja:'AupdateContent',
                contentId : $('#contentId').val(),
                contentAlt : $('#contentAlt').val(),
                contentSlikaMala : putanjaSlike,
                contentSlikaOrg : putanjaSlikeOrg,
                contentDate : $('#contentDate').val(),
                contentHeadline : $('#contentHeadline').val(),
                contentCont : $('#contentCont').val(),
                contentFullCont : $('#contentFullCont').val(),
                contentPosition : $('#contentPosition').val(),
                contentCategory : $('#contentCategory').val(),
                contentAuthor : $('#contentAuthor').val()
            },
            
            success:function(podaci,status,jqXHR){
                if(jqXHR.status == 200){
                    $('#contentId').val(0);
                    $('#contentHref').val("");
                    $('#contentAlt').val("");
                    $('#contentSrc').val("");
                    $('#contentDate').val("");
                    $('#contentHeadline').val("");
                    $('#contentCont').val("");
                    $('#contentFullCont').val("");
                    $('#contentPosition').val(0);
                    $('#contentCategory').val(0);
                    $('#contentAuthor').val(0);
                    $('#uploaded_img').html("");
                }else{
                    // console.log("greska");
                }
                
            }
        });
}
