<?php

session_start();

$profile = "vendor";
include("../../../config/siteconfig.php");

$catid = formulario::getvar("id", $_POST);

if ($catid > 0) {
    $tool = new factoryDAO("db");
    $lista = $tool->getComboProdByCatId($catid);
    $tool->cerrar();
    echo $lista;
} else {

    echo LANG_SelectCatProd;
}
?>
