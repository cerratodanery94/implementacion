
<?php	
	try{
		require '../modelos/conectar.php';
        if (isset($_POST['rol']) and 
        isset($_POST['per_usu_c']) and
        isset($_POST['per_usu_i']) and 
		    isset($_POST['per_usu_m']) and 
        isset($_POST['per_usu_e']) and
        //pacientes
        isset($_POST['pac_c']) and
        isset($_POST['pac_i']) and 
		    isset($_POST['pac_m']) and 
        isset($_POST['pac_e']) and
        //expediente doctora
        isset($_POST['exp_doc_c']) and
        isset($_POST['exp_doc_i']) and 
        isset($_POST['exp_doc_e']) and
        //expediente nutricionista
         isset($_POST['exp_doc_c']) and
         isset($_POST['exp_doc_i']) and 
         isset($_POST['exp_doc_e']) and
        //pacientes
        isset($_POST['citas_c']) and
        isset($_POST['citas_i']) and 
		    isset($_POST['citas_m']) and 
        isset($_POST['citas_e']) and
        //parametros
        isset($_POST['parametros_c']) and
        isset($_POST['parametros_m']) and
        //roles
         isset($_POST['roles_c']) and
         isset($_POST['roles_i']) and 
         isset($_POST['roles_m']) and 
         isset($_POST['roles_e']) and
        //bitacora
          isset($_POST['bit_c']) and
        //backup
        isset($_POST['back_c']) and
        //permisos
        isset($_POST['perm_c']) and
        isset($_POST['perm_i']) and 
        isset($_POST['perm_m']) and
        isset($_POST['perm_e']) and
        //prof y ocu
        isset($_POST['po_c']) and
        isset($_POST['po_i']) and 
        isset($_POST['po_m']) and 
        isset($_POST['po_e']) and
        //preguntas de seguridad
        isset($_POST['ps_c']) and
        isset($_POST['ps_i']) and 
        isset($_POST['ps_m']) and 
        isset($_POST['ps_e']) and
         //nacionalidades
         isset($_POST['nac_c']) and
         isset($_POST['nac_i']) and 
         isset($_POST['nac_m']) and 
         isset($_POST['nac_e']) and
          //horarios
          isset($_POST['hor_c']) and
           //preg usuarios
         isset($_POST['psu_c']) and
          //pantallas
          isset($_POST['pant_c']) and
          isset($_POST['pant_m']) 
           
		) {
        $r=$_POST["rol"];
        $c=$_POST["per_usu_c"];
        $i=$_POST["per_usu_i"];
        $m=$_POST["per_usu_m"];
        $e=$_POST["per_usu_e"];
        //pacientes
        $c1=$_POST["pac_c"];
        $i1=$_POST["pac_i"];
        $m1=$_POST["pac_m"];
        $e1=$_POST["pac_e"];
        //expediente doctora
        $c2=$_POST["exp_doc_c"];
        $i2=$_POST["exp_doc_i"];
        $e2=$_POST["exp_doc_e"];
        //expediente nuticionista
        $c3=$_POST["exp_nutri_c"];
        $i3=$_POST["exp_nutri_i"];
        $e3=$_POST["exp_nutri_e"];
        //citas
        $c4=$_POST["citas_c"];
        $i4=$_POST["citas_i"];
        $m4=$_POST["citas_m"];
        $e4=$_POST["citas_e"];
        //parametros
        $c5=$_POST["parametros_c"];
        $m5=$_POST["parametros_m"];
        //roles
        $c6=$_POST["roles_c"];
        $i6=$_POST["roles_i"];
        $m6=$_POST["roles_m"];
        $e6=$_POST["roles_e"];
         //bitacora
         $c7=$_POST["bit_c"];
          //backup
          $c8=$_POST["back_c"];
          //permisos
        $c9=$_POST["perm_c"];
        $i9=$_POST["perm_i"];
        $m9=$_POST["perm_m"];
        $e9=$_POST["perm_e"];
        //prof y ocu
        $c10=$_POST["po_c"];
        $i10=$_POST["po_i"];
        $m10=$_POST["po_m"];
        $e10=$_POST["po_e"];
         //preg de seguridad
        $c11=$_POST["ps_c"];
        $i11=$_POST["ps_i"];
        $m11=$_POST["ps_m"];
        $e11=$_POST["ps_e"];
         //nacionalidades
         $c12=$_POST["nac_c"];
         $i12=$_POST["nac_i"];
         $m12=$_POST["nac_m"];
         $e12=$_POST["nac_e"];
         //horarios
         $c13=$_POST['hor_c'];
         //preg usuarios
        $c14=$_POST['psu_c'];
        //pantallas
        $c15=$_POST['pant_c'];
        $m15=$_POST['pant_m']; 



        $consulta=$conexion->prepare("SELECT * FROM TBL_PERMISOS WHERE ROL_CODIGO='$r' and obj_codigo=11");
        $consulta->execute();
        $num_rows = $consulta->fetchColumn();

        $consulta1=$conexion->prepare("SELECT * FROM TBL_PERMISOS WHERE ROL_CODIGO='$r' and obj_codigo=18");
        $consulta1->execute();
        $num_rows1 = $consulta1->fetchColumn();

        $consulta2=$conexion->prepare("SELECT * FROM TBL_PERMISOS WHERE ROL_CODIGO='$r' and obj_codigo=24");
        $consulta2->execute();
        $num_rows2 = $consulta2->fetchColumn();

        $consulta3=$conexion->prepare("SELECT * FROM TBL_PERMISOS WHERE ROL_CODIGO='$r' and obj_codigo=22");
        $consulta3->execute();
        $num_rows3 = $consulta3->fetchColumn();

        $consulta4=$conexion->prepare("SELECT * FROM TBL_PERMISOS WHERE ROL_CODIGO='$r' and obj_codigo=28");
        $consulta4->execute();
        $num_rows4 = $consulta4->fetchColumn();

        $consulta5=$conexion->prepare("SELECT * FROM TBL_PERMISOS WHERE ROL_CODIGO='$r' and obj_codigo=30");
        $consulta5->execute();
        $num_rows5 = $consulta5->fetchColumn();

        $consulta6=$conexion->prepare("SELECT * FROM TBL_PERMISOS WHERE ROL_CODIGO='$r' and obj_codigo=31");
        $consulta6->execute();
        $num_rows6 = $consulta6->fetchColumn();

        $consulta7=$conexion->prepare("SELECT * FROM TBL_PERMISOS WHERE ROL_CODIGO='$r' and obj_codigo=33");
        $consulta7->execute();
        $num_rows7 = $consulta7->fetchColumn();

        $consulta8=$conexion->prepare("SELECT * FROM TBL_PERMISOS WHERE ROL_CODIGO='$r' and obj_codigo=40");
        $consulta8->execute();
        $num_rows8 = $consulta8->fetchColumn();

        $consulta9=$conexion->prepare("SELECT * FROM TBL_PERMISOS WHERE ROL_CODIGO='$r' and obj_codigo=36");
        $consulta9->execute();
        $num_rows9 = $consulta9->fetchColumn();

        $consulta10=$conexion->prepare("SELECT * FROM TBL_PERMISOS WHERE ROL_CODIGO='$r' and obj_codigo=43");
        $consulta10->execute();
        $num_rows10 = $consulta10->fetchColumn();
        
        $consulta11=$conexion->prepare("SELECT * FROM TBL_PERMISOS WHERE ROL_CODIGO='$r' and obj_codigo=46");
        $consulta11->execute();
        $num_rows11 = $consulta11->fetchColumn();

        $consulta12=$conexion->prepare("SELECT * FROM TBL_PERMISOS WHERE ROL_CODIGO='$r' and obj_codigo=51");
        $consulta12->execute();
        $num_rows12 = $consulta12->fetchColumn();

        $consulta13=$conexion->prepare("SELECT * FROM TBL_PERMISOS WHERE ROL_CODIGO='$r' and obj_codigo=54");
        $consulta13->execute();
        $num_rows13 = $consulta13->fetchColumn();

        $consulta14=$conexion->prepare("SELECT * FROM TBL_PERMISOS WHERE ROL_CODIGO='$r' and obj_codigo=55");
        $consulta14->execute();
        $num_rows14 = $consulta14->fetchColumn();

        $consulta15=$conexion->prepare("SELECT * FROM TBL_PERMISOS WHERE ROL_CODIGO='$r' and obj_codigo=49");
        $consulta15->execute();
        $num_rows15 = $consulta15->fetchColumn();

        
        
       if ($num_rows>0 and $num_rows1>0 and $num_rows2>0 and $num_rows3>0 and $num_rows4>0 and $num_rows5>0 and $num_rows6>0 and $num_rows7>0 and $num_rows8>0 and $num_rows9>0 and $num_rows10>0 and $num_rows11>0 and $num_rows12>0 and $num_rows13>0 and $num_rows14>0 and $num_rows15>0){ 
		  
		   echo '<script> Swal.fire({
			position: "center",
			icon: "error",
			title: "ESTE ROL YA TIENE PERMISOS ASIGNADOS PERMISOS",
			showConfirmButton: false,
			timer: 3000
		  })
		  </script>';

       }else{
	
        $sql="INSERT INTO tbl_permisos (
            ROL_CODIGO,
            OBJ_CODIGO,
            PERM_CONSULTAR,
            PERM_INSERTAR,
            PERM_ACTUALIZAR,	
            PERM_ELIMINAR
            ) 
            
        VALUES (
         :r,
         :p,   
         :c,
         :i,
         :m,
         :e)";
        
 
        $resultado=$conexion->prepare($sql);	
        $resultado->execute(array(
         ":r"=>$r,
         ":p"=>11,  
         ":c"=>$c,
         ":i"=>$i,
         ":m"=>$m,
         ":e"=>$e
       ));

       $sql1="INSERT INTO tbl_permisos (
        ROL_CODIGO,
        OBJ_CODIGO,
        PERM_CONSULTAR,
        PERM_INSERTAR,
        PERM_ACTUALIZAR,	
        PERM_ELIMINAR
        ) 
        
    VALUES (
     :r,
     :p,   
     :c,
     :i,
     :m,
     :e)";
    

    $resultado1=$conexion->prepare($sql1);	
    $resultado1->execute(array(
     ":r"=>$r,
     ":p"=>18,  
     ":c"=>$c1,
     ":i"=>$i1,
     ":m"=>$m1,
     ":e"=>$e1
    ));

    $sql2="INSERT INTO tbl_permisos (
      ROL_CODIGO,
      OBJ_CODIGO,
      PERM_CONSULTAR,
      PERM_INSERTAR,
      PERM_ACTUALIZAR,	
      PERM_ELIMINAR
      ) 
      
  VALUES (
   :r,
   :p,   
   :c,
   :i,
   :m,
   :e)";
  

  $resultado2=$conexion->prepare($sql2);	
  $resultado2->execute(array(
   ":r"=>$r,
   ":p"=>24,  
   ":c"=>$c2,
   ":i"=>$i2,
   ":m"=>0,
   ":e"=>$e2
  ));

  $sql3="INSERT INTO tbl_permisos (
    ROL_CODIGO,
    OBJ_CODIGO,
    PERM_CONSULTAR,
    PERM_INSERTAR,
    PERM_ACTUALIZAR,	
    PERM_ELIMINAR
    ) 
    
