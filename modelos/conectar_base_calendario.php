   <?php
        header('Content-Type: application/json');
       // $pdo=new PDO("mysql:dbname=clime_home;host=127.0.0.1","root","");
         require '../modelos/conectar.php';
         //Para guardar la acción en la base o solo leer la información
          $accion=(isset($_GET['accion']))?$_GET['accion']:'leer';
          
          switch($accion){
                case 'agregar':
                  //instruccion de agregar
                  $sentenciaSQL= $conexion->prepare("INSERT INTO 
                  tbl_citas(id,emp_codigo,title,descripcion,color,textColor,start,end)
                  VALUES(:id,:EMP,:title,:descripcion,:color,:textColor,:start,:end)");
                  
                  $respuesta=$sentenciaSQL->execute(array(
                    "id"=>$_POST['id'],
                    "EMP"=>$_POST['EMP'],
                    "title"=>$_POST['title'],
                    "descripcion"=>$_POST['descripcion'],
                    "color"=>$_POST['color'],
                    "textColor"=>$_POST['textColor'],
                    "start"=>$_POST['start'],
                    "end"=>$_POST['end']
                  ));
                  echo json_encode($respuesta);
                break;

                case 'eliminar':
                  //instruccion de eliminar
                  $respuesta=false;
                  if(isset($_POST['id'])){
                    $sentenciaSQL= $conexion->prepare("DELETE FROM tbl_citas WHERE id=:id");
                    $respuesta=$sentenciaSQL->execute(array("id"=>$_POST['id']));
                  }
                  echo json_encode($respuesta);

                  break;
                case 'modificar':
                  //instruccion de modificar
                  $sentenciaSQL= $conexion->prepare("UPDATE tbl_citas SET
                  title=:title, 
                  emp_codigo=:EMP, 
                  descripcion=:descripcion,
                  color=:color, 
                  textColor=:textColor,
                  start=:start, 
                  end=:end 
                  WHERE id=:id
                  ");
                   
                   $respuesta=$sentenciaSQL->execute(array(
                    "id"=>$_POST['id'],
                    "EMP"=>$_POST['EMP'],
                    "title"=>$_POST['title'],
                    "descripcion"=>$_POST['descripcion'],
                    "color"=>$_POST['color'],
                    "textColor"=>$_POST['textColor'],
                    "start"=>$_POST['start'],
                    "end"=>$_POST['end']
                  ));
                  echo json_encode($respuesta);
                  break;
                default:
                  $sentenciaSQL= $conexion->prepare("SELECT * FROM tbl_citas");
                  $sentenciaSQL->execute();
                  $resultado=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
                  echo json_encode($resultado);
                   break;
          }
     
   ?>