<?php session_start();

$profile = "vendor";
include("../../../config/siteconfig.php");


$idProd = Formulario::getvar("producto", $_POST);
$cantProd = Formulario::getvar("cantidad", $_POST);


/////////sino me vienen id de productos
if(empty($idProd)){
    
    require_once 'printOrder.php';
    die();
    
}



///////*****VARIABLES DE SESION ARA ALMACENAR ITEMS DE LOS PEDIDOS
require("initOrder.php");

$tool = new FactoryDAO("db");
$data = $tool->getProdDataStock($idProd);

////***********llenando vectores
if(!in_array($idProd, $_SESSION['PEDIDO_PRODID'])){ ////si no ha sido añadido el producto
    
    array_push($_SESSION['PEDIDO_PRODID'], $idProd);
    array_push($_SESSION['PEDIDO_PRODNOMBRE'], $data['descripcion']);
    array_push($_SESSION['PEDIDO_PRODCANT'], $cantProd);
    array_push($_SESSION['PEDIDO_PRODPRECIO'], $data['precio1']);

}else{ ///sumo la cantidad
    
    $pos = array_search($idProd, $_SESSION['PEDIDO_PRODID']);
    $_SESSION['PEDIDO_PRODCANT'][$pos] = $cantProd;
    
}


$tool->cerrar();


require_once 'printOrder.php';


?>