VALUES (
 :r,
 :p,   
 :c,
 :i,
 :m,
 :e)";


$resultado3=$conexion->prepare($sql3);	
$resultado3->execute(array(
 ":r"=>$r,
 ":p"=>22,  
 ":c"=>$c3,
 ":i"=>$i3,
 ":m"=>0,
 ":e"=>$e3
));
$sql4="INSERT INTO tbl_permisos (
  ROL_CODIGO,
  OBJ_CODIGO,
  PERM_CONSULTAR,
  PERM_INSERTAR,
  PERM_ACTUALIZAR,	
  PERM_ELIMINAR
  ) 
  
VALUES (
:r,
:p,   
:c,
:i,
:m,
:e)";


$resultado4=$conexion->prepare($sql4);	
$resultado4->execute(array(
":r"=>$r,
":p"=>28,  
":c"=>$c4,
":i"=>$i4,
":m"=>$m4,
":e"=>$e4
));
$sql5="INSERT INTO tbl_permisos (
  ROL_CODIGO,
  OBJ_CODIGO,
  PERM_CONSULTAR,
  PERM_INSERTAR,
  PERM_ACTUALIZAR,	
  PERM_ELIMINAR
  ) 
  
VALUES (
:r,
:p,   
:c,
:i,
:m,
:e)";


