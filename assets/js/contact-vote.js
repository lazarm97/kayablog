
        $(document).ready(function(){
            $('#anketa').hide();
            $('#statistika').hide();
            var setUser = $('#isUserSet').val();
            if(setUser == 1){
                var userId = $('#userId').val();
                $('#voteBtn').click(function(){
                    $.ajax({
                        url:'models/edit/obrada.php',
                        method:'post',
                        data:{
                            radnja:'vote',
                            checked:$("input[name='customRadio']:checked").val(),
                            user_id: userId
                        },
                        success:function(data,status,jqXHR){
                            if(jqXHR.status == 204){
                                fillStatistic();
                                $('#anketa').hide();
                                $('#statistika').show();
                            }
                            else{
                                alert('Vec ste glasali!');
                            }
                        }
                    }); 
                });
            }
            $('#contact-btn').click(function(){
                var fullName = $('#contact-name').val();
                var email = $('#contact-email').val();
                var msg = $('#message').val();
                var regFullName = /^([A-Z][a-z]{2,9}){1}\s{1}([A-Z][a-z]{2,11}){1}$/;
                var regEmail = /^[a-zA-Z0-9\.\-]+@[a-zA-Z0-9\.\-]+$/;
                if((regFullName.test(fullName)) && (regEmail.test(email)) && (msg!='')){
                    $.ajax({
                        type:"post",
                        url:"models/edit/obrada.php",
                        data:{
                            radnja:"provera",
                            email:email,
                            msg:msg,
                            fullName:fullName
                        },success:function(data,status,jqXHR){
                            if(jqXHR.status == 204) alert('Uspesno ste nas koontaktirali!');
                            if(jqXHR.status == 500) alert('nije dobro');
                        }
                    });
                }else{
                    alert('Podaci nisu dobri!');
                }
            });

            var brojOdgovora = $('#brojOdgovora').val();
   
            function fillStatistic(){
                $.ajax({
                            url:'models/edit/obrada.php',
                            method:'post',
                            data:{
                                radnja:'getStatistic'
                            },
                            dataType:'json',
                            success:function(data,status,jqXHR){
                                for(var k in data){
                                    switch(data[k].status_id) {
                                        case '1':
                                            $('#bad').each(function() {
                                                $(this).html(data[k].broj);    
                                            });
                                            $('#badP').each(function() {
                                                $(this).html(data[k].procenat+"%");    
                                            });
                                            break;
                                        case '2':
                                            $('#medium').each(function() {
                                                $(this).html(data[k].broj);    
                                            });
                                            $('#mediumP').each(function() {
                                                $(this).html(data[k].procenat+"%");    
                                            });
                                            break;
                                        case '3':
                                            $('#good').each(function() {
                                                $(this).html(data[k].broj);    
                                            });
                                            $('#goodP').each(function() {
                                                $(this).html(data[k].procenat+"%");    
                                            });
                                            break;
                                        case '4':
                                            $('#perfect').each(function() {
                                                $(this).html(data[k].broj);    
                                            });
                                            $('#perfectP').each(function() {
                                                $(this).html(data[k].procenat+"%");    
                                            });
                                            break;
                                        default:
                                            break;
                                    }
                                }
                            }
                        }); 
            }
            if(brojOdgovora == 0){
                $('#anketa').show();
                $('#statistika').hide();
            }else{
                fillStatistic();
                $('#anketa').hide();
                $('#statistika').show();
            }
        });
        