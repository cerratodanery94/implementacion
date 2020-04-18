<?php
function generar_token(){
    $char="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    srand((double)microtime()*1000000);
    $i=0;
    $pass='';
    while ($i <= 7) {
        $num=rand()%33;
        $tmp=substr($char,$num,1);
        $pass=$pass.$tmp;
        $i++;
    }
    return time().$pass;
}
function mi_edad($fecha_nac){
	//
	$dia=date("j");
	$mes=date("n");
	$anno=date("Y");
	//descomponer fecha de nacimiento
	$anno_nac=substr($fecha_nac, 0, 4);
	$mes_nac=substr($fecha_nac, 5, 2);
	$dia_nac=substr($fecha_nac, 8, 2);
	//
	if($mes_nac>$mes){
		$calc_edad= $anno-$anno_nac-1;
	}else{
		if($mes==$mes_nac AND $dia_nac>$dia){
			$calc_edad= $anno-$anno_nac-1;  
		}else{
			$calc_edad= $anno-$anno_nac;
		}
	}
    return $calc_edad;
}
?>
?>