$resultado5=$conexion->prepare($sql5);	
$resultado5->execute(array(
":r"=>$r,
":p"=>30,  
":c"=>$c5,
":i"=>0,
":m"=>$m5,
":e"=>0
));

$sql6="INSERT INTO tbl_permisos (
  ROL_CODIGO,
  OBJ_CODIGO,
  PERM_CONSULTAR,
  PERM_INSERTAR,
  PERM_ACTUALIZAR,	
  PERM_ELIMINAR
  ) 
  
VALUES (
:r,
:p,   
:c,
:i,
:m,
:e)";


$resultado6=$conexion->prepare($sql6);	
$resultado6->execute(array(
":r"=>$r,
":p"=>31,  
":c"=>$c6,
":i"=>$i6,
":m"=>$m6,
":e"=>$e6
));
$sql7="INSERT INTO tbl_permisos (
  ROL_CODIGO,
  OBJ_CODIGO,
  PERM_CONSULTAR,
  PERM_INSERTAR,
  PERM_ACTUALIZAR,	
  PERM_ELIMINAR
  ) 
  
VALUES (
:r,
:p,   
:c,
:i,
:m,
:e)";


$resultado7=$conexion->prepare($sql7);	
$resultado7->execute(array(
":r"=>$r,
":p"=>33,  
":c"=>$c7,
":i"=>0,
":m"=>0,
":e"=>0
));
$sql8="INSERT INTO tbl_permisos (
  ROL_CODIGO,
  OBJ_CODIGO,
  PERM_CONSULTAR,
  PERM_INSERTAR,
  PERM_ACTUALIZAR,	
  PERM_ELIMINAR
  ) 
  
