$("#salir").click(
    function(){
        $.ajax({
            method:"post",
            url:"./../servidor/sesion.php",
            data: {},
            cache:false,
            success:function(resp){
                var res = JSON.parse(resp);
                if(res.estado == "cs"){
                    window.location.replace(res.url);
                }else{
                    
                    alert("Algo salió mal: "+res.msg);
                }
            },
        });
    }
);

$("#salirM").click(
    function(){
        $.ajax({
            method:"post",
            url:"./../servidor/sesion.php",
            data: {},
            cache:false,
            success:function(resp){
                var res = JSON.parse(resp);
                if(res.estado == "cs"){
                    window.location.replace(res.url);
                }else{
                    
                    alert("Algo salió mal: "+res.msg);
                }
            },
        });
    }
);