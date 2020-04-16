
function regresoOpciones(){
	
	var html="";
	
		html+="<div class='row'>";
		html+="<label>Categoria actual</label>";
		html+="<select class='browser-default' id='categoria' name='categoria' required>";
		html+="<option value='' disabled selected>Categoria actual</option>";
		html+="<option value='PTC'>Profesor de tiempo completo</option>";
		html+="<option value='PMT'>Profesor de tiempo completo</option>";
		html+="<option value='PPH'>Profesor por horas</option>";
		html+="<option value='PDA'>Profesor de asignatura</option>";
		html+="</select>";
		html+="<b id='nvoForm' onclick='otraCategoria();'>Si no aparece tu categoria da click aqui.</b>";
		html+="</div>";
		
		document.getElementById("cambio").innerHTML = html;
	
}


function otraCategoria(){
	
	var html="";
		html+= '<i class="fa fa-user fa prefix"></i>';
		html+="<label for='categoria'>Categoria:</label>";
		html+="<input type='text' required id='categoria' name='categoria' data-validetta='required,number,minLength[8],maxLength[10]'>";
		html+="<b onclick='regresoOpciones();' id='regresoOpciones'>Mostrar de nuevo opciones</b>";
		document.getElementById("cambio").innerHTML = html;	
}


function otroTipoE()
{
		var html="";
		html+='<label for="tipo">Tipo curso:</label>';
		html+="<input  type='text'  required id='tipo' name='tipo' data-validetta='required,number,minLength[8],maxLength[10]'>";
		html+="<b  onclick='regresoOpcionesECO();'  id='regresoOpciones'>Mostrar de nuevo opciones</b>";
		document.getElementById("cambio").innerHTML = html;	
}

function regresoOpcionesECO(){
	
	var html="";
	
			html+="<div class='row'>";
			html+="<label>Tipo de curso</label>";
			html+="<select class='browser-default' id='tipo' name='tipo' required>";
			html+="<option value='' disabled selected>Tipo de curso</option>";
			html+="<option value='ECO'>Educaci&oacute;n continua</option>";
			html+="</select>";
			html+="<b id='nvoForm' onclick='otroTipoE();'>Si no aparece tu tipo curso da click aqui.</b>";
			html+="</div>";
		
		document.getElementById("cambio").innerHTML = html;
	
}