VALUES (
:r,
:p,   
:c,
:i,
:m,
:e)";


$resultado8=$conexion->prepare($sql8);	
$resultado8->execute(array(
":r"=>$r,
":p"=>40,  
":c"=>$c8,
":i"=>0,
":m"=>0,
":e"=>0
));
$sql9="INSERT INTO tbl_permisos (
  ROL_CODIGO,
  OBJ_CODIGO,
  PERM_CONSULTAR,
  PERM_INSERTAR,
  PERM_ACTUALIZAR,	
  PERM_ELIMINAR
  ) 
  
VALUES (
:r,
:p,   
:c,
:i,
:m,
:e)";


$resultado9=$conexion->prepare($sql9);	
$resultado9->execute(array(
":r"=>$r,
":p"=>36,  
":c"=>$c9,
":i"=>$i9,
":m"=>$m9,
":e"=>$e9
));
$sql10="INSERT INTO tbl_permisos (
  ROL_CODIGO,
  OBJ_CODIGO,
  PERM_CONSULTAR,
  PERM_INSERTAR,
  PERM_ACTUALIZAR,	
  PERM_ELIMINAR
  ) 
  
VALUES (
:r,
:p,   
:c,
:i,
:m,
:e)";

$resultado10=$conexion->prepare($sql10);	
$resultado10->execute(array(
 ":r"=>$r,
 ":p"=>43,  
 ":c"=>$c10,
 ":i"=>$i10,
 ":m"=>$m10,
 ":e"=>$e10
));
$sql11="INSERT INTO tbl_permisos (
  ROL_CODIGO,
  OBJ_CODIGO,
  PERM_CONSULTAR,
  PERM_INSERTAR,
  PERM_ACTUALIZAR,	
  PERM_ELIMINAR
  ) 
  
VALUES (
:r,
:p,   
:c,
:i,
:m,
:e)";

$resultado11=$conexion->prepare($sql11);	
$resultado11->execute(array(
 ":r"=>$r,
 ":p"=>46,  
 ":c"=>$c11,
 ":i"=>$i11,
 ":m"=>$m11,
 ":e"=>$e11
));
$sql12="INSERT INTO tbl_permisos (
  ROL_CODIGO,
  OBJ_CODIGO,
  PERM_CONSULTAR,
  PERM_INSERTAR,
  PERM_ACTUALIZAR,	
  PERM_ELIMINAR
  ) 
  
VALUES (
:r,
:p,   
:c,
:i,
:m,
:e)";

