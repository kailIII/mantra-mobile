<?php session_start();

include("../../config/siteconfig.php");

$tools = new FactoryDAO('db');

$usuario = Formulario::getvar("user",$_POST);
$clave = Formulario::getvar("clave",$_POST);


$data = $tools->getDataLogin($usuario,$clave);


if(!empty($data["id"])){
    
    $_SESSION['PROFILE'] = $data["profile"]; ///perfil requerido
    $_SESSION['USERID'] = $data["id"];
    $_SESSION['USERNAME'] = $data["nombre"];
    $_SESSION['CUENTAID'] = $data["cid"];
    $_SESSION['MONEDA1'] = $data["moneda1"];
    $_SESSION['CUENTA'] = $data["cnombre"];
    $tools->setCuentaID($_SESSION['CUENTAID']);
    
    /////registro de acceso efectivo
    $vector[0] =  $_SESSION['CUENTAID'];
    $vector[1] = $_SERVER['REMOTE_ADDR'];
    $vector[2] = $_SESSION['PROFILE'];
    $vector[3] = $_SESSION['USERID'];
    $vector[4] =  $tools->getCurrentDate();
    $vector[5] =  $_SERVER['HTTP_USER_AGENT'];
    
    
    $tools->insertar2("tbl_acceso", "cuenta_id,ipaddress,perfil,userid,fecha,cliente_info", $vector);
    
    $_SESSION['SESIONID'] = $tools->getUltimoId(); ///id del acceso
    
    
    ///////////////
    
    
}else{
    $_SESSION['PROFILE'] = "";
}
    


$is_login = (!empty($_SESSION['PROFILE']) ? 1 : 0);
    
echo $is_login;


$tools->cerrar();

?>
