<?php 
$tool = new Formulario("db");

$id = $tool->getvar("id",$_GET);

$datos = $tool->simple_db("select * from tbl_producto where cuenta_id = {$_SESSION['CUENTAID']} and id = $id ");


?>
