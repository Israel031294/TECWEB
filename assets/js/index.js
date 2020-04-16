$(document).ready(function(){
    $("#submit").click(function(event){
        event.preventDefault();
        $("#submit").prop("disabled", true);
        $.ajax({
            method:"post",
            url:"./../servidor/sesion.php",
            data: $("#inicioSesion").serialize(),
            cache:false,
            success:function(resp){
                try{
                    var res = JSON.parse(resp);
                    if(res.estado == "a"){
                        window.location.replace(res.url);
                    }else{
                        $('#msg').html(
                            "<div class='error'>" +
                            res.msg+
                            "</div>"
                        );
                        
                    }  
                }catch(e){
                    console.error(e);
                    console.error(resp);
                }finally{
                    $("#submit").prop("disabled", false);
                }
                
            },
            error:function(xhr, ajaxOptions, thrownError){
                $("#submit").prop("disabled", false);
            },
        });
    });
});

