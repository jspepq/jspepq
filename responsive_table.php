<?php
    
    session_start();
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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>JSPEPQ - General</title>

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
              <h4 style="padding-top:50px;"><i class="fa fa-angle-right"></i> Tabla General - Privados de Libertad</h4>
               <div style="padding-left: 0px; padding-top:30px;">
                              <input  id="lnomb" type="text"  placeholder="Escriba el nombre de la persona" name="lnomb" size="40">
                                  <span >
                                      <input type="button" id="btntab" value="Buscar" />

                                  </span>
                              </div>
          	<div id="divtab" class="row mt">
              
              </div>
              <div>
                  <br>
                  TC = Total Coporal<br>
                  BC = Buena Conducta<br>
                  LC = Libertad Condicional<br>
                  MP = Mitad de la Pena<br>
            
              </div>
            

		</section><! --/wrapper -->
      </section><!-- /MAIN CONTENT -->

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2016 - Facultad de Ingeniería, Mesoamericana Quetzaltenango
              <a href="responsive_table.php#" class="go-top">
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
    <script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->
     <script>
        $(document).ready(function(){


        //Ejemplo 1
        $("#btntab").click(function(event) {
          var nomb = $("#lnomb").val().toString();

            $("#divtab").load('llentab.php?nomb='+nomb);



        });

});
    </script>

  </body>
</html>
