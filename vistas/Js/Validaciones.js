//FUNCIONES GLOBALES
 function mostrarPassword(){
    var cambio = document.getElementById ("contra");
    if (cambio.type == "password"){
        cambio.type="text";
        $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
        }else{
            cambio.type="password";
            $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
        }
    }
    function mostrarPassword2(){
        var cambio1 = document.getElementById ("confirmar_contra");
        if (cambio1.type == "password"){
            cambio1.type="text";
            $('.icon1').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
            }else{
                cambio1.type="password";
                $('.icon1').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
            }
        }
    function mostrarPassword_login(){
        var cambio2 = document.getElementById ("contra2");
        if (cambio2.type == "password"){
            cambio2.type="text";
                $('.icon2').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
                }else{
                 cambio2.type="password";
                  $('.icon2').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
            }
        }
        function mostrarPassword_recuperarcontra(){
                    var cambio3 = document.getElementById ("nueva_contra");
                    if (cambio3.type == "password"){
                        cambio3.type="text";
                            $('.icon3').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
                            }else{
                             cambio3.type="password";
                              $('.icon3').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
                        }
                    }
    function mostrarPassword_recuperarcontra2(){
            var cambio4 = document.getElementById ("confirmar_contra2");
            if (cambio4.type == "password"){
                cambio4.type="text";
                    $('.icon4').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
                    }else{
                     cambio4.type="password";
                        $('.icon4').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
                    }
                }

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

               //VALIDAR SOLO NUMEROS
               function Validar_numero(parametro){
                var Numero=/^[0-9]*$/;
                if(!Numero.test(parametro)){
                   return False; 
                }else{
                    return True;
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
                 if(parametro.length >50){
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

//VALIDACIONES DE MODULO DE REGISTRO
                function validar_registro() {
                    //alert('todo bien');
                    var formulario= document.Form_registrar;
                //VALIDAR NOMBRE(VACIO QUE NO CONTENGA NUMEROS)
                    if (formulario.nombres.value=="") {
                        //alert('Campos vacios');
                        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO NOMBRES VACIO</div>';
                        formulario.nombres.focus();
                        return false;
                    }
                        else if (Validar_espacio2(formulario.nombres.value)==false){  
                            document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIOS EN EL CAMPO</div>';
                            formulario.nombres.focus();
                            return false;
                            }
                    else if (validar_texto (formulario.nombres.value)==false){
                        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO NOMBRES NO PUEDE CONTENER NUMEROS</div>';
                        formulario.nombres.focus();
                        formulario.nombres.value="";
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
                        //VALIDAR APELLIDOS
                        if (formulario.apellidos.value=="") {
                            //alert('Campos vacios');
                            document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO APELLIDOS VACIO</div>';
                            formulario.apellidos.focus();
                            return false;
                        }
                            else if (Validar_espacio2(formulario.apellidos.value)==false){  
                                document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIOS EN EL CAMPO</div>';
                                formulario.apellidos.focus();
                                return false;
                                }
                        else if (validar_texto (formulario.apellidos.value)==false){  
                            document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO APELLIDOS NO PUEDE CONTENER NUMEROS</div>';
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
                            //VALIDAR USUARIO
                            if (formulario.usuario.value=="") {
                                //alert('Campos vacios');
                                document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO USUARIO VACIO</div>';
                                formulario.usuario.focus();
                                return false;  
                                }
                                else if (validar_longitud(formulario.usuario.value)==false){  
                                    document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO USUARIO DEBE CONTENER AL MENOS (6) CARACTERES</div>';
                                    formulario.usuario.focus();
                                    return false;
                                 }
                                 else if (Validar_espacio(formulario.usuario.value)==false){  
                                    document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO USUARIO NO DEBE CONTENER ESPACIOS</div>';
                                    formulario.usuario.value="";
                                    return false;
                                 }
                                 else if (validar_texto (formulario.usuario.value)==false){
                                    document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO NOMBRES NO PUEDE CONTENER NUMEROS</div>';
                                    formulario.usuario.focus();
                                    return false;
                                    }

                                else{
                                    document.getElementById("alerta").innerHTML="";
                                }
                                //VALIDAR QUE LAS CONTRASEÑAS COINCIDAN
                                
                                        //VALIDAR CORREO
                                        if (formulario.correo.value=="") {
                                            //alert('Campos vacios');
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
                                            else{
                                                document.getElementById("alerta").innerHTML="";
                                            }
                    formulario.submit();
                    }
//VALIDACIONES DE LOGIN
                    function validar_login() {
                        //alert('todo bien');
                        var formulario_vista= document.Form_login;
                        if (formulario_vista.login.value=="") {
                            //alert('Campos vacios');
                            document.getElementById("alerta2").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO NOMBRE USUARIO SE ENCUENTRA VACIO</div>';
                            formulario_vista.login.focus();
                            return false; 
                            }
                            else if (Validar_espacio(formulario_vista.login.value)==false){  
                                document.getElementById("alerta2").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO NOMBRE DE USUARIO NO DEBE CONTENER ESPACIOS</div>';
                                formulario_vista.login.focus();
                                return false;
                                }
                                else if (validar_tamaño(formulario_vista.login.value)==false){
                                    document.getElementById("alerta2").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>EL CAMPO NOMBRE DE USUARIO DEBE DE CONTENER AL MENOS (6) CARACTERES</div>';
                                    formulario_vista.login.focus();
                                    return false;
                                    }
                            else if (validar_texto(formulario_vista.login.value)==false){
                                document.getElementById("alerta2").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO NOMBRE DE USUARIO  NO PUEDE CONTENER NUMEROS</div>';
                                formulario_vista.login.focus();
                                return false;
                                }
                              
                                    
                                       
                                        //VALIDACION DEL CAMPO CONTRASEÑA
                                        if (formulario_vista.contra2.value=="") {
                                            //alert('Campos vacios');
                                            document.getElementById("alerta2").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO CONTRASEÑA VACIO</div>';
                                            formulario_vista.contra2.focus();
                                            return false;  
                                        }
                                        else if (validar_limitcontraseña (formulario_vista.contra2.value)==false){  
                                            document.getElementById("alerta2").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>EL CAMPO CONTRASEÑA DEBE DE CONTENER AL MENOS(8) CARACTERES</div>';
                                            formulario_vista.contra2.focus();
                                            return false;
                                            }
                                            else if (Validar_espacio2(formulario_vista.contra2.value)==false){  
                                                document.getElementById("alerta2").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIOS EN EL CAMPO</div>';
                                                formulario_vista.contra2.focus();
                                                return false;
                                                }
                                                else if (Validar_espacio(formulario_vista.contra2.value)==false){  
                                                    document.getElementById("alerta2").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO CONTRASEÑA NO DEBE DE CONTENER ESPACIO</div>';
                                                    formulario_vista.contra2.focus();
                                                    return false;
                                                    }
                            formulario_vista.submit();
                        }
//VALIDACIONES DE RECUPERAR CONTRASEÑA
                    function Validar_recuperar(){
                        var formulario_recuperar= document.Form_recuperar;
                        if (formulario_recuperar.usuario2.value=="") {
                            //alert('Campos vacios');
                            document.getElementById("alerta3").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO NOMBRE USUARIO SE ENCUENTRA VACIO</div>';
                            formulario_recuperar.usuario2.focus();
                            return false; 
                            }
                            else if (Validar_espacio2(formulario_recuperar.usuario2.value)==false){  
                                document.getElementById("alerta3").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIOS EN EL CAMPO</div>';
                                formulario_recuperar.usuario2.focus();
                                return false;
                                }
                                else if (Validar_espacio(formulario_recuperar.usuario2.value)==false){  
                                    document.getElementById("alerta3").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO NOMBRE DE USUARIO NO DEBE CONTENER ESPACIOS</div>';
                                    formulario_recuperar.usuario2.focus();
                                    return false;
                                    }
                            else if (validar_texto(formulario_recuperar.usuario2.value)==false){
                                document.getElementById("alerta3").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO NOMBRE DE USUARIO  NO PUEDE CONTENER NUMEROS</div>';
                                formulario_recuperar.usuario2.focus();
                                return false;
                                }
                                else if (validar_tamaño(formulario_recuperar.usuario2.value)==false){
                                    document.getElementById("alerta3").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>EL CAMPO NOMBRE DE USUARIO DEBE DE CONTENER AL MENOS (6) CARACTERES</div>';
                                    formulario_recuperar.usuario2.focus();
                                    return false;
                                    }
                                   
                            formulario_recuperar.submit();
                      }
 //VALIDACIONES DE REESTABLECER CONTRASEÑA 
                   function Validar_reestablecer(){
                    var formulario_reestablecer= document.Form_reestablecer;
                    if (formulario_reestablecer.nueva_contra.value=="") {
                        //alert('Campos vacios');
                        //NUEVA CONTRASEÑAS
                        document.getElementById("alerta4").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO NUEVA CONTRASEÑA SE ENCUENTRA VACIO</div>';
                        formulario_reestablecer.nueva_contra.focus();
                        return false; 
                        }
                        else if (Validar_espacio (formulario_reestablecer.nueva_contra.value)==false){  
                            document.getElementById("alerta4").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>EL CAMPO  NUEVA CONTRASEÑA NO DEBE DE CONTENER ESPACIOS</div>';
                            formulario_reestablecer.nueva_contra.focus();
                            return false;
                            }
                            else if (Validar_espacio2(formulario_reestablecer.nueva_contra.value)==false){  
                                document.getElementById("alerta4").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIOS EN EL CAMPO</div>';
                                formulario_reestablecer.nueva_contra.focus();
                                return false;
                                }
                                else if (validar_contra3 (formulario_reestablecer.nueva_contra.value)==false){
                                    document.getElementById("alerta4").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LA CONTRASEÑA PERMITIDA DEBE SER LO MAS ROBUSTA POSIBLE, AL MENOS DEBE CONTENER 1 LETRA MINUSCULA, 1 LETRA MAYUSCULA, 1 CARÁCTER ESPECIAL, 1 NUMERO Y DEBE CONTENER 8 CARACTERES MINIMO.</div>';
                                    formulario_reestablecer.nueva_contra.focus();
                                    return false;
                            }
                           
                             
                          //VALIDAR CONFIRMAR CONTRASEÑA
                          if (formulario_reestablecer.confirmar_contra2.value=="") {
                            //NUEVA CONTRASEÑAS
                            document.getElementById("alerta4").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO CONFIRMAR CONTRASEÑA SE ENCUENTRA VACIO</div>';
                            formulario_reestablecer.confirmar_contra2.focus();
                            return false; 
                            }
                                else if (Validar_espacio (formulario_reestablecer.confirmar_contra2.value)==false){  
                                    document.getElementById("alerta4").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>EL CAMPO  NUEVA CONTRASEÑA NO DEBE DE CONTENER ESPACIOS</div>';
                                    formulario_reestablecer.confirmar_contra2.focus();
                                    return false;
                                    }
                                    else if (Validar_espacio2(formulario_reestablecer.confirmar_contra2.value)==false){  
                                        document.getElementById("alerta4").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIOS EN EL CAMPO</div>';
                                        formulario_reestablecer.confirmar_contra2.focus();
                                        return false;
                                        }
                                        else if (validar_contra3 (formulario_reestablecer.confirmar_contra2.value)==false){
                                            document.getElementById("alerta4").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LA CONTRASEÑA PERMITIDA DEBE SER LO MAS ROBUSTA POSIBLE, AL MENOS DEBE CONTENER 1 LETRA MINUSCULA, 1 LETRA MAYUSCULA, 1 CARÁCTER ESPECIAL, 1 NUMERO Y DEBE CONTENER 8 CARACTERES MINIMO.</div>';
                                            formulario_reestablecer.confirmar_contra2.focus();
                                            return false;
                                        }
                             
                                        //CONTRASEÑAS COINCIDAN
                            if(formulario_reestablecer.nueva_contra.value != formulario_reestablecer.confirmar_contra2.value){
                                document.getElementById("alerta4").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CONTRASEÑAS NO COINCIDEN </div>';
                                formulario_reestablecer.nueva_contra.focus();
                                formulario_reestablecer.confirmar_contra2.focus();
                                return false;
                            }
                        formulario_reestablecer.submit();
                        

                        }
                 




 //VALIDAR FORMULARIO MANTENIMINETO
 
 function validar_matenimiento(){
    var formulario_man=document.Form_registrar;

//VALIDAR NOMBRE(VACIO QUE NO CONTENGA NUMEROS)
    
if (formulario_man.nombre.value=="") {
    //alert('Campos vacios');
    document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO NOMBRES VACIO</div>';
    formulario_man.nombre.focus();
    return false;
}
else if (Validar_espacio2 (formulario_man.nombre.value)==false){
    document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIOS EN EL CAMPO</div>';
    formulario_man.nombre.focus();
    return false;
    }
else if (validar_texto (formulario_man.nombre.value)==false){
    document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO NOMBRES NO PUEDE CONTENER NUMEROS</div>';
    formulario_man.nombre.focus();
    return false;
    }
    else if (validar_tamaño (formulario_man.nombre.value)==false){
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE CARACTERES EN EL CAMPO</div>';
        formulario_man.nombre.focus();
        return false;
        }
        
else{
        document.getElementById("alerta").innerHTML="";
    }

//VALIDAR CAMPO APELLIDO
    if (formulario_man.apellido.value=="") {
        //alert('Campos vacios');
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO APELLIDOS VACIO</div>';
        formulario_man.apellido.focus();
        return false;
    }

    else if (Validar_espacio2 (formulario_man.apellido.value)==false){
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIOS EN EL CAMPO</div>';
        formulario_man.apellido.focus();
        return false;
        }
    else if (validar_texto (formulario_man.apellido.value)==false){  
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO APELLIDOS NO PUEDE CONTENER NUMEROS</div>';
        formulario_man.apellido.focus();
        return false;
        }
        else if (validar_tamaño (formulario_man.apellido.value)==false){
            document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE CARACTERES EN EL CAMPO APELLIDOS</div>';
            formulario_man.apellido.focus();
    
            return false;
            }
    //validar campo usuario
    if (formulario_man.usum.value==""){
         document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO USUARIO SE ENCUENTRA VACIO</div>';
         formulario_man.usum.focus();
          return false; 
 
    }
    else if (validar_longitud(formulario_man.usum.value)==false){
        document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO USUARIO DEBE CONTENER AL MENOS (6) CARACTERES</div>';
        formulario_man.usum.focus();
        return false;
        }
        else if (Validar_espacio(formulario_man.usum.value)==false){  
            document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO USUARIO NO DEBE CONTENER ESPACIOS</div>';
            formulario_man.usum.focus();
            return false;
         }
         else if (validar_texto (formulario_man.usum.value)==false){
            document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO NOMBRES NO PUEDE CONTENER NUMEROS</div>';
            formulario_man.usum.focus();
            return false;
            }

        else{
            document.getElementById("alerta").innerHTML="";
        }



                            //validar campo Rol
                            

                                if (formulario_man.combox.value==0){
                                    document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>SELECIONE UNA OPCION EN EL CAMPO ROL</div>';
                                   formulario_man.combox.focus();
                                   return false;
                                }
                            
                            
                          
                            



                            //Validar correo
                            if (formulario_man.correo.value=="") {
                                //alert('Campos vacios');
                                document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO CORREO VACIO</div>';
                                formulario_man.correo.focus();
                                return false;  
                            }
                            else if (validar_tamaño (formulario_man.correo.value)==false){
                                document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE CARACTERES EN EXCESO EN EL CAMPO CORREO</div>';
                                formulario_man.correo.focus();
                                return false; 
                                }
                                 else if (Validar_correo(formulario_man.correo.value)== false){
                                    document.getElementById("alerta").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>PORFAVOR INGRESAR UN CORREO VALIDO</div>';
                                    formulario_man.correo.value="";
                                    formulario_man.correo.focus();
                                    return false; 
                                 }
                    else{
                        document.getElementById("alerta").innerHTML="";
                    }
       
    formulario_man.submit();
}
                    
//VALIDAR FORMULARIO CAMBIAR CONTRASEÑA
             function Validar_rescambiar() {
                            
             var formulario_cam= document.Form_cambiar;
             if (formulario_cam.nueva_contra.value=="") {
                    
            document.getElementById("alerta7").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO NUEVA CONTRASEÑA SE ENCUENTRA VACIO</div>';
            formulario_cam.nueva_contra.focus();
            return false; 
            }
           
            else if (Validar_espacio (formulario_cam.nueva_contra.value)==false){  
            document.getElementById("alerta7").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>EL CAMPO  NUEVA CONTRASEÑA NO DEBE DE CONTENER ESPACIOS</div>';
            formulario_cam.nueva_contra.focus();
            return false;
            }
            else if (Validar_espacio2(formulario_cam.nueva_contra.value)==false){  
            document.getElementById("alerta7").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIOS EN EL CAMPO</div>';
            formulario_cam.nueva_contra.focus();
            return false;
            }
            else if (validar_contra3 (formulario_cam.nueva_contra.value)==false){
                document.getElementById("alerta7").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LA CONTRASEÑA PERMITIDA DEBE SER LO MAS ROBUSTA POSIBLE, AL MENOS DEBE CONTENER 1 LETRA MINUSCULA, 1 LETRA MAYUSCULA, 1 CARÁCTER ESPECIAL, 1 NUMERO Y DEBE CONTENER 8 CARACTERES MINIMO.</div>';
                formulario_cam.nueva_contra.focus();
                return false;
            }
            //VALIDAR CONFIRMAR CONTRASEÑA
            if (formulario_cam.confirmar_contra2.value=="") {
            //NUEVA CONTRASEÑA
            document.getElementById("alerta7").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO CONFIRMAR CONTRASEÑA SE ENCUENTRA VACIO</div>';
            formulario_cam.confirmar_contra2.focus();
            return false; 
            }
            else if (Validar_espacio (formulario_cam.confirmar_contra2.value)==false){  
            document.getElementById("alerta7").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>EL CAMPO  CONFIRMAR CONTRASEÑA NO DEBE DE CONTENER ESPACIOS</div>';
            formulario_cam.confirmar_contra2.focus();
            return false;
            }
            else if (Validar_espacio2(formulario_cam.confirmar_contra2.value)==false){  
            document.getElementById("alerta7").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIOS EN EL CAMPO</div>';
            formulario_cam.confirmar_contra2.focus();
            return false;
            }
            else if (validar_contra3 (formulario_cam.confirmar_contra2.value)==false){
                document.getElementById("alerta7").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LA CONTRASEÑA PERMITIDA DEBE SER LO MAS ROBUSTA POSIBLE, AL MENOS DEBE CONTENER 1 LETRA MINUSCULA, 1 LETRA MAYUSCULA, 1 CARÁCTER ESPECIAL, 1 NUMERO Y DEBE CONTENER 8 CARACTERES MINIMO.</div>';
                formulario_cam.confirmar_contra2.focus();
                return false;
            }
             //CONTRASEÑAS COINCIDAN
             if(formulario_cam.nueva_contra.value != formulario_cam.confirmar_contra2.value){
                document.getElementById("alerta7").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CONTRASEÑAS NO COINCIDEN </div>';
                formulario_cam.nueva_contra.focus();
                
                return false;
                                    }
            else{
            document.getElementById("alerta7").innerHTML="";
            }

            formulario_cam.submit();
}


//VALIDAR FORMULARIO RESTABLECER PREGUNTAS VISTA

function Validar_resres() {
                            
    var formulario_cam= document.Form_reestablecer_preg;
    if (formulario_cam.nueva_contra.value=="") {
           
   document.getElementById("alerta7").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO NUEVA CONTRASEÑA SE ENCUENTRA VACIO</div>';
   formulario_cam.nueva_contra.focus();
   return false; 
   }
   else if (Validar_espacio (formulario_cam.nueva_contra.value)==false){  
    document.getElementById("alerta7").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>EL CAMPO  NUEVA CONTRASEÑA NO DEBE DE CONTENER ESPACIOS</div>';
    formulario_cam.nueva_contra.focus();
    return false;
    }
    else if (Validar_espacio2(formulario_cam.nueva_contra.value)==false){  
    document.getElementById("alerta7").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIOS EN EL CAMPO</div>';
    formulario_cam.nueva_contra.focus();
    return false;
    }
    else if (validar_contra3 (formulario_cam.nueva_contra.value)==false){
        document.getElementById("alerta7").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LA CONTRASEÑA PERMITIDA DEBE SER LO MAS ROBUSTA POSIBLE, AL MENOS DEBE CONTENER 1 LETRA MINUSCULA, 1 LETRA MAYUSCULA, 1 CARÁCTER ESPECIAL, 1 NUMERO Y DEBE CONTENER 8 CARACTERES MINIMO.</div>';
        formulario_cam.nueva_contra.focus();
        return false;
   }
  
   
   //VALIDAR CONFIRMAR CONTRASEÑA
   if (formulario_cam.confirmar_contra2.value=="") {
   //NUEVA CONTRASEÑA
   document.getElementById("alerta7").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO CONFIRMAR CONTRASEÑA SE ENCUENTRA VACIO</div>';
   formulario_cam.confirmar_contra2.focus();
   return false; 
   }
   else if (Validar_espacio (formulario_cam.confirmar_contra2.value)==false){  
   document.getElementById("alerta7").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>EL CAMPO  CONFIRMAR CONTRASEÑA NO DEBE DE CONTENER ESPACIOS</div>';
   formulario_cam.confirmar_contra2.focus();
   return false;
   }
   else if (Validar_espacio2(formulario_cam.confirmar_contra2.value)==false){  
   document.getElementById("alerta7").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIOS EN EL CAMPO</div>';
   formulario_cam.confirmar_contra2.focus();
   return false;
   }
   else if (validar_contra3 (formulario_cam.confirmar_contra2.value)==false){
    document.getElementById("alerta7").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LA CONTRASEÑA PERMITIDA DEBE SER LO MAS ROBUSTA POSIBLE, AL MENOS DEBE CONTENER 1 LETRA MINUSCULA, 1 LETRA MAYUSCULA, 1 CARÁCTER ESPECIAL, 1 NUMERO Y DEBE CONTENER 8 CARACTERES MINIMO.</div>';
    formulario_cam.nueva_contra2.focus();
    return false;
}
    //CONTRASEÑAS COINCIDAN
    if(formulario_cam.nueva_contra.value != formulario_cam.confirmar_contra2.value){
       document.getElementById("alerta7").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CONTRASEÑAS NO COINCIDEN </div>';
       formulario_cam.nueva_contra.focus();
       
       return false;
                           }
   else{
   document.getElementById("alerta7").innerHTML="";
   }

   formulario_cam.submit();
}

//VALIDAR FORMULARIO PREGUNTAS VISTA
function validar_pre(){
var formulario_pr=document.form_pregun;

if (formulario_pr.combox.value==0){
    document.getElementById("alerta8").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>SELECIONE UNA OPCION EN EL CAMPO PREGUNTA</div>';
   formulario_pr.combox.focus();
   return false;
}
if (formulario_pr.respuesta.value==""){
    document.getElementById("alerta8").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO RESPUESTA VACIO </div>';
   formulario_pr.respuesta.focus();
   return false;
}
else if (Validar_espacio2(formulario_pr.respuesta.value)==false){  
    document.getElementById("alerta8").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIOS EN EL CAMPO</div>';
    formulario_pr.respuesta.focus();
    return false;
    }
formulario_pr.submit();

}

//VALIDAR RECUPERAR PREGUNTAS VISTA
function validar_recu(){
    var formulario_rec=document.form_recu;
    
    if (formulario_rec.combox2.value==0){
        document.getElementById("alerta8").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>SELECIONE UNA OPCION EN EL CAMPO PREGUNTA </div>';
       formulario_rec.combox2.focus();
       return false;
    }
    if (formulario_rec.respuesta2.value==""){
        document.getElementById("alerta8").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO RESPUESTA VACIO </div>';
       formulario_rec.respuesta2.focus();
       return false;
    }
    else if (Validar_espacio2(formulario_rec.respuesta2.value)==false){  
        document.getElementById("alerta8").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIOS EN EL CAMPO</div>';
        formulario_rec.respuesta2.focus();
        return false;
        }
    formulario_rec.submit();
    }
    //VALIDAR ACTUALIZAR MANTENIMIENTO:
    function Validar_actualizar_mant(){
        var Formulario_actualizar_mant=document.Formactualizar_mant;
        //validar campo usuario
        if (Formulario_actualizar_mant.usuarion.value==""){
        document.getElementById("alerta_mant").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO USUARIO SE ENCUENTRA VACIO</div>';
        Formulario_actualizar_mant.usuarion.focus();
        return false; 
          }
          else if (Validar_espacio(Formulario_actualizar_mant.usuarion.value)==false){  
            document.getElementById("alerta_mant").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO USUARIO NO DEBE CONTENER ESPACIOS</div>';
            Formulario_actualizar_mant.usuarion.focus();
            return false;
             }
        else if (validar_longitud(Formulario_actualizar_mant.usuarion.value)==false){
        document.getElementById("alerta_mant").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO USUARIO DEBE CONTENER AL MENOS (6) CARACTERES</div>';
        Formulario_actualizar_mant.usuarion.focus();
        return false;
        }
   
       else if (validar_texto (Formulario_actualizar_mant.usuarion.value)==false){
          document.getElementById("alerta_mant").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO USUARIO NO PUEDE CONTENER NUMEROS</div>';
          Formulario_actualizar_mant.usuarion.focus();
          return false;
       }
      
        //validar campo nombre
        if (Formulario_actualizar_mant.nombre.value=="") {
          //alert('Campos vacios');
          document.getElementById("alerta_mant").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO NOMBRES VACIO</div>';
          Formulario_actualizar_mant.nombre.focus();
          return false;
      }
      else if (Validar_espacio2 (Formulario_actualizar_mant.nombre.value)==false){
        document.getElementById("alerta_mant").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIOS EN EL CAMPO</div>';
        Formulario_actualizar_mant.nombre.focus();
      
        return false;
        }
      else if (validar_texto (Formulario_actualizar_mant.nombre.value)==false){
          document.getElementById("alerta_mant").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO NOMBRES NO PUEDE CONTENER NUMEROS</div>';
          Formulario_actualizar_mant.nombre.focus();
          return false;
          }
          else if (validar_tamaño (Formulario_actualizar_mant.nombre.value)==false){
              document.getElementById("alerta_mant").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE CARACTERES EN EL CAMPO</div>';
              Formulario_actualizar_mant.nombre.focus();
          return false;
              }
             
                 
              //Validar campo apellido:
              if (Formulario_actualizar_mant.apellido.value=="") {
                  //alert('Campos vacios');
                  document.getElementById("alerta_mant").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO APELLIDO VACIO</div>';
                  Formulario_actualizar_mant.apellido.focus();
                  return false;
              }

              else if (Validar_espacio2 (Formulario_actualizar_mant.apellido.value)==false){
                document.getElementById("alerta_mant").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE ESPACIOS EN EL CAMPO</div>';
                Formulario_actualizar_mant.apellido.focus();
                return false;
                }
              else if (validar_texto (Formulario_actualizar_mant.apellido.value)==false){
                  document.getElementById("alerta_mant").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO APELLIDO NO PUEDE CONTENER NUMEROS</div>';
                  Formulario_actualizar_mant.apellido.focus();
                  return false;
                  }
                  else if (validar_tamaño (Formulario_actualizar_mant.apellido.value)==false){
                      document.getElementById("alerta_mant").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE CARACTERES EN EL CAMPO</div>';
                      Formulario_actualizar_mant.apellido.focus();
                  return false;
                      }
                    
                          
          //Validar campo estado
        if (Formulario_actualizar_mant.combox2.value==0){
            document.getElementById("alerta_mant").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>SELECCIONE UNA OPCION EN EL CAMPO ESTADO</div>';
            Formulario_actualizar_mant.combox2.focus();
            return false;
        }


          //Validar Rol:
          if (Formulario_actualizar_mant.combox.value==0){
            document.getElementById("alerta_mant").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>SELECCIONE UNA OPCION EN EL CAMPO ROL</div>';
            Formulario_actualizar_mant.combox.focus();
            return false;

          }
          
                  //Validar campo correo:
                  if (Formulario_actualizar_mant.correon.value=="") {
                      //alert('Campos vacios');
                      document.getElementById("alerta_mant").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>CAMPO CORREO VACIO</div>';
                      Formulario_actualizar_mant.correon.focus();
                      return false;  
                  }
                  else if (validar_tamaño (Formulario_actualizar_mant.correon.value)==false){
                      document.getElementById("alerta_mant").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>LIMITE DE CARACTERES EN EXCESO EN EL CAMPO CORREO</div>';
                      Formulario_actualizar_mant.correon.focus();
                      return false; 
                      }
                       else if (Validar_correo(Formulario_actualizar_mant.correon.value)== false){
                          document.getElementById("alerta_mant").innerHTML='<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>PORFAVOR INGRESAR UN CORREO VALIDO</div>';
                          Formulario_actualizar_mant.correon.focus();

                          return false; 
                       }
Formulario_actualizar_mant.submit();
}
    