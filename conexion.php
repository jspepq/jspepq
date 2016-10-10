<?php
$l= "localhost";
$us= "root";
$pas = "santosdmg2016";
$db = "ojcomp";
$mysqli= new mysqli($l, $us, $pas,$db);
$acentos = $mysqli->query("SET NAMES 'utf8'");
if(mysqli_connect_error()){
    echo 'Conecion Fallida: ', mysqli_connect_error();
    exit();
}
?>