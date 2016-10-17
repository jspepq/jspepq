<?php
    
    session_start();
    #$inactivo = 120; 
    #if(isset($_SESSION['tiempo']) ) { 
    #$vida_session = time() - $_SESSION['tiempo']; 
    #if($vida_session > $inactivo) 
    #{ 
    #session_destroy(); 
    #header("Location: login.php" ) ; 
    #} 
    #} 

    #$_SESSION['tiempo'] = time() ; 
    require 'conexion.php';
    
    if(!isset($_SESSION["id_us"])){
        header("Location: login.php");
    }
    
    $idusuario = $_SESSION['id_us']; 
    $sql ="select E.IdEmpleado, concat(E.Nombre,concat(', ', E.Apellido)) as 'Nombre', E.Correo, T.NombreTribunal, C.Cargo, U.Estado from Empleado as E inner join Tribunal as T on E.IdTribunal = T.IdTribunal inner join Cargo as C on E.IdCargo = C.IdCargo inner join Usuarios as U on E.IdEmpleado = U.IdEmpleado where E.IdEmpleado='$idusuario'";
    #$sql = "SELECT u.id, p.nombre FROM usuario AS u INNER JOIN persona as p ON u.id_persona = p.id WHERE u.id = '$idusuario'";
    $resultado = $mysqli->query($sql);
    $row = $resultado->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>JSPEPQ</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
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
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Barra de Navegacion"></div>
              </div>
            <!--Logo-->
            <a href="prinadm.php" class="logo"><b>Juzgado Segundo Pluripersonal de Ejecución Penal, Quetzaltenango</b></a>
            
            <!--Fin logo-->
           
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
              
              	  <p class="centered"><a href="prinadm.php"><img src="assets/img/oj.gif" class="img-circle" width="120ss"></a></p>
              	  <h5 class="centered">Menú Principal</h5>
              	  	
                  <li class="mt">
                      <a class="active" href="prinadm.php">
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
                          <li><a  href="morris.php">Graficas</a></li>
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
          <section class="wrapper">

              <div class="row">
                  <div class="col-lg-9 main-chart">
                  
                  	<div class="row ds">
                        
                        <h5 class="text-bod-t">
                        Misión
                        </h5>
                        <h1>Administrar e impartir justicia, garantizando el acceso, atención y debido proceso a la población, en procura de la paz y armonía  social.</h1>
                  		
                  	</div><!-- /row mt -->	
                    
                    <div class="row ds">
                        
                        <h5 class="text-bod-t">
                        Visión
                        </h5>
                        <h1>
                        Ser un organismo de Estado con credibilidad y aprobación social, con personal especializado e íntegro, en condiciones óptimas de funcionamiento, velando por la tramitación oportuna y por la dignidad e igualdad de todas las personas usuarias.
                        </h1>
                  		
                  	</div><!-- /row mt -->
                      
                    <div class="row ds">
                        
                        <h5 class="text-bod-t">
                        Principios
                        </h5>
                        <h1>
                        - Justicia<br>
                        - Independencia<br>
                        - Honorabilidad<br>
                        - Credibilidad<br>
                        - Responsabilidad<br>
                        - Transparencia<br>
                        - Integridad<br>
                        - Eficiencia, Eficacia Y Efectividad<br>
                        - Prudencia<br>
                        - Respeto
                        </h1>
                  		
                  	</div><!-- /row mt -->
                      
                      
                    
                    				
					<div class="row ds" style="background-color:#003366;">
						<!-- TWITTER PANEL -->
						<div class="col-md-4 mb" style="padding:10px;">
                            <img src="assets/img/oj2.jpg" alt="oj2" width="250" height="250">
						</div><!-- /col-md-4 -->
						
						
						<div class="col-md-4 mb">
							 <img src="assets/img/PDH.jpg" alt="ojphd" width="250" height="250">
						</div><!-- /col-md-4 -->
						
						<div class="col-md-4 col-sm-4 mb">
							 <img src="assets/img/xela.jpg" alt="ojxela" width="250" height="250">
						</div><!-- /col-md-4 -->
						
					</div><!-- /row -->
					
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
                  
                  <div class="col-lg-3 ds">
                    <!--COMPLETED ACTIONS DONUTS CHART-->
						<h3>CALENDARIO</h3>
                                        

                        <!-- CALENDAR-->
                        <div id="calendar" class="mb">
                            <div class="panel green-panel no-margin">
                                <div class="panel-body">
                                    <div id="date-popover" class="popover top" style="cursor: pointer; disadding: block; margin-left: 33%; margin-top: -50px; width: 175px;">
                                        <div class="arrow"></div>
                                        <h3 class="popover-title" style="disadding: none;"></h3>
                                        <div id="date-popover-content" class="popover-content"></div>
                                    </div>
                                    <div id="my-calendar"></div>
                                </div>
                            </div>
                        </div><!-- / calendar -->
                      
                  </div><!-- /col-lg-3 -->
              </div><! --/row -->
          </section>
      </section>

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2016 - Facultad de Ingeniería, Mesoamericana Quetzaltenango
              <a href="prinadm.php#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/jquery-1.8.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="assets/js/jquery.sparkline.js"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="assets/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="assets/js/sparkline-chart.js"></script>    
	<script src="assets/js/zabuto_calendar.js"></script>	
	
	<script type="text/javascript">
        $(document).ready(function () {
        var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'Bienvenido a la Pagina Principal',
            // (string | mandatory) the text inside the notification
            text: 'Juzgado Segundo Pluripersonal de Ejecucion Penal de Quetzaltenango',
            // (string | optional) the image to display on the left
            image: 'assets/img/oj.gif',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: true,
            // (int | optional) the time you want it to be alive for before fading out
            time: '',
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'
        });

        return false;
        });
	</script>
	
	<script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });
        
            $("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "show_data.php?action=1",
                    modal: true
                },
                legend: [
                    {type: "text", label: "Special event", badge: "00"},
                    {type: "block", label: "Regular event", }
                ]
            });
        });
        
        
        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>
  
 
  </body>
</html>
