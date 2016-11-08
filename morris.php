<?php

    session_start();
    require 'conexion.php';

    if(!isset($_SESSION["id_us"])){
        header("Location: login.php");
    }

    $idusuario = $_SESSION['id_us'];
    // para datos del usuario
     $sql ="select E.IdEmpleado, concat(E.Nombre,concat(', ', E.Apellido)) as 'Nombre', E.Correo, T.NombreTribunal, C.Cargo, U.Estado from Empleado as E inner join Tribunal as T on E.IdTribunal = T.IdTribunal inner join Cargo as C on E.IdCargo = C.IdCargo inner join Usuarios as U on E.IdEmpleado = U.IdEmpleado where E.IdEmpleado='$idusuario'";
    $resultado = $mysqli->query($sql);
    $row = $resultado->fetch_assoc();


    $sql2 = "select C.NombreCategoria, count(C.IdCategoria) as 'cantidad' from Persona_Procesos as Pp inner join ProcesosDelito as Pd on Pp.IdProcesoPersona= Pd.IdProcesoPersona inner join Categoria as C on Pd.IdCategoria=C.IdCategoria group by C.NombreCategoria";
    $result = $mysqli->query($sql2);
    $rows = $result->num_rows;
    $datos = array();
    $i;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>JSPEPQ-Gráficas</title>

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
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="prinadm.php" class="logo"><b>Juzgado Segundo Pluripersonal de Ejecución Penal, Quetzaltenango</b></a>
            <!--logo end-->

            <div class="top-menu">

            	<ul class="nav pull-right top-menu">
                     <li><div class="nomb">
                        <div style="padding-right: 50px;"  class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                 <i class="li_user"></i>
                            <?php echo $row['Nombre']?>
                            <span class="caret"></span>
                            </button>
                          <ul style="padding: 10px;"  class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li class="dropdown-header">Datos de Usuario</li>
                            <li style="color:black;"><i><?php echo $row['Correo']?></i></li>
                            <li style="color:black;"><i><?php echo $row['NombreTribunal']?></i></li>
                            <li style="color:black;"><i><?php echo $row['Cargo']?></i></li>
                            <li role="separator" class="divider"></li>
                            <li><a class="logout" href="logout.php"><i class="li_lock"></i> Cerrar Sesión</a></li>
                          </ul>
                        </div>

                </div></li>

            	</ul>
            </div>
        </header>
      <!--header end-->

      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">

              	  <p class="centered"><a href="prinadm.php"><img src="assets/img/oj.gif" class="img-circle" width="60"></a></p>
              	  <h5 class="centered">Menú Principal</h5>

                  <li class="mt">
                      <a href="prinadm.php">
                          <i class="fa fa-dashboard"></i>
                          <span>Inicio</span>
                      </a>
                  </li>

                   <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span>Consultas</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="responsive_table.php">General</a></li>
                          <li><a  href="morris.php">Gráficas</a></li>

                          <!--<li><a  href="panels.php">Panels</a></li>-->
                      </ul>
                  </li>
              </ul>
                  </div>
              </aside>
      <!--sidebar end-->

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
          <h3><i class="fa fa-angle-right"></i>Gráficas </h3>
              <!-- page start-->

              <div id="morris">


                  <div class="row mt">
                      <div class="col-lg-6">
                          <div class="content-panel">
                              <h4><i class="fa fa-angle-right"></i> Delitos Anuales</h4>
                              <div class="panel-body">
                                  <div id="gr-graph" class="graph"></div>
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-6">
                          <div class="content-panel">
                              <h4><i class="fa fa-angle-right"></i> Total de Delitos Mensuales</h4>
                              <br>
                              <div style="padding-left: 50px;">
                              <input  id="txtanio" type="text"  placeholder="Ingrese el año" name="txtanio" required="">
                                  <span >
                                      <input type="button" id="btng2" value="Generar Grafica" />
                                  </span>
                              </div>
                              <div id="g2" class="reiniciar">

                                  </div>
                          </div>
                      </div>
                  </div>
                  <div class="row mt">
                      <div class="col-lg-6">
                          <div class="content-panel">
                              <h4><i class="fa fa-angle-right"></i> Categoria de Delitos</h4>

                              <div class="panel-body">
                                  <div id="hero-donut" class="graph"></div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- page end-->
          </section>
      </section><!-- /MAIN CONTENT -->

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2016 - Facultad de Ingeniería, Mesoamericana Quetzaltenango
              <a href="morris.php#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
	<script src="assets/js/raphael-min.js"></script>
	<script src="assets/js/morris-0.4.3.min.js"></script>
    <script src="assets/js/common-scripts.js"></script>

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


      <script>
          $(document).ready(function(){
	$.ajax({
		url : "http://jspepq.com/mesdelito.php",
		method : "GET",
		success : function(datos) {
			console.log(datos);

            Morris.Bar({
                element : 'gr_bar',
                data: datos,
                xkey: 'mes',
                ykeys: ['totaldel'],
                labels: ['Delitos'],
                barRatio: 0.4,
                xLabelAngle: 35,
                hideHover: 'auto',
                barColors: ['#4a8bc2']
            });


		},
		error : function(datos) {
			console.log(datos);
		}
	});


});

      </script>
      <script>
           $(document).ready(function(){
               $("#btng2").click(function() {
                   var anio = $("#txtanio").val().toString();
                   $("#g2").load('g1.php?an='+anio);
               });
           });
      </script>
      <script>

        $.ajax({
		url : "http://jspepq.com/delitosanio.php",
		method : "GET",
		success : function(datos) {
			console.log(datos);

          Morris.Line({
            element: 'gr-graph',
            data: datos,
            xkey: 'Anio',
            ykeys: ['Cantidad'],
            labels: ['Delitos'],
            lineColors:['#4ECDC4','#ed5565']
          });

		},
		error : function(datos) {
			console.log(datos);
		}
	});
        </script>

  </body>
</html>
