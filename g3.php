<?php
require('conexion.php');
    
    $sql = "select C.NombreCategoria, count(C.IdCategoria) as 'cantidad' from Preso_Procesos as Pp inner join ProcesosDelito as Pd on Pp.IdProcesoPersona= Pd.IdProcesoPersona inner join Categoria as C on Pd.IdCategoria=C.IdCategoria group by C.NombreCategoria";
    $result = $mysqli->query($sql);
    $rows = $result->num_rows;
    $datos = array();
    $i;
?>
<html>
<head>
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
	<link rel="stylesheet" href="assets/css/morris-0.4.3.min.css">    
    <link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">  
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <script src="assets/js/chart-master/Chart.js"></script>
    </head>
    
    <body>
                        <div id="hero-donut" class="graph"></div>
                 
        
        <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
	<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script src="assets/js/morris-0.4.3.min.js"></script>
    <script src="assets/js/common-scripts.js"></script>
    <!--<script src="assets/js/graf1.js"></script>-->
    <script>
       var Script = function(){
           $(function (){
               Morris.Donut({
                   element: 'hero-donut',
                   data: [
                       <?php
                       if($rows>0)
                       {
                           while($row = mysqli_fetch_array($result)){ 
                               $datos[$i]=$row;
                               $i++;
                       ?>
                       {label: '<?php  echo $row['NombreCategoria'];?>', value: <?php echo $row['cantidad'];?> },
                       <?php 
                           }
                       }
                       ?>
                       
                ],
                  colors: ['#3498db', '#2980b9', '#34495e'],
                formatter: function (y) { return y }
      });
           });
           
       }();
       
        </script>
    </body>
</html>