<?php
    $a = $_GET['an'];
?>
<html>
<head>
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
	<link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">    
    <link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">  
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <script src="assets/js/chart-master/Chart.js"></script>
    </head>
    
    <body>
                        <div id="gr_bar" class="graph"></div>
                 
        
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
        
        var a="<?php echo $a;?>";
        $.ajax({
		url : "http://jspepq.com/mesdelito.php?anio=".concat(a),
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
        </script>
    </body>
</html>