$resultado12=$conexion->prepare($sql12);	
$resultado12->execute(array(
 ":r"=>$r,
 ":p"=>51,  
 ":c"=>$c12,
 ":i"=>$i12,
 ":m"=>$m12,
 ":e"=>$e12
));
$sql13="INSERT INTO tbl_permisos (
  ROL_CODIGO,
  OBJ_CODIGO,
  PERM_CONSULTAR,
  PERM_INSERTAR,
  PERM_ACTUALIZAR,	
  PERM_ELIMINAR
  ) 
  
VALUES (
:r,
:p,   
:c,
:i,
:m,
:e)";

$resultado13=$conexion->prepare($sql13);	
$resultado13->execute(array(
 ":r"=>$r,
 ":p"=>54,  
 ":c"=>$c13,
 ":i"=>0,
 ":m"=>0,
 ":e"=>0
));
$sql14="INSERT INTO tbl_permisos (
  ROL_CODIGO,
  OBJ_CODIGO,
  PERM_CONSULTAR,
  PERM_INSERTAR,
  PERM_ACTUALIZAR,	
  PERM_ELIMINAR
  ) 
  
VALUES (
:r,
:p,   
:c,
:i,
:m,
:e)";

$resultado14=$conexion->prepare($sql14);	
$resultado14->execute(array(
 ":r"=>$r,
 ":p"=>55,  
 ":c"=>$c14,
 ":i"=>0,
 ":m"=>0,
 ":e"=>0
));
$sql15="INSERT INTO tbl_permisos (
  ROL_CODIGO,
  OBJ_CODIGO,
  PERM_CONSULTAR,
  PERM_INSERTAR,
  PERM_ACTUALIZAR,	
  PERM_ELIMINAR
  ) 
  
VALUES (
:r,
:p,   
:c,
:i,
:m,
:e)";

$resultado15=$conexion->prepare($sql15);	
$resultado15->execute(array(
 ":r"=>$r,
 ":p"=>49,  
 ":c"=>$c15,
 ":i"=>0,
 ":m"=>$m15,
 ":e"=>0
));
       if ($resultado and $resultado1 and $resultado2 and $resultado3 and $resultado4 and $resultado5 and $resultado6 and $resultado7 and $resultado8 and $resultado9 and $resultado10  and $resultado11 and $resultado12 and $resultado13 and $resultado14 and $resultado15 ) {
		$sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
		VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
	    $resultado2=$conexion->prepare($sql2);	
		$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>56,":accion"=>'NUEVO',":descr"=>'AÑADIO PERMISOS A ROL',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));
		
		echo '<script>
                    Swal.fire({
                    title: "¡BIEN!",
                    position: "center",
                    text: "SE REGISTRARON CORRECTAMENTE LOS PERMISOS",
                    icon: "success",
                    type: "success"
                    }).then(function() {
                    window.location = "../vistas/insertar_permisos.php";
                    });
                  </script>';	
	   } 
     
	  
	   
	 	$consulta->closeCursor();
    $consulta1->closeCursor();
    $consulta2->closeCursor();
    $consulta3->closeCursor();
    $consulta4->closeCursor();
    $consulta5->closeCursor();
    $consulta6->closeCursor();
    $consulta7->closeCursor();
    $consulta8->closeCursor();
    $consulta9->closeCursor();
    $consulta10->closeCursor();
    $consulta11->closeCursor();
    $consulta12->closeCursor();
    $consulta13->closeCursor();
    $consulta14->closeCursor();
    $consulta15->closeCursor();


		$resultado->closeCursor();
    $resultado1->closeCursor();
    $resultado2->closeCursor();
    $resultado3->closeCursor();
    $resultado4->closeCursor();
    $resultado5->closeCursor();
    $resultado6->closeCursor();
    $resultado7->closeCursor();
    $resultado8->closeCursor();
    $resultado9->closeCursor();
    $resultado10->closeCursor();
    $resultado11->closeCursor();
    $resultado12->closeCursor();
    $resultado13->closeCursor();
    $resultado14->closeCursor();
    $resultado15->closeCursor();

    }  }
	}catch(Exception $e){			
		
        die('Error: ' . $e->GetMessage());
		echo "Codigo del error" . $e->getCode();	
	}

?>
</body>
</html>