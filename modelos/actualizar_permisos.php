<?php	
	try{
		require '../modelos/conectar.php';
        if ( isset($_POST['id_peru']) and
        isset($_POST['per_usu_c']) and
        isset($_POST['per_usu_i']) and 
		isset($_POST['per_usu_m']) and 
        isset($_POST['per_usu_e']) and
        isset($_POST['id_rol']) and
        isset($_POST['id_obju']) and
        //Pacientes
        isset($_POST['id_ppac']) and
        isset($_POST['pac_c']) and
        isset($_POST['pac_i']) and 
		isset($_POST['pac_m']) and 
        isset($_POST['pac_e']) and
        isset($_POST['id_opac']) and
        //Expediente doctora
        isset($_POST['id_ped']) and
        isset($_POST['exp_doc_c']) and
        isset($_POST['exp_doc_i']) and 
        isset($_POST['exp_doc_e']) and
        isset($_POST['id_oed']) and
        //Expediente nutricionista
        isset($_POST['id_pen']) and
        isset($_POST['exp_nutri_c']) and
        isset($_POST['exp_nutri_i']) and 
        isset($_POST['exp_nutri_e']) and
        isset($_POST['id_oen']) and
        //Citas
        isset($_POST['id_pcit']) and
        isset($_POST['citas_c']) and
        isset($_POST['citas_i']) and 
		isset($_POST['citas_m']) and 
        isset($_POST['citas_e']) and
        isset($_POST['id_ocit']) and
        //parametros
        isset($_POST['id_pparam']) and
        isset($_POST['parametros_c']) and
		isset($_POST['parametros_m']) and 
        isset($_POST['id_oparam'])and
        //Roles
        isset($_POST['id_proles']) and
        isset($_POST['roles_c']) and
        isset($_POST['roles_i']) and 
		isset($_POST['roles_m']) and 
        isset($_POST['roles_e']) and
        isset($_POST['id_oroles']) and
        //Bitacora
        isset($_POST['id_pbit']) and
        isset($_POST['bit_c']) and
        isset($_POST['id_obit']) and
         //Backup
         isset($_POST['id_pback']) and
         isset($_POST['back_c']) and
         isset($_POST['id_oback']) and
          //Permisos
        isset($_POST['id_pperm']) and
        isset($_POST['perm_c']) and
        isset($_POST['perm_i']) and 
		isset($_POST['perm_m']) and 
        isset($_POST['id_operm']) and
        //prof y ocu
        isset($_POST['id_ppo']) and
        isset($_POST['id_opo']) and
        isset($_POST['po_c']) and
        isset($_POST['po_i']) and 
        isset($_POST['po_m']) and 
        isset($_POST['po_e']) and
        //prof y ocu
        isset($_POST['id_pps']) and
        isset($_POST['id_ops']) and
        isset($_POST['ps_c']) and
        isset($_POST['ps_i']) and 
        isset($_POST['ps_m']) and 
        isset($_POST['ps_e']) 
		) {
        //Usuarios
        $id_rol=$_POST["id_rol"];  
        $id_obju=$_POST["id_obju"];
        $c=$_POST["per_usu_c"];
        $i=$_POST["per_usu_i"];
        $m=$_POST["per_usu_m"];
        $e=$_POST["per_usu_e"];
        $id_peru=$_POST["id_peru"];
        //Pacientes
        $id_opac=$_POST["id_opac"];
        $c1=$_POST["pac_c"];
        $i1=$_POST["pac_i"];
        $m1=$_POST["pac_m"];
        $e1=$_POST["pac_e"];
        $id_ppac=$_POST["id_ppac"];
        //Expediente doctora
        $id_oed=$_POST["id_oed"];
        $c2=$_POST["exp_doc_c"];
        $i2=$_POST["exp_doc_i"];
        $e2=$_POST["exp_doc_e"];
        $id_ped=$_POST["id_ped"];
        //Expediente nutrionista
        $id_oen=$_POST["id_oen"];
        $c3=$_POST["exp_nutri_c"];
        $i3=$_POST["exp_nutri_i"];
        $e3=$_POST["exp_nutri_e"];
        $id_pen=$_POST["id_pen"];
        //Citas
        $id_ocit=$_POST["id_ocit"];
        $c4=$_POST["citas_c"];
        $i4=$_POST["citas_i"];
        $m4=$_POST["citas_m"];
        $e4=$_POST["citas_e"];
        $id_pcit=$_POST["id_pcit"];
        //Parametros
        $id_oparam=$_POST["id_oparam"];
        $c5=$_POST["parametros_c"];
        $m5=$_POST["parametros_m"];
        $id_pparam=$_POST["id_pparam"];
        //Roles
        $id_oroles=$_POST["id_oroles"];
        $c6=$_POST["roles_c"];
        $i6=$_POST["roles_i"];
        $m6=$_POST["roles_m"];
        $e6=$_POST["roles_e"];
        $id_proles=$_POST["id_proles"];
        //Roles
        $id_obit=$_POST["id_obit"];
        $c7=$_POST["bit_c"];
        $id_pbit=$_POST["id_pbit"];
         //Backup
         $id_oback=$_POST["id_oback"];
         $c8=$_POST["back_c"];
         $id_pback=$_POST["id_pback"];
         //permisos
        $id_operm=$_POST["id_operm"];
        $c9=$_POST["perm_c"];
        $i9=$_POST["perm_i"];
        $m9=$_POST["perm_m"];
        $id_pperm=$_POST["id_pperm"];
         //prof y ocu
         $id_opo=$_POST["id_opo"];
         $c10=$_POST["po_c"];
         $i10=$_POST["po_i"];
         $m10=$_POST["po_m"];
         $e10=$_POST["po_e"];
         $id_ppo=$_POST["id_ppo"];
         //preg de seg
         $id_ops=$_POST["id_ops"];
         $c11=$_POST["ps_c"];
         $i11=$_POST["ps_i"];
         $m11=$_POST["ps_m"];
         $e11=$_POST["ps_e"];
         $id_pps=$_POST["id_pps"];

        
        $query=$conexion->prepare
        ("UPDATE TBL_PERMISOS SET
            ROL_CODIGO=:r,
            OBJ_CODIGO=:p,
            PERM_CONSULTAR=:c,
            PERM_INSERTAR=:i,
            PERM_ACTUALIZAR=:m,	
            PERM_ELIMINAR=:e

        WHERE PERM_CODIGO=:id_peru");
      
         $query->execute(array(
            ":id_peru"=>$id_peru,
            ":r"=>$id_rol,
            ":p"=>$id_obju,  
            ":c"=>$c,
            ":i"=>$i,
            ":m"=>$m,
            ":e"=>$e
        ));
        //pacientes
        $query1=$conexion->prepare
        ("UPDATE TBL_PERMISOS SET
            ROL_CODIGO=:r,
            OBJ_CODIGO=:p,
            PERM_CONSULTAR=:c,
            PERM_INSERTAR=:i,
            PERM_ACTUALIZAR=:m,	
            PERM_ELIMINAR=:e

        WHERE PERM_CODIGO=:id_p");
      
         $query1->execute(array(
            ":id_p"=>$id_ppac,
            ":r"=>$id_rol,
            ":p"=>$id_opac,  
            ":c"=>$c1,
            ":i"=>$i1,
            ":m"=>$m1,
            ":e"=>$e1
        ));
        //expediente doctora
        $query2=$conexion->prepare
        ("UPDATE TBL_PERMISOS SET
            ROL_CODIGO=:r,
            OBJ_CODIGO=:p,
            PERM_CONSULTAR=:c,
            PERM_INSERTAR=:i,
            PERM_ELIMINAR=:e

        WHERE PERM_CODIGO=:id_p");
      
         $query2->execute(array(
            ":id_p"=>$id_ped,
            ":r"=>$id_rol,
            ":p"=>$id_oed,  
            ":c"=>$c2,
            ":i"=>$i2,
            ":e"=>$e2
        ));
        //expediente nutricionista
        $query3=$conexion->prepare
        ("UPDATE TBL_PERMISOS SET
            ROL_CODIGO=:r,
            OBJ_CODIGO=:p,
            PERM_CONSULTAR=:c,
            PERM_INSERTAR=:i,
            PERM_ELIMINAR=:e

        WHERE PERM_CODIGO=:id_p");
      
         $query3->execute(array(
            ":id_p"=>$id_pen,
            ":r"=>$id_rol,
            ":p"=>$id_oen,  
            ":c"=>$c3,
            ":i"=>$i3,
            ":e"=>$e3
        ));
        //citas
        $query4=$conexion->prepare
        ("UPDATE TBL_PERMISOS SET
            ROL_CODIGO=:r,
            OBJ_CODIGO=:p,
            PERM_CONSULTAR=:c,
            PERM_INSERTAR=:i,
            PERM_ACTUALIZAR=:m,	
            PERM_ELIMINAR=:e

        WHERE PERM_CODIGO=:id_p");
      
         $query4->execute(array(
            ":id_p"=>$id_pcit,
            ":r"=>$id_rol,
            ":p"=>$id_ocit,  
            ":c"=>$c4,
            ":i"=>$i4,
            ":m"=>$m4,
            ":e"=>$e4
        ));
        //parametros
        $query5=$conexion->prepare
        ("UPDATE TBL_PERMISOS SET
            ROL_CODIGO=:r,
            OBJ_CODIGO=:p,
            PERM_CONSULTAR=:c,
            PERM_INSERTAR=:i,
            PERM_ACTUALIZAR=:m,	
            PERM_ELIMINAR=:e

        WHERE PERM_CODIGO=:id_p");
      
         $query5->execute(array(
            ":id_p"=>$id_pparam,
            ":r"=>$id_rol,
            ":p"=>$id_oparam,  
            ":c"=>$c5,
            ":i"=>0,
            ":m"=>$m5,
            ":e"=>0
        ));
        //roles
        $query6=$conexion->prepare
        ("UPDATE TBL_PERMISOS SET
            ROL_CODIGO=:r,
            OBJ_CODIGO=:p,
            PERM_CONSULTAR=:c,
            PERM_INSERTAR=:i,
            PERM_ACTUALIZAR=:m,	
            PERM_ELIMINAR=:e

        WHERE PERM_CODIGO=:id_p");
      
         $query6->execute(array(
            ":id_p"=>$id_proles,
            ":r"=>$id_rol,
            ":p"=>$id_oroles,  
            ":c"=>$c6,
            ":i"=>$i6,
            ":m"=>$m6,
            ":e"=>$e6
        ));
        //Bitacora
        $query7=$conexion->prepare
        ("UPDATE TBL_PERMISOS SET
            ROL_CODIGO=:r,
            OBJ_CODIGO=:p,
            PERM_CONSULTAR=:c,
            PERM_INSERTAR=:i,
            PERM_ACTUALIZAR=:m,	
            PERM_ELIMINAR=:e

        WHERE PERM_CODIGO=:id_p");
      
         $query7->execute(array(
            ":id_p"=>$id_pbit,
            ":r"=>$id_rol,
            ":p"=>$id_obit,  
            ":c"=>$c7,
            ":i"=>0,
            ":m"=>0,
            ":e"=>0
        ));
         //Backup
         $query8=$conexion->prepare
         ("UPDATE TBL_PERMISOS SET
             ROL_CODIGO=:r,
             OBJ_CODIGO=:p,
             PERM_CONSULTAR=:c,
             PERM_INSERTAR=:i,
             PERM_ACTUALIZAR=:m,	
             PERM_ELIMINAR=:e
 
         WHERE PERM_CODIGO=:id_p");
       
          $query8->execute(array(
             ":id_p"=>$id_pback,
             ":r"=>$id_rol,
             ":p"=>$id_oback,  
             ":c"=>$c8,
             ":i"=>0,
             ":m"=>0,
             ":e"=>0
         ));
          //permisos
        $query9=$conexion->prepare
        ("UPDATE TBL_PERMISOS SET
            ROL_CODIGO=:r,
            OBJ_CODIGO=:p,
            PERM_CONSULTAR=:c,
            PERM_INSERTAR=:i,
            PERM_ACTUALIZAR=:m,	
            PERM_ELIMINAR=:e

        WHERE PERM_CODIGO=:id_p");
      
         $query9->execute(array(
            ":id_p"=>$id_pperm,
            ":r"=>$id_rol,
            ":p"=>$id_operm,  
            ":c"=>$c9,
            ":i"=>$i9,
            ":m"=>$m9,
            ":e"=>0
        ));
        //prof y ocu
        $query10=$conexion->prepare
        ("UPDATE TBL_PERMISOS SET
            ROL_CODIGO=:r,
            OBJ_CODIGO=:p,
            PERM_CONSULTAR=:c,
            PERM_INSERTAR=:i,
            PERM_ACTUALIZAR=:m,	
            PERM_ELIMINAR=:e

        WHERE PERM_CODIGO=:id_p");
      
         $query10->execute(array(
            ":id_p"=>$id_ppo,
            ":r"=>$id_rol,
            ":p"=>$id_opo,  
            ":c"=>$c10,
            ":i"=>$i10,
            ":m"=>$m10,
            ":e"=>$e10
        ));
        //preg seg
        $query11=$conexion->prepare
        ("UPDATE TBL_PERMISOS SET
            ROL_CODIGO=:r,
            OBJ_CODIGO=:p,
            PERM_CONSULTAR=:c,
            PERM_INSERTAR=:i,
            PERM_ACTUALIZAR=:m,	
            PERM_ELIMINAR=:e

        WHERE PERM_CODIGO=:id_p");
      
         $query11->execute(array(
            ":id_p"=>$id_pps,
            ":r"=>$id_rol,
            ":p"=>$id_ops,  
            ":c"=>$c11,
            ":i"=>$i11,
            ":m"=>$m11,
            ":e"=>$e11
        ));
        
        
        
       if ($query and $query1 and $query2 and $query3 and $query4 and $query5 and $query6 and $query7 and $query8 and $query9 and $query10 and $query11) {
		/*$sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
		VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
	    $resultado2=$conexion->prepare($sql2);	
		$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>36,":accion"=>'NUEVO',":descr"=>'AÑADIO PERMISOS A ROL',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));
		*/
		echo '<script>
                    Swal.fire({
                    title: "¡BIEN!",
                    position: "center",
                    text: "SE ACTUALIZARON LOS PERMISOS CORRECTAMENTE",
                    icon: "success",
                    type: "success"
                    }).then(function() {
                    window.location = "../vistas/editar_permisos.php";
                    });
                  </script>';	
	   } 
      
	  
	   
	 
        $query->closeCursor();
        $query1->closeCursor();
        $query2->closeCursor();
        $query3->closeCursor();
        $query4->closeCursor();
        $query5->closeCursor();
        $query6->closeCursor();
        $query7->closeCursor();
        $query8->closeCursor();
        $query9->closeCursor();
        $query10->closeCursor();
        $query11->closeCursor();


	
    }
	}catch(Exception $e){			
		
		echo "Codigo del error" . $e->getLine();	
	}

?>
</body>
</html>