<?php
$a = $_GET['nomb'];
 require('conexion.php');
$sql = "select Pr.NumeroEjecutoria, Pr.NumeroUnico, group_concat(distinct concat(dp.nombre,concat(' ',dp.Apellido))) as nombre, group_concat(distinct C.NombreCategoria) as Delito, Orj.Nombre as Tribunal,Pp.FechaDetencion,Pp.TotalAnio, Pp.TotalMes, Pp.TotalDia, Cp.TC, Cp.BC, Cp.LC, Cp.MP from datosPersonales as dp inner join Persona as p on dp.IdPersona=p.IdPersona inner join AsignacionComputo as Asigc on p.IdPersona=Asigc.IdPersona inner join ComputoPena as Cp on Asigc.IdAsigComputo=Cp.IdAsigComputo inner join Estado as e on p.IdEstado= e.IdEstado inner join Persona_Procesos as Pp on p.IdPersona=Pp.IdPersona inner join ProcesosDelito as Pd on Pp.IdProcesoPersona=Pd.IdProcesoPersona inner join Categoria as C on Pd.IdCategoria = C.IdCategoria inner join Procesos as Pr on Pp.IdProceso=Pr.IdProceso inner join Procedencias as Proc on Pr.IdProcedencia=Proc.IdProcedencia inner join OrganoJurisdiccional as Orj on Proc.IdOrgano=Orj.IdOrgano where concat(dp.nombre,concat(' ',dp.Apellido)) like '%$a%' group by Pr.NumeroEjecutoria, Tribunal,Pp.FechaDetencion,Pp.TotalAnio,  Pp.TotalMes, Pp.TotalDia, Pr.NumeroUnico,Cp.TC, Cp.BC, Cp.LC, Cp.MP;";
$result = $mysqli->query($sql);
$rows = $result->num_rows;

?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>JSPPQ - Tabla General</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <link href="assets/css/table-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
    
    <body>
    
        <div class="row mt" >
              <div class="col-lg-12" style="padding:25px;">
                      <div class="content-panel">
                          <section id="no-more-tables">
                              <table class="table table-bordered table-striped table-condensed cf table-hover" >
                                  <thead class="cf">
                                  <tr>
                                      <th rowspan="2" scope="col">Número de Ejecutoria</th>
                                      <th rowspan="2" scope="col">Número Único</th>
                                      <th rowspan="2" scope="col" class="numeric">Nombre(s)</th>
                                      <th rowspan="2" class="numeric">Delito(s)</th>
                                      <th rowspan="2" class="numeric">Tribunal</th>
                                      <th rowspan="2" class="numeric">Fecha Detención</th>
                                      <th colspan="3" class="numeric">Prisión</th>
                                      <th colspan="4" class="numeric">Cómputo</th>
                                  </tr>
                                      <tr>
                                      <th scope="col">Año(s)</th>
                                      <th scope="col">Mes(es)</th>
                                      <th scope="col">Dia(s)</th>
                                          <th scope="col">TC</th>
                                          <th scope="col">BC</th>
                                          <th scope="col">LC</th>
                                          <th scope="col">MP</th>
                                    
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                      while($rows = mysqli_fetch_array($result)){
                                          echo '<tr>
                                      <td data-title="No. de Ejecutoria">'.$rows[0].'</td>
                                      <td data-title="No. Único">'.$rows[1].'</td>
                                      <td class="numeric" data-title="Nombre(s)">'.$rows[2].'</td>
                                      <td class="numeric" data-title="Delito">'.$rows[3].'</td>
                                      <td class="numeric" data-title="Tribunal">'.$rows[4].'</td>
                                      <td class="numeric" data-title="Fecha Detención">'.$rows[5].'</td>
                                      <td class="numeric" data-title="Año(s)">'.$rows[6].'</td>
                                      <td class="numeric" data-title="Mes(es)">'.$rows[7].'</td>
                                      <td class="numeric" data-title="Dia(s)">'.$rows[8].'</td>
                                      <td class="numeric" data-title="TC">'.$rows[9].'</td>
                                      <td class="numeric" data-title="BC">'.$rows[10].'</td>
                                      <td class="numeric" data-title="LC">'.$rows[11].'</td>
                                      <td class="numeric" data-title="MP">'.$rows[12].'</td>
                                      </tr>';
                                      }
                                          
                                      ?>
                                 
                                  
                                  </tbody>
                              </table>
                          </section>
                      </div><!-- /content-panel -->
                  </div><!-- /col-lg-12 -->
              </div><!-- /row -->
        
        
    </body>
</html>