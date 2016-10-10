<?php
    
require('conexion.php');
    
    $sql = "select C.NombreCategoria as 'label', count(C.IdCategoria) as 'value' from Preso_Procesos as Pp inner join ProcesosDelito as Pd on Pp.IdProcesoPersona= Pd.IdProcesoPersona inner join Categoria as C on Pd.IdCategoria=C.IdCategoria group by C.NombreCategoria";
    $result = $mysqli->query($sql);
    $rows = $result->num_rows;
    $datos = array();
    $i=0;
    if($rows>0)
    {
                   foreach ($result as $row){
                       $datos[] = $row;
                   }
        $result->close();
        $mysqli->close();

    //imprimimos los datos en formato json
    print json_encode($datos);

    }

    
    //retorna los datos
    //$datos = array();
    //
    



?>