<?php

function obtenerUsuario($data){
    $usu = null;

    //Se intenta poner como set de caracteres utf8 para que no regrese o se ingresen simbolos raros
    if($this->conexion->set_charset("utf8")){

        //Se crea la sentencia con '?' para representar variables que asignaremos mas adelante
        $query = "SELECT * FROM usuario u,tipousuario t WHERE u.idTU = t.idTU AND usuario = ? AND password = hex(aes_encrypt(?,'Illusion'))";
        
        //Se prepara la sentencia, si no se pudo preparar saltara un error
        if($prep = $this->conexion->prepare($query)){

            //Se asignan los parametros poniendo el tipo en la primera cadena
            //por CADA '?' que exista en la sentencia mysql
            // - Se pueden asignar los siguientes valores
            //    - s:cadenas o string
            //    - d:real/punto flotante o double
            //    - i:entero o integer
            //    - b:paquetes de bits o blob
            // - Se colocan TODOS los parametros que se cargaran a cada '?'
            //Ejemplo:
            //    $query = "SELECT * from tabla where id = ? and nombre = ? and apellido = ?"
            //    $prep = $<objeto mysql>->conexion->prepare($query);
            //    $prep->bind_param("iss",$id,$nombre,$apellido);

            $prep->bind_param("ss",$data["nombre"], $data["password"]);
            $prep->execute();
            $res = $prep->get_result();
            if($res->num_rows > 0){
                if($row = $res->fetch_assoc()){
                    $usu = new Usuario(0, $row["usuario"], $row["tipo"]);
                }
            }else{//No hubo un usuario
                $usu = "Los datos ingresados son incorrectos";
            }
        }else{//Error con la consulta a la base de datos
            $usu = "Ha ocurrido un error al consultar la base de datos";
        }
    }else{//Error con la base de datos
        $usu = "Ha ocurrido un error de conexión";
    }
    return $usu;
}

?>