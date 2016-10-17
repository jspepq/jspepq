<?php
require 'conexion.php';
    
header('Content-Type: application/json');
$sql ="select date_format(Pp.FechaDetencion, '%Y') AS Anio, count(Pd.IdCategoria) as 'Cantidad'  from Persona_Procesos as Pp inner join ProcesosDelito as Pd on Pp.IdProcesoPersona= Pd.IdProcesoPersona inner join Categoria as C on Pd.IdCategoria= C.IdCategoria group by date_format(Pp.FechaDetencion, '%Y')";
 $result = $mysqli->query($sql);

$datos = array();
foreach ($result as $row){
    $datos[] = $row;
}

//imprimimos los datos en formato json
print json_encode($datos);
?>