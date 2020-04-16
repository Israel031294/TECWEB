
$(document).ready(function()
{
  $('#show').click(function()
  {
   $(this).is(':checked') ? $('#clave').attr('type', 'text') : $('#clave').attr('type', 'password');
});

  $('#formObtComp').validetta
  ({ 
   });

   

});

function validaMaxLength(){
	document.getElementById("token").maxLength = 3;
}


