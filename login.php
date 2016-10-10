
<?php
    require('conexion.php');
    session_start();
    
    if(isset($_SESSION["id_us"]))
    {
        header("location: prinadm.php");
    }
    if(!empty($_POST))
    {
        $usuario = mysqli_real_escape_string($mysqli, $_POST['usuarioL']);
        $contra = mysqli_real_escape_string($mysqli, $_POST['contraL']);
        $error = '';
        
        $sha1_contra = sha1($contra);
        
        $sql="select E.IdEmpleado, U.Estado from Empleado as E inner join Tribunal as T on E.IdTribunal = T.IdTribunal inner join Cargo as C on E.IdCargo = C.IdCargo inner join Usuarios as U on E.IdEmpleado = U.IdEmpleado where U.Usuario='$usuario' AND U.Contrasena='$sha1_contra'";
        #$sql = "SELECT id, id_tipo FROM usuario WHERE usuario='$usuario' AND pas ='$sha1_contra'";
        $result = $mysqli->query($sql);
        $rows = $result->num_rows;
        
        if($rows>0)
        {
            $row= $result->fetch_assoc();
            if($row['Estado']==1)
            {
                
                $_SESSION['id_us'] = $row['IdEmpleado'];

                header("location: prinadm.php");
            }
            else
            {
                $error="Su usuario esta deshabilitado, consulte con el administrador";
            }
            
        } else
        {
                
            $error = "El nombre o contraseña incorrecta";
        }    
    }
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Iniciar Sesión</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">
	  	<div class="container">
	  	
		      <form class="form-login" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
		        <h2 class="form-login-heading">Inicio de Sesión</h2>
		        <div class="login-wrap">
		            <input type="text" class="form-control" id="idusuarioL" name="usuarioL" placeholder="Usuario" autofocus>
		            <br>
		            <input id="idcontraL" name="contraL" type="password" class="form-control" placeholder="Contraseña">
		            <label class="checkbox">
		                <span class="pull-right">
		                    <a data-toggle="modal" href="login.html#myModal"> <?php
                                echo $error;
                            ?></a>
		
		                </span>
		            </label>
		            
                    <button class="btn btn-theme btn-block"  type="submit"><i class="fa fa-lock"></i> INICIAR SESIÓN</button>
		            <hr>
		        </div>
		      </form>	  	
	  	
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/fondo1.jpg", {speed: 500});
    </script>


  </body>
</html>
