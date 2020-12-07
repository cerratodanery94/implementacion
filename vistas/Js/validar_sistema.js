//VALIDACIONES GLOBALES

            //VALIDACION DE SOLO LETRAS
            function validar_texto(parametro) {
                var Texto= /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/g;
                if(parametro.search (Texto)){
                    return false;
                }
                else {
                    return true;
                }
          }

          //VALIDACION RANGO DE USUARIO
          function validar_longitud(parametro) {
            if(parametro.length <6  || parametro.length >15  ){
                return false;
            }
            else {
                return true;
            }
      }
         //VALIDAR RANGO DE CAMPOS (NOMBRES,APELLIDOS Y CORREO)
         function validar_tamaño(parametro){
             if(parametro.length >255){
                 return false;
             }
             else{
                 return true;
             }
         }
         //VALIDAR LONGITUD_CONTRASEÑA
         function validar_limitcontraseña(parametro){
             if (parametro.length <=7  || parametro.length >12  ){
                 return false;
             }
             else{
                 return true;
             }
         }
         //VALIDAR CORREO
        function Validar_correo(parametro){
            var p_correo=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if(!p_correo.test(parametro)){
                return false;
            }
            else  {
            return true;
            }
        }
          //VALIDAR ESPACIOS EN BLANCOS
          function Validar_espacio(parametro){
            var Espacio= /\s/;
            if(Espacio.test(parametro)){
                return false;
            }
            else{
                return true;
            }
          }
          //VALIDAR DOS ESPACIOS
          function Validar_espacio2(parametro){
            var Espacio= /([ ]{2,})/;
            // var Espacio= /([ ]{2,})|[-!$%^&*()_+|~=`{}\[\]:";'<>?,.\/]/;
            if(Espacio.test(parametro)){
                return false;
            }
            else{
                return true;
            }
        }
        function validar_contra3(parametro){
            var p_contra=/^(?=.*\d)(?=.*[-!$%@#^&*()_+|~=`{}\[\]:";'<>?,.\/])(?=.*[a-z])(?=.*[A-Z]).{8,12}$/;
            // var p_contra=/^(?=.*\d)(?=.*[!@#$&])(?=.*[a-z])(?=.*[A-Z]).{8,12}$/;
       if (!p_contra.test(parametro)){
                return false;
            }else{
                return true;
            }
        }
//VALIDAR TELEFONO
function validar_telefono(parametro){
    var patron=/^\d{4}-\d{4}$/; //0000-0000
    if (!patron.test(parametro)){
        return false;
    }
        else{
            return true;
        }
    }
  
    //VALIDAR IDENTIDAD Y RTN
    function validar_identidad(parametro){
        var patron=/^\d{4}-\d{4}-\d{5}$/; //0000-0000-00000
        if (!patron.test(parametro)){
            return false;
        }
            else{
                return true;
            }
        }

      //  VALIDAR RTN
    function validar_rtn(parametro){
        var patron=/^\d{14}$/; //0000000000000
        if (!patron.test(parametro)){
            return false;
        }
            else{
                return true;
            }
        }
 
        //VALIDAR EDAD
        function validar_edad(parametro){
            var patron=/^\d{2}$/; //00
            if (!patron.test(parametro)){
                return false;
            }
                else{
                    return true;
                }
            }
            //VALIDAR NUMEROS DECIMALES
            function validar_numeros(parametro){
                var patron=/^(\d+|\d+.\d{2,5})$/;   
            // /^(\d+|\d+.\d{2,5})|(?=.*[a-z])(?=.*[A-Z])$/;
             //var patron= /^(\d+|\d+.\d{2,5})|(?=.*[a-z])(?=.*[A-Z])$/;
            if(!patron.test(parametro)){
                return false;
            }
            else {
                return true;
            }
            }

            //VALIDAR SOLO NUMERO
            function validar_num(parametro){
                var patron= /^(\d+|\d+)$/;
                if(!patron.test(parametro)){
                    return false;
                }
                else {
                    return true;
                }
                }

                //VLAIDAR NUMEROS Y LETRAS
                function validar_numletras(parametro){
                // var patron= /^(\d+|\d+)|[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/g;
                var patron=/^[_ a-zA-Z0-9]+$/   
                if(!patron.test(parametro)){
                        return false;
                    }
                    else {
                        return true;
                    }
                    }

                    //validar parametros
                    
                    
        //VALIDAR FORMULARIO INSERTAR MANT VISTA
    function validar_empleado(){
    var formulario=document.Form_registrar;

    if (formulario.nombres.value=="") {
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO NOMBRES VACIO</div>';
        formulario.nombres.focus();
        return false;
    }
    else if (Validar_espacio2 (formulario.nombres.value)==false){
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIOS EN EL CAMPO</div>';
        formulario.nombres.focus();
        return false;
        }
    else if (validar_texto (formulario.nombres.value)==false){
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>FAVOR INTRODUCIR DATOS TIPO TEXTO, SIN ESPACIOS AL INICIO O FINAL DEL TEXTO EN EL CAMPO.</div>';
        formulario.nombres.focus();
        return false;
        }
        else if (validar_tamaño (formulario.nombres.value)==false){
            document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE CARACTERES EN EL CAMPO</div>';
            formulario.nombres.focus();
            return false;
            }
            
    else{
            document.getElementById("alerta").innerHTML="";
        }
//VALIDAR CAMPO APELLIDO
if (formulario.apellidos.value=="") {
    document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO APELLIDOS VACIO</div>';
    formulario.apellidos.focus();
    return false;
}
else if (Validar_espacio2 (formulario.apellidos.value)==false){
    document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIOS EN EL CAMPO</div>';
    formulario.apellido.focus();
    return false;
    }
else if (validar_texto (formulario.apellidos.value)==false){  
    document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>FAVOR INTRODUCIR DATOS TIPO TEXTO, SIN ESPACIOS AL INICIO O FINAL DEL TEXTO EN EL CAMPO</div>';
    formulario.apellidos.focus();
    return false;
    }
    else if (validar_tamaño (formulario.apellidos.value)==false){
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE CARACTERES EN EL CAMPO APELLIDOS</div>';
        formulario.apellidos.focus();

        return false;
        }
               
    else{
        document.getElementById("alerta").innerHTML="";
    }
//VALIDAR CAMPO USUARIO
if (formulario.usum.value=="") {
    document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO USUARIO VACIO</div>';
    formulario.usum.focus();
    return false;
}

else if (validar_longitud (formulario.usum.value)==false){
    document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO USUARIO DEBE CONTENER AL MENOS (6) CARACTERES</div>';
    formulario.usum.focus();

    return false;
    }
else if (Validar_espacio2 (formulario.usum.value)==false){
    document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIOS EN EL CAMPO</div>';
    formulario.usum.focus();
    return false;
    }
else if (validar_texto (formulario.usum.value)==false){  
    document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>FAVOR INTRODUCIR DATOS TIPO TEXTO, SIN ESPACIOS AL INICIO O FINAL DEL TEXTO EN EL CAMPO</div>';
    formulario.usum.focus();
    return false;
    }
   
               
    else{
        document.getElementById("alerta").innerHTML="";
    }

 //VALIDAR FECHA NACIMIENTO
 if (formulario.fecha_de_nacimiento.value==0) {
    document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO FECHA NACIMINETO VACIO, FAVOR ENTRODUCIR UNA FECHA</div>';
    formulario.fecha_de_nacimiento.focus();
    return false;
} else{
    document.getElementById("alerta").innerHTML="";
}

    //VALIDAR CAMPO identidad
    if (formulario.numero_de_identidad.value=="") {
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO IDENTIDAD VACIO</div>';
        formulario.numero_de_identidad.focus();
        return false;
    }
    else if (formulario.numero_de_identidad.value=="0000-0000-00000") {
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO IDENTIDAD  INCORRECTO</div>';
        formulario.numero_de_identidad.focus();
        return false;
    }
    else if (validar_identidad(formulario.numero_de_identidad.value)==false){
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO IDENTIDAD INVALIDO</div>';
        formulario.numero_de_identidad.focus();
        return false;
    }
//VALIDAR RTN

// if(validar_rtn(formulario.rtn.value)==false){
//     document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO RTN INVALIDO</div>';
//     formulario.rtn.focus();
//     return false;
// }

        //VALIDAR CAMPO CELULAR
        if (formulario.numero_de_celular.value=="") {
            document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO CELULAR VACIO</div>';
            formulario.numero_de_celular.focus();
            return false;
        }       
       else if (validar_telefono(formulario.numero_de_celular.value)==false) {
            document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO NUMERO DE CELULAR INVALIDO</div>';
            formulario.numero_de_celular.focus();
            return false;
        } 
 //VALIDAR CAMPO TELEFONO
if (formulario.numero_de_telefono_fijo.value==""){
    document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIOS EN EL CAMPO</div>';
    formulario.numero_de_telefono_fijo.focus();
    return false;
    }
    else if (validar_telefono(formulario.numero_de_telefono_fijo.value)==false){
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO NUMERO DE TELEFONO INVALIDO</div>';
        formulario.numero_de_telefono_fijo.focus();
        return false;
        }
   
//VALIDAR CAMPO GENERO
if (formulario.genero.value==0) {
    document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO GENERO VACIO, FAVOR ELEGIR UN GENERO</div>';
    formulario.genero.focus();
    return false;
} 
   
     //VALIDAR CAMPO NACIONALIDAD
     if (formulario.nacionalidad.value==0) {
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO NACIONALIDAD VACIO</div>';
        formulario.nacionalidad.focus();
        return false;
    }
//VALIDAR CAMPO ROL
if (formulario.combox.value==0) {
    document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO ROL VACIO</div>';
    formulario.combox.focus();
    return false;
}
//VALIDAR CORREO
if (formulario.correo.value=="") {
    document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO CORREO VACIO</div>';
    formulario.correo.focus();
    return false;  
}
else if (validar_tamaño (formulario.correo.value)==false){
    document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE CARACTERES EN EXCESO EN EL CAMPO CORREO</div>';
    formulario.correo.focus();
    return false; 
    }
     else if (Validar_correo(formulario.correo.value)== false){
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>PORFAVOR INGRESAR UN CORREO VALIDO</div>';
        formulario.correo.value="";
        formulario.correo.focus();
        return false; 
     }

//    //VALIDAR CAMPO PASAPORTE
 
/*if (Validar_espacio2 (formulario.pasaporte.value)==false){
document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIOS EN EL CAMPO</div>';
formulario.pasaporte.focus();
return false;
}
else if(validar_numletras(formulario.pasaporte.value)==false){
    document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>FAVOR INGRESAR DATOS ALFANUMERICOS EN EL CAMPO</div>';
    formulario.pasaporte.focus();
    return false; 
}
else{
    document.getElementById("alerta").innerHTML="";
}*/
 


      //VALIDAR CAMPO DIRECCION
      if (formulario.direccion.value=="") {
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO DIRECCION VACIO</div>';
        formulario.direccion.focus();
        return false;
      }
      else if(Validar_espacio2(formulario.direccion.value)==false){
        document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIO EN EL CAMPO</div>';
        formulario.direccion.focus();
        return false;
    }
        formulario.submit();
    }


 //VALLIDAR FORMULARIO INSERTAR PACIENTE VISTA

 function validar_paciente(){
    var formulario=document.form_paciente;

    if (formulario.nombres.value=="") {
        document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO NOMBRES VACIO</div>';
        formulario.nombres.focus();
        return false;
    }
    else if (Validar_espacio2 (formulario.nombres.value)==false){
        document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIOS EN EL CAMPO</div>';
        formulario.nombres.focus();
        return false;
        }
    else if (validar_texto (formulario.nombres.value)==false){
        document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>FAVOR INTRODUCIR DATOS TIPO TEXTO, SIN ESPACIOS AL INICIO O FINAL DEL TEXTO EN EL CAMPO</div>';
        formulario.nombres.focus();
        return false;
        }
        else if (validar_tamaño (formulario.nombres.value)==false){
            document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE CARACTERES EN EL CAMPO</div>';
            formulario.nombres.focus();
            return false;
            }
            
    else{
            document.getElementById("alerta1").innerHTML="";
        }
//VALIDAR CAMPO APELLIDO
if (formulario.apellidos.value=="") {
    document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO APELLIDOS VACIO</div>';
    formulario.apellidos.focus();
    return false;
}

else if (Validar_espacio2 (formulario.apellidos.value)==false){
    document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIOS EN EL CAMPO</div>';
    formulario.apellido.focus();
    return false;
    }
else if (validar_texto (formulario.apellidos.value)==false){  
    document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>FAVOR INTRODUCIR DATOS TIPO TEXTO, SIN ESPACIOS AL INICIO O FINAL DEL TEXTO EN EL CAMPO</div>';
    formulario.apellidos.focus();
    return false;
    }
    else if (validar_tamaño (formulario.apellidos.value)==false){
        document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE CARACTERES EN EL CAMPO APELLIDOS</div>';
        formulario.apellidos.focus();

        return false;
        }          
    else{
        document.getElementById("alerta1").innerHTML="";
    }

    //VALIDAR CAMPO identidad
    if (formulario.numero_de_identidad.value=="") {
        document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO IDENTIDAD VACIO</div>';
        formulario.numero_de_identidad.focus();
        return false;
    }
    else if (formulario.numero_de_identidad.value=="0000-0000-00000") {
        document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO IDENTIDAD  INCORRECTO</div>';
        formulario.numero_de_identidad.focus();
        return false;
    }
    else if(validar_identidad(formulario.numero_de_identidad.value)==false){
        document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO NUMERO DE IDENTIDAD INVALIDO </div>';
        formulario.numero_de_identidad.focus();
        return false;
    }
//VALIDAR FECHA 
if (formulario.fecha_de_nacimiento.value==0) {
    document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO FECHA VACIO, FAVOR ENTRODUCIR UNA FECHA</div>';
    formulario.fecha_de_nacimiento.focus();
    return false;
} 
else{
    document.getElementById("alerta1").innerHTML="";
}

//VALIDAR CAMPO GENERO
if (formulario.genero.value==0) {
    document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO GENERO VACIO, FAVOR ELEGIR UN GENERO</div>';
    formulario.genero.focus();
    return false;
}
else{
    document.getElementById("alerta1").innerHTML="";
}
    //VALIDAR CAMPO RTN
         
        //  if (formulario.rtn.value==""){
        //     document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO RTN VACIO</div>';
        //     formulario.rtn.focus();
        //     return false;
        //     }
        //     else if (validar_rtn(formulario.rtn.value)==false){
        //         document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO RNT INVALIDO</div>';
        //     formulario.rtn.focus();
        //     return false; 
        //     }

          //VALIDAR NACIONALIDAD
          if (formulario.nacionalidad.value==0) {
            document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO NACIONALIDAD VACIO, SELECCIONE UNA OPCION.</div>';
            formulario.nacionalidad.focus();
            return false;
        }  

        //VALIDAR PROFESIÓN
        if (formulario.profesion.value==0) {
            document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO PROFESIÓN VACIO, SELECCIONE UNA OPCION.</div>';
            formulario.profesion.focus();
            return false;
        }  
          
        

          
            //VALIDAR CAMPO PASAPORTE
            // if (formulario.pasaporte.value=="") {
            //     document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO PASAPORTE VACIO</div>';
            //     formulario.pasaporte.focus();
            //     return false;
            // }            

        // if (validar_texto (formulario.pasaporte.value)==false){  
        //         document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>FAVOR INTRODUCIR DATOS TIPO TEXTO EN EL CAMPO</div>';
        //         formulario.pasaporte.focus();
        //         return false;
        //         } 
        //     else
         /*if (Validar_espacio2 (formulario.pasaporte.value)==false){
            document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIOS EN EL CAMPO</div>';
            formulario.pasaporte.focus();
            return false;
            }
            else if(validar_numletras(formulario.pasaporte.value)==false){
                document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>FAVOR INGRESAR DATOS ALFANUMERICOS EN EL CAMPO</div>';
                formulario.pasaporte.focus();
                return false; 
            }*/

             //VALIDAR CAMPO CELULAR
        if (formulario.numero_de_celular.value=="") {
            document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO NUMERO DE CELULAR VACIO</div>';
            formulario.numero_de_celular.focus();
            return false;
        }
        else if (validar_telefono(formulario.numero_de_celular.value)==false){
            document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO NUMERO CELULAR INVALIDO</div>';
            formulario.numero_de_celular.focus();
            return false; 
        }

 //VALIDAR CAMPO TELEFONO

if (formulario.numero_de_telefono_fijo.value==""){
    document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO NUMERO DE TELEFONO FIJO VACIO</div>';
    formulario.numero_de_telefono_fijo.focus();
    return false;
    }
    else if (validar_telefono(formulario.numero_de_telefono_fijo.value)==false){
        document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO NUMERO TELEFONO INVALIDO</div>';
        formulario.numero_de_telefono_fijo.focus();
        return false; 
    }
         
 
//VALIDAR CORREO
if (formulario.correo.value=="") {

    document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO CORREO VACIO</div>';
    formulario.correo.focus();
    return false;  
}
else if (validar_tamaño (formulario.correo.value)==false){
    document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE CARACTERES EN EXCESO EN EL CAMPO CORREO</div>';
    formulario.correo.focus();
    return false; 
    }
     else if (Validar_correo(formulario.correo.value)== false){
        document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>PORFAVOR INGRESAR UN CORREO VALIDO</div>';
        formulario.correo.value="";
        formulario.correo.focus();
        return false; 
     }
    
  
    
      //VALIDAR CAMPO DIRECCION
      if (formulario.direccion.value=="") {
        document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO DIRECCION VACIO</div>';
        formulario.direccion.focus();
        return false;
    }
    else if(Validar_espacio2(formulario.direccion.value)==false){
        document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIO EN EL CAMPO</div>';
        formulario.direccion.focus();
        return false;
    }
        formulario.submit();
    }

//VALIDAR FORMULARIO EDITAR USU MODELO
    function validar_editar(){
        var formulario=document.Form_registrar;

        if (formulario.nombres.value=="") {
            document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO NOMBRES VACIO</div>';
            formulario.nombres.focus();
            return false;
        }
        else if (Validar_espacio2 (formulario.nombres.value)==false){
            document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIOS EN EL CAMPO</div>';
            formulario.nombres.focus();
            return false;
            }
        else if (validar_texto (formulario.nombres.value)==false){
            document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>FAVOR INTRODUCIR DATOS TIPO TEXTO, SIN ESPACIOS AL INICIO O FINAL DEL TEXTO EN EL CAMPO</div>';
            formulario.nombres.focus();
            return false;
            }
            else if (validar_tamaño (formulario.nombres.value)==false){
                document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE CARACTERES EN EL CAMPO</div>';
                formulario.nombres.focus();
                return false;
                }
                
        else{
                document.getElementById("alerta").innerHTML="";
            }
    //VALIDAR CAMPO APELLIDO
    if (formulario.apellidos.value=="") {
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO APELLIDOS VACIO</div>';
        formulario.apellidos.focus();
        return false;
    }
    else if (Validar_espacio2 (formulario.apellidos.value)==false){
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIOS EN EL CAMPO</div>';
        formulario.apellido.focus();
        return false;
        }
    else if (validar_texto (formulario.apellidos.value)==false){  
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>FAVOR INTRODUCIR DATOS TIPO TEXTO, SIN ESPACIOS AL INICIO O FINAL DEL TEXTO EN EL CAMPO</div>';
        formulario.apellidos.focus();
        return false;
        }
        else if (validar_tamaño (formulario.apellidos.value)==false){
            document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE CARACTERES EN EL CAMPO APELLIDOS</div>';
            formulario.apellidos.focus();
    
            return false;
            }
                   
        else{
            document.getElementById("alerta").innerHTML="";
        }
    //VALIDAR CAMPO USUARIO
    if (formulario.usum.value=="") {
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO USUARIO VACIO</div>';
        formulario.usum.focus();
        return false;
    }
    else if (validar_longitud (formulario.usum.value)==false){
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO USUARIO DEBE CONTENER AL MENOS (6) CARACTERES</div>';
        formulario.usum.focus();
        return false;
        }
    else if (Validar_espacio2 (formulario.usum.value)==false){
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIOS EN EL CAMPO</div>';
        formulario.usum.focus();
        return false;
        }
    else if (validar_texto (formulario.usum.value)==false){  
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>FAVOR INTRODUCIR DATOS TIPO TEXTO, SIN ESPACIOS AL INICIO O FINAL DEL TEXTO EN EL CAMPO</div>';
        formulario.usum.focus();
        return false;
        }            
        else{
            document.getElementById("alerta").innerHTML="";
        }
    
     //VALIDAR FECHA NACIMIENTO
     if (formulario.fecha_de_nacimiento.value==0) {
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO FECHA NACIMINETO VACIO, FAVOR ENTRODUCIR UNA FECHA</div>';
        formulario.fecha_de_nacimiento.focus();
        return false;
    } 
    
        //VALIDAR CAMPO identidad
        if (formulario.numero_de_identidad.value=="") {
            document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO IDENTIDAD VACIO</div>';
            formulario.numero_de_identidad.focus();
            return false;
        }
        else if (formulario.numero_de_identidad.value=="0000-0000-00000") {
            document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO IDENTIDAD  INCORRECTO</div>';
            formulario.numero_de_identidad.focus();
            return false;
        }
        else if (validar_identidad(formulario.numero_de_identidad.value)==false){
            document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO IDENTIDAD INVALIDO</div>';
            formulario.numero_de_identidad.focus();
            return false;
        }
    //VALIDAR RTN
    // if (formulario.rtn.value==""){
    //     document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO RTN VACIO</div>';
    //     formulario.rtn.focus();
    //     return false;
    // }
    // else if(validar_rtn(formulario.rtn.value)==false){
    //     document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO RTN INVALIDO</div>';
    //     formulario.rtn.focus();
    //     return false;
    // }
    
            //VALIDAR CAMPO CELULAR
            if (formulario.numero_de_celular.value=="") {
                document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO CELULAR VACIO</div>';
                formulario.numero_de_celular.focus();
                return false;
            }       
           else if (validar_telefono(formulario.numero_de_celular.value)==false) {
                document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO NUMERO DE CELULAR INVALIDO</div>';
                formulario.numero_de_celular.focus();
                return false;
            } 
     //VALIDAR CAMPO TELEFONO
    if (formulario.numero_de_telefono_fijo.value==""){
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIOS EN EL CAMPO</div>';
        formulario.numero_de_telefono_fijo.focus();
        return false;
        }
        else if (validar_telefono(formulario.numero_de_telefono_fijo.value)==false){
            document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO NUMERO DE TELEFONO INVALIDO</div>';
            formulario.numero_de_telefono_fijo.focus();
            return false;
            }
       
    //VALIDAR CAMPO GENERO
    if (formulario.genero.value==0) {
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO GENERO VACIO, FAVOR ELEGIR UN GENERO</div>';
        formulario.genero.focus();
        return false;
    } 
       
         //VALIDAR CAMPO NACIONALIDAD
         if (formulario.nacionalidad.value==0) {
            document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO NACIONALIDAD VACIO</div>';
            formulario.nacionalidad.focus();
            return false;
        }

 //VALIDAR CAMPO ESTADO
 if (formulario.combox2.value==0) {
    document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO ESTADO VACIO</div>';
    formulario.combox2.focus();
    return false;
}

    //VALIDAR CAMPO ROL
    if (formulario.rol_usuario.value==0) {
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO ROL VACIO</div>';
        formulario.rol_usuario.focus();
        return false;
    }
   
    
    //    //VALIDAR CAMPO PASAPORTE
    //  if (validar_texto (formulario.pasaporte.value)==false){  
    //     document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>FAVOR INTRODUCIR DATOS TIPO TEXTO EN EL CAMPO</div>';
    //     formulario.pasaporte.focus();
    //     return false;
    //     } 

    /* if (Validar_espacio2 (formulario.pasaporte.value)==false){
    document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIOS EN EL CAMPO</div>';
    formulario.pasaporte.focus();
    return false;
    }
    else if(validar_numletras(formulario.pasaporte.value)==false){
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>FAVOR INGRESAR DATOS ALFANUMERICOS EN EL CAMPO</div>';
        formulario.pasaporte.focus();
        return false; 
    }*/

    //VALIDAR CORREO
    if (formulario.correo.value=="") {
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO CORREO VACIO</div>';
        formulario.correo.focus();
        return false;  
    }
    else if (validar_tamaño (formulario.correo.value)==false){
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE CARACTERES EN EXCESO EN EL CAMPO CORREO</div>';
        formulario.correo.focus();
        return false; 
        }
         else if (Validar_correo(formulario.correo.value)== false){
            document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>PORFAVOR INGRESAR UN CORREO VALIDO</div>';
            formulario.correo.value="";
            formulario.correo.focus();
            return false; 
         } 
    
          //VALIDAR CAMPO DIRECCION
          if (formulario.direccion.value=="") {
            document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO DIRECCION VACIO</div>';
            formulario.direccion.focus();
            return false;
          }
          else if(Validar_espacio2(formulario.direccion.value)==false){
            document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIO EN EL CAMPO</div>';
            formulario.direccion.focus();
            return false;
        }
            formulario.submit();
        }
    

//VALIDAR FORMULARIO EDITAR PACIENTES
        function validar_editar_paciente(){
            var formulario=document.form_editar_paciente;
        
            if (formulario.nombres.value=="") {
                document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO NOMBRES VACIO</div>';
                formulario.nombres.focus();
                return false;
            }
            else if (Validar_espacio2 (formulario.nombres.value)==false){
                document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIOS EN EL CAMPO</div>';
                formulario.nombres.focus();
                return false;
                }
            else if (validar_texto (formulario.nombres.value)==false){
                document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>FAVOR INTRODUCIR DATOS TIPO TEXTO, SIN ESPACIOS AL INICIO O FINAL DEL TEXTO EN EL CAMPO</div>';
                formulario.nombres.focus();
                return false;
                }
                else if (validar_tamaño (formulario.nombres.value)==false){
                    document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE CARACTERES EN EL CAMPO</div>';
                    formulario.nombres.focus();
                    return false;
                    }
                    
            else{
                    document.getElementById("alerta1").innerHTML="";
                }
        //VALIDAR CAMPO APELLIDO
        if (formulario.apellidos.value=="") {
            document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO APELLIDOS VACIO</div>';
            formulario.apellidos.focus();
            return false;
        }
        
        else if (Validar_espacio2 (formulario.apellidos.value)==false){
            document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIOS EN EL CAMPO</div>';
            formulario.apellido.focus();
            return false;
            }
        else if (validar_texto (formulario.apellidos.value)==false){  
            document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>FAVOR INTRODUCIR DATOS TIPO TEXTO, SIN ESPACIOS AL INICIO O FINAL DEL TEXTO EN EL CAMPO</div>';
            formulario.apellidos.focus();
            return false;
            }
            else if (validar_tamaño (formulario.apellidos.value)==false){
                document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE CARACTERES EN EL CAMPO APELLIDOS</div>';
                formulario.apellidos.focus();
        
                return false;
                }          
            else{
                document.getElementById("alerta1").innerHTML="";
            }
            //VALIDAR CAMPO identidad
            if (formulario.numero_de_identidad.value=="") {
                document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO IDENTIDAD VACIO</div>';
                formulario.numero_de_identidad.focus();
                return false;
            }
            else if (formulario.numero_de_identidad.value=="0000-0000-00000") {
                document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO IDENTIDAD  INCORRECTO</div>';
                formulario.numero_de_identidad.focus();
                return false;
            }
            else if (Validar_espacio2 (formulario.numero_de_identidad.value)==false){
                document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIOS EN EL CAMPO</div>';
                formulario.numero_de_identidad.focus();
                return false;
                }
                else if(validar_identidad(formulario.numero_de_identidad.value)==false){
                    document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>NUMERO DE IDENTIDAD INVALIDO</div>';
                    formulario.numero_de_identidad.focus();
                    return false;
                }
        //VALIDAR FECHA 
        if (formulario.fecha_de_nacimiento.value==0) {
            document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO FECHA VACIO, FAVOR ENTRODUCIR UNA FECHA</div>';
            formulario.fecha_de_nacimiento.focus();
            return false;
        } 
         //VALIDAR CAMPO GENERO
         if (formulario.genero.value==0) {
            document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO GENERO VACIO, FAVOR ELEGIR UN GENERO</div>';
            formulario.genero.focus();
            return false;
        } 
                //VALIDAR CAMPO RTN
                 
                //  if (Validar_espacio2 (formulario.rtn.value)==false){
                //     document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIOS EN EL CAMPO</div>';
                //     formulario.rtn.focus();
                //     return false;
                //     }
                  //VALIDAR NACIONALIDAD
                  if (formulario.nacionalidad.value==0) {
                    document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO NACIONALIDAD VACIO, SELECCIONE UNA OPCION.</div>';
                    formulario.nacionalidad.focus();
                    return false;
                }
                
                else if (Validar_espacio2 (formulario.nacionalidad.value)==false){
                    document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIOS EN EL CAMPO</div>';
                    formulario.nacionalidad.focus();
                    return false;
                    }
              // VALIDAR CAMPO PROFESION/OCUPACIÓN    
                    if (formulario.profesion.value==0) {
                        document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO PROFESION VACIO, SELECCIONE UNA OPCION.</div>';
                        formulario.profesion.focus();
                        return false;
                    }
               
                    //VALIDAR CAMPO PASAPORTE
                 /*if (Validar_espacio2 (formulario.pasaporte.value)==false){
                    document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIOS EN EL CAMPO</div>';
                    formulario.pasaporte.focus();
                    return false;

                    }
                    else if(validar_numletras(formulario.pasaporte.value)==false){
                        document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>FAVOR INGRESAR DATOS ALFANUMERICOS EN EL CAMPO</div>';
                        formulario.pasaporte.focus();
                        return false; 
                    }
                    else{
                        document.getElementById("alerta1").innerHTML="";
                    }
                    //  if (validar_texto (formulario.pasaporte.value)==false){  
                    //     document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>FAVOR INTRODUCIR DATOS TIPO TEXTO EN EL CAMPO</div>';
                    //     formulario.pasaporte.focus();
                    //     return false;
                    //     }*/

                     //VALIDAR CAMPO CELULAR
                if (formulario.numero_de_celular.value=="") {
                    document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO CELULAR VACIO</div>';
                    formulario.numero_de_celular.focus();
                    return false;
                }
                
                else if (Validar_espacio2 (formulario.numero_de_celular.value)==false){
                    document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIOS EN EL CAMPO</div>';
                    formulario.numero_de_celular.focus();
                    return false;
                    }
                    else if(validar_telefono(formulario.numero_de_celular.value)==false){
                        document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>NUMERO DE CELULAR INVALIDO</div>';
                        formulario.numero_de_celular.focus();
                        return false;
                    }
         //VALIDAR CAMPO TELEFONO
        
        if (Validar_espacio2 (formulario.numero_de_telefono_fijo.value)==false){
            document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIOS EN EL CAMPO</div>';
            formulario.numero_de_telefono_fijo.focus();
            return false;
            }
                 
      
        //VALIDAR CORREO
        if (formulario.correo.value=="") {
        
            document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO CORREO VACIO</div>';
            formulario.correo.focus();
            return false;  
        }
        else if (validar_tamaño (formulario.correo.value)==false){
            document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE CARACTERES EN EXCESO EN EL CAMPO CORREO</div>';
            formulario.correo.focus();
            return false; 
            }
             else if (Validar_correo(formulario.correo.value)== false){
                document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>PORFAVOR INGRESAR UN CORREO VALIDO</div>';
                formulario.correo.value="";
                formulario.correo.focus();
                return false; 
             }
       
              //VALIDAR CAMPO DIRECCION
              if (formulario.direccion.value==0) {
                document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO DIRECCION VACIO</div>';
                formulario.direccion.focus();
                return false;
            }
            else if(Validar_espacio2(formulario.direccion.value)==false){
                document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIO EN EL CAMPO</div>';
                formulario.direccion.focus();
                return false;
            }
                formulario.submit();
            }       

            //VALIDAR EDITAR PERMISO
            function validar_permisos(){
            var formulario_permiso=document.formulario_permiso;
           
             if (formulario_permiso.buscar.value=="") {
                document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO INGRESE EL NOMBRE DEL ROL VACIO.</div>';
                formulario_permiso.buscar.focus();
                return false;
            }
            else if (Validar_espacio2(formulario_permiso.buscar.value)==false){
                document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIO EN EL CAMPO</div>';
                formulario_permiso.buscar.focus();
                return false;
             }
            else if(validar_texto(formulario_permiso.buscar.value)==false){
                document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>FAVOR INTRODUCIR DATOS TIPO TEXTO, SIN ESPACIOS AL INICIO O FINAL DEL TEXTO EN EL CAMPO</div>';
                formulario_buscar.buscar.focus();
                return false;
            }
            else{
                document.getElementById("alerta").innerHTML="";
            }

            formulario_permiso.submit();
            }

 //VALIDAR FORMULARIO DE EXPEDIENTE

 function validar_expediente(){
     var formulario_exp=document.form_exp;

     if (formulario_exp.peso.value==""){
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO PESO VACIO</div>';
        formulario_exp.peso.focus();
        return false;
     }
     
    //VALIDAR ESTATURA
    if (formulario_exp.estatura.value==""){
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO ESTATURA VACIO</div>';
        formulario_exp.estatura.focus();
        return false;
     }
    



//VALIDAR ANTECEDENTES
if (formulario_exp.antecedentes.value==0){
    document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO ANTECEDENTES VACIO</div>';
    formulario_exp.antecedentes.focus();
    return false;
}

//VALIDAR DIETA
if (formulario_exp.dieta.value==0){
    document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO DIETA VACIO</div>';
    formulario_exp.dieta.focus();
    return false;
}

 //VALIDAR FECHA

 if (formulario_exp.fecha_de_creacion.value==""){
    document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO FECHA CREACION VACIO</div>';
    formulario_exp.fecha_de_creacion.focus();
    return false;
 }
     formulario_exp.submit();
 }


 //VALIDAR FORMULARIO ROL (EDITAR Y INSERTAR)
 function validar_rol(){
     var formulario=document.form_rol;
     if(formulario.rol.value==""){
        document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO ROL VACIO</div>';
        formulario.rol.focus();
        return false;
    }
    else if(Validar_espacio2(formulario.rol.value)==false){
        document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMTE DE ESPACIO EN EL CAMPO</div>';
        formulario.rol.focus();
        return false;
    }
    else if(validar_texto(formulario.rol.value)==false){
        document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>FAVOR INTRODUCIR DATOS TIPO TEXTO, SIN ESPACIOS AL INICIO O FINAL DEL TEXTO EN EL CAMPO</div>';
        formulario.rol.focus();
        return false;
    }
    if(formulario.descrip.value==""){
        document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO DESCRIPCION VACIO</div>';
        formulario.descrip.focus();
        return false;
    }
    else if(Validar_espacio2(formulario.descrip.value)==false){
        document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMTE DE ESPACIO EN EL CAMPO</div>';
        formulario.descrip.focus();
        return false;
    }
    else if(validar_texto(formulario.descrip.value)==false){
        document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>FAVOR INTRODUCIR DATOS TIPO TEXTO, SIN ESPACIOS AL INICIO O FINAL DEL TEXTO EN EL CAMPO</div>';
        formulario.descrip.focus();
        return false;
    }
formulario.submit(); 
}

//VALIDAR FORMULARIO INSERTAR CITA
function validar_cita(){
    var formulario=document.form_cita;
    if(formulario.fecha_cita.value==0){
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO FECHA CITA VACIO</div>';
        formulario.fecha_cita.focus();
        return false;
    }
    //VALIDAR CAMPO HORA INCIO
    if(formulario.hora_cita.value==0){
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO HORA CITA VACIO</div>';
        formulario.hora_cita.focus();
        return false;
    }
  
    //VALIDAR CAMPO DOCTORA
if(formulario.doctora.value==0){
    document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO DOCTORA VACIO, SELECCIONE UNA OPCION</div>';
    formulario.doctora.focus();
    return false;
}
  //VALIDAR CAMPO ESTADO
//   if(formulario.estado.value==0){
//     document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO ESTADO VACIO, SELECCIONE UNA OPCION</div>';
//     formulario.estado.focus();
//     return false;
// }

    formulario.submit();
}

//VALIDAR FORMULARIO EDITAR CITA
function validar_cita2(){
    var formulario=document.form_editar_cita;
    if(formulario.fecha_cita.value==0){
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO FECHA CITA VACIO</div>';
        formulario.fecha_cita.focus();
        return false;
    }
    //VALIDAR CAMPO HORA INCIO
    if(formulario.hora_cita.value==0){
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO HORA INICIO VACIO</div>';
        formulario.hora_cita.focus();
        return false;
    }
  
    //VALIDAR CAMPO DOCTORA
if(formulario.doctora.value==0){
    document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO DOCTORA VACIO, SELECCIONE UNA OPCION</div>';
    formulario.doctora.focus();
    return false;
}
  //VALIDAR CAMPO ESTADO
  if(formulario.estado.value==0){
    document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO ESTADO VACIO, SELECCIONE UNA OPCION</div>';
    formulario.estado.focus();
    return false;
}
//VALIDAR CAMPO DESCRIPCION
if (formulario.descrip.value=="") {
    document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO DESCRIPCION VACIO, DEBE ESPECIFICAR POR QUE CAMBIA LA CITA.</div>';
    formulario.descrip.focus();
    return false;
}

else if (Validar_espacio2 (formulario.descrip.value)==false){
    document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIOS EN EL CAMPO</div>';
    formulario.descrip.focus();
    return false;
    }


    formulario.submit();
}




//VALIDAR FORMULARIO PARAMETROS
function validar_parametros(){
    var formulario=document.form_parametros;
    if(formulario.valor.value==""){
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO VALOR VACIO</div>';
        formulario.valor.focus();
        return false;   
    }
    else if(Validar_espacio2(formulario.valor.value)==false){
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIO EN EL CAMPO</div>';
        formulario.valor.focus();
        return false;
    }
    else{
        document.getElementById("alerta").innerHTML="";
    }
    
    

    formulario.submit();
}

//VALIDAR FORMULARIO INSERTAR DOCTORA
function validar_doctora(){
    var formulario=document.form_doctora;
    //VALIDAR CAMPO APUNTES
    if(formulario.apuntes.value==0){
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO APUNTES DE LA CONSULTA VACIO</div>';
        formulario.apuntes.focus();
        return false; 
    }
    else if(Validar_espacio2(formulario.apuntes.value)==false){
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIO EN EL CAMPO</div>';
        formulario.apuntes.focus();
        return false;
    }
//CAMPO MEDICAMENTO
if(formulario.medicamento.value==0){
    document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO MEDICAMENTO VACIO</div>';
    formulario.medicamento.focus();
    return false; 
}
else if(Validar_espacio2(formulario.medicamento.value)==false){
    document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIO EN EL CAMPO</div>';
    formulario.medicamento.focus();
    return false;
}
//VALIDAR CAMPO FECHA
if(formulario.fecha_de_creacion.value==0){
    document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO FECHA DE CREACION VACIO</div>';
    formulario.fecha_de_creacion.focus();
    return false; 
}

    formulario.submit();
}

//VALIDAR FORM PROFESIÓN
function validar_profesion(){
var formulario=document.formulario_profe;
if (formulario.profesion.value=="") {
    document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO PROFESION/OCUPACION VACIO.</div>';
    formulario.profesion.focus();
    return false;
} 
else if(Validar_espacio2(formulario.profesion.value)==false){
    document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIO EN EL CAMPO</div>';
    formulario.profesion.focus();
    return false;
}
else if(validar_texto(formulario.profesion.value)==false){
    document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>FAVOR INTRODUCIR DATOS TIPO TEXTO, SIN ESPACIOS AL INICIO O FINAL DEL TEXTO EN EL CAMPO</div>';
    formulario.profesion.focus();
    return false;
}
else if(validar_tamaño(formulario.profesion.value)==false){
    document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LONGITUD DEL CAMPO PROFESION/OCUPACION</div>';
    formulario.profesion.focus();
    return false;
}
else{
    document.getElementById("alerta").innerHTML="";
}
formulario.submit();
}

//VAIDAR EDITAR PROFESION/ocupacion
function validar_profe(){
    var formulario=document.form_profe;
    if (formulario.nombre.value=="") {
        document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO ACTUALIZAR PROFESION/OCUPACION VACIO.</div>';
        formulario.nombre.focus();
        return false;
    } 
    else if(Validar_espacio2(formulario.nombre.value)==false){
        document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIO EN EL CAMPO</div>';
        formulario.nombre.focus();
        return false;
    }
    else if(validar_texto(formulario.nombre.value)==false){
        document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>FAVOR INTRODUCIR DATOS TIPO TEXTO, SIN ESPACIOS AL INICIO O FINAL DEL TEXTO EN EL CAMPO</div>';
        formulario.nombre.focus();
        return false;
    }
    else if(validar_tamaño(formulario.nombre.value)==false){
        document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LONGITUD DEL CAMPO ACTUALIZAR PROFESION/OCUPACION</div>';
        formulario.nombre.focus();
        return false;
    }
    else{
        document.getElementById("alerta1").innerHTML="";
    }
    
    formulario.submit();
    }
//FORMULARIO DEL PREGUNTAS
function validar_pregunta(){
    var formulario=document.formulario_pregunta;
    if (formulario.pregunta.value=="") {
        document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO PREGUNTA DE SEGURIDAD VACIO.</div>';
        formulario.pregunta.focus();
        return false;
    } 
    else if(Validar_espacio2(formulario.pregunta.value)==false){
        document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIO EN EL CAMPO</div>';
        formulario.pregunta.focus();
        return false;
    }
    else if(validar_tamaño(formulario.pregunta.value)==false){
        document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LONGITUD DEL CAMPO PREGUNTA DE SEGURIDAD</div>';
        formulario.pregunta.focus();
        return false;
    }
    else{
        document.getElementById("alerta1").innerHTML="";
    }
    
    formulario.submit();
    }
    //VALIDAR FORMULARIO EDITAR PREGUNTAS
    function validar_pregun(){
        var formulario=document.form_pregunta;
        if (formulario.nombre.value=="") {
            document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO INGRESE PREGUNTA VACIO.</div>';
            formulario.nombre.focus();
            return false;
        } 
        else if(Validar_espacio2(formulario.nombre.value)==false){
            document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIO EN EL CAMPO</div>';
            formulario.nombre.focus();
            return false;
        }
        else if(validar_tamaño(formulario.nombre.value)==false){
            document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LONGITUD DEL CAMPO INGRESE PREGUNTA</div>';
            formulario.nombre.focus();
            return false;
        }
        else{
            document.getElementById("alerta1").innerHTML="";
        }
        
        formulario.submit();
        }
        //VALIDAR FORMULARIO VISTA BITACORA LOS FILTROS
        function validar_bitacora(){
            var formulario=document.formulario_bitacora;
            
            if (formulario.desde.value==""){
                document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO FECHA "DESDE" VACIO</div>';
                formulario.desde.focus();
                return false;
             }

             if (formulario.hasta.value==""){
                document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO FECHA "HASTA" VACIO</div>';
                formulario.hasta.focus();
                return false;
             }
             
             //VALIDAR RANGO DE FECHA
             if(formulario.desde.value > formulario.hasta.value){
                document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LA FECHA "DESDE" NO PUEDE SER MAYOR QUE LA FHECHA "HASTA" </div>';
                formulario.desde.focus();
                formulario.hasta.focus();
                return false;
            }

            else{
                document.getElementById("alerta").innerHTML="";
            }

                 formulario.submit();
             }
             //VALIDAR FORMULARIO REPORTE CITA.
        function validar_reporte_cita(){
            var formulario=document.formulario_reporte_cita;
            if (formulario.doctora.value=="0"){
                document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO "DOCTORA/DOCTOR/NUTRICIONISTA" VACIO, SELECIONAR UNA OPCIÓN.</div>';
                formulario.doctora.focus();
                return false;
             }
             if (formulario.est_c.value=="0"){
                document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO "ESTADO" VACIO, SELECCIONAR UNA ACCIÓN</div>';
                formulario.est_c.focus();
                return false;
             }
            else if (formulario.desde.value==""){
                document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO FECHA "DESDE" VACIO</div>';
                formulario.desde.focus();
                return false;
             }
            else if (formulario.hasta.value==""){
                document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO FECHA "HASTA" VACIO</div>';
                formulario.hasta.focus();
                return false;
             }
             //VALIDAR RANGO DE FECHA
             if(formulario.desde.value > formulario.hasta.value){
                document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LA FECHA "DESDE" NO PUEDE SER MAYOR QUE LA FECHA "HASTA" </div>';
                formulario.desde.focus();
                formulario.hasta.focus();
                return false;
            }
             else{
                document.getElementById("alerta").innerHTML="";
            }

                 formulario.submit();
             }
        //VALIDAR FORMULARIO DE PANTALLAS
        function validar_pantalla(){
            var formulario=document.form_pantalla;
            if (formulario.descripcion.value=="") {
                document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO DESCRIPCIÓN VACIO.</div>';
                formulario.descripcion.focus();
                return false;
            } 
            else if(Validar_espacio2(formulario.descripcion.value)==false){
                document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIO EN EL CAMPO</div>';
                formulario.descripcion.focus();
                return false;
            }
            else if(validar_texto(formulario.descripcion.value)==false){
                document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>FAVOR INTRODUCIR DATOS TIPO TEXTO, SIN ESPACIOS AL INICIO O FINAL DEL TEXTO EN EL CAMPO</div>';
                formulario.descripcion.focus();
                return false;
            }
            else if(validar_tamaño(formulario.descripcion.value)==false){
                document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LONGITUD DEL CAMPO DESCRIPCIÓN</div>';
                formulario.descripcion.focus();
                return false;
            }
            else{
                document.getElementById("alerta1").innerHTML="";
            }
            
            formulario.submit();
        }
//VALIDAR FORMULARIO NACIONALIDADES
function validar_pais(){
    var formulario=document.form_pais;
    if (formulario.pais.value=="") {
        document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO INGRESE LA NACIONALIDAD VACIO.</div>';
        formulario.pais.focus();
        return false;
    } 
    else if(Validar_espacio2(formulario.pais.value)==false){
        document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIO EN EL CAMPO</div>';
        formulario.pais.focus();
        return false;
    }
    else if(validar_texto(formulario.pais.value)==false){
        document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>FAVOR INTRODUCIR DATOS TIPO TEXTO, SIN ESPACIOS AL INICIO O FINAL DEL TEXTO EN EL CAMPO</div>';
        formulario.pais.focus();
        return false;
    }
    else if(validar_tamaño(formulario.pais.value)==false){
        document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LONGITUD DEL CAMPO INGRESE LA NACIONALIDAD</div>';
        formulario.pais.focus();
        return false;
    }
    else{
        document.getElementById("alerta1").innerHTML="";
    }
    
    formulario.submit();
    }

    //VALIDAR FORMULARIO EDITAR NACIONALIDADES
    function validar_editar_pais(){
        var formulario=document.form_editar_pais;
        if (formulario.nombre.value=="") {
            document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO NACIONALIDAD VACIO.</div>';
            formulario.nombre.focus();
            return false;
        } 
        else if(Validar_espacio2(formulario.nombre.value)==false){
            document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIO EN EL CAMPO</div>';
            formulario.nombre.focus();
            return false;
        }
        else if(validar_texto(formulario.nombre.value)==false){
            document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>FAVOR INTRODUCIR DATOS TIPO TEXTO, SIN ESPACIOS AL INICIO O FINAL DEL TEXTO EN EL CAMPO</div>';
            formulario.nombre.focus();
            return false;
        }
        else if(validar_tamaño(formulario.nombre.value)==false){
            document.getElementById("alerta1").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LONGITUD DEL CAMPO NACIONALIDAD</div>';
            formulario.nombre.focus();
            return false;
        }
        else{
            document.getElementById("alerta1").innerHTML="";
        }
        
        formulario.submit();
        }
//VALIDAR FORMULARIO EXPEDIENTEN
function validar_expedienten(){
    var formulario=document.formulario_expedienten;
    if (formulario.buscar.value=="") {
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO INGRESE NÚMERO DE IDENTIDAD VACIO.</div>';
        formulario.buscar.focus();
        return false;
    } 
    else{
        document.getElementById("alerta").innerHTML="";
    }
    
    formulario.submit();
    }
 //VALIDAR FORMULARIO EXPEDIENTEd
function validar_expediented(){
    var formulario=document.formulario_expediented;
    if (formulario.buscar.value=="") {
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO INGRESE NÚMERO DE IDENTIDAD VACIO.</div>';
        formulario.buscar.focus();
        return false;
    } 
    else{
        document.getElementById("alerta").innerHTML="";
    }
    
    formulario.submit();
    }   
//VALIDAR FORMULARIO PARAMETROS
function validar_permiso(){
var formulario=document.Form_registrar;

//CAMPO ROL
if (formulario.r.value==0) {
    document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO ROL VACIO, SELECCIONE UNA OPCION.</div>';
    formulario.r.focus();
    return false;
} 

//CAMPO PANTALLA
if (formulario.o.value==0) {
    document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO PANTALLA VACIO, SELECCIONE UNA OPCION.</div>';
    formulario.o.focus();
    return false;
} 
formulario.submit();
}