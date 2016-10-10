<?php

require 'conexion.php';
    
header('Content-Type: application/json')<
$sql ="select date_format( Pp.FechaDetencion, '%M') as mes, count(Pd.IdCategoria) as 'totaldel'  from Persona_Procesos as Pp inner join ProcesosDelito as Pd on Pp.IdProcesoPersona= Pd.IdProcesoPersona inner join Categoria as C on Pd.IdCategoria= C.IdCategoria where date_format(Pp.FechaDetencion, '%Y') = '2015'  group by date_format( Pp.FechaDetencion, '%M')";
 $result = $mysqli->query($sql);

//retorna los datos
$datos = array();
foreach ($result as $row){
    $datos[] = $row;
}

//imprimimos los datos en formato json
print json_encode($datos);
?>