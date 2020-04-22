
<?php
//fetch.php
$connect = mysqli_connect("localhost", "root","", "clime_home");
$columns = array('BIT_CODIGO','USU_CODIGO','OBJ_CODIGO','BIT_ACCION','BIT_DESCRIPCION','BIT_FECHA','BIT_HORA');

$query = "SELECT * FROM tbl_bitacora WHERE ";

if($_POST["is_date_search"] == "yes")
{
 $query .= 'BIT_FECHA BETWEEN "'.$_POST["start_date"].'" AND "'.$_POST["end_date"].'" AND ';
}

if(isset($_POST["search"]["value"]))
{
 $query .= '
  (BIT_CODIGO LIKE "%'.$_POST["search"]["value"].'%" 
  OR USU_CODIGO LIKE "%'.$_POST["search"]["value"].'%" 
  OR OBJ_CODIGO LIKE "%'.$_POST["search"]["value"].'%" 
  OR BIT_ACCION LIKE "%'.$_POST["search"]["value"].'%"
  OR BIT_DESCRIPCION  LIKE "%'.$_POST["search"]["value"].'%"
  OR BIT_FECHA LIKE "%'.$_POST["search"]["value"].'%"
  OR BIT_HORA LIKE "%'.$_POST["search"]["value"].'%"
  )';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}


$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
 $sub_array = array();
 $sub_array[] = $row["BIT_CODIGO"];
 $sub_array[] = $row["USU_CODIGO"];
 $sub_array[] = $row["OBJ_CODIGO"];
 $sub_array[] = $row["BIT_ACCION"];
 $sub_array[] = $row["BIT_DESCRIPCION"];
 $sub_array[] = $row["BIT_FECHA"];
 $sub_array[] = $row["BIT_HORA"];
 $data[] = $sub_array;
}
 
function get_all_data($connect)
{
 $query = "SELECT * FROM tbl_bitacora";
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
}
 
$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);
 
echo json_encode($output);
 
?>