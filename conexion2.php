<?php
$mysqli= new mysqli("localhost", "root", "santosdmg2016","oj");
if(mysqli_connect_error()){
    echo 'Conecion Fallida: ', mysqli_connect_error();
    exit();
}
?>