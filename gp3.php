<?php
    require('conexion2.php');

    $sql = "select C.NombreCategoria, count(C.IdCategoria) as 'cantidad' from Preso_Procesos as Pp inner join ProcesosDelito as Pd on Pp.IdProcesoPersona= Pd.IdProcesoPersona inner join Categoria as C on Pd.IdCategoria=C.IdCategoria group by C.NombreCategoria";
    $result = $mysqli->query($sql);
    $rows = $result->num_rows;
    $datos = array();
    $i;


?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<title>Highcharts Example</title>

		<script type="text/javascript" src="assets/js/jquery-1.8.3.min.js"></script>
		<style type="text/css">
${demo.css}
		</style>
		<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Delitos'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Delitos',
            data: [
                <?php
                if($rows>0)
                {
                    while($row = mysqli_fetch_array($result))
                    {
                        $datos[$i]=$row;
                        $i++;
                ?>
                ['<?php  echo $row['NombreCategoria'];?>', <?php echo $row['cantidad'];?>],
                <?php }
                }?>

            ]
        }]
    });
});


		</script>
	</head>
	<body>
        <div id="container"></div>

        <script src="assets/Highcharts/js/highcharts.js"></script>
        <script src="assets/Highcharts/js/modules/exporting.js"></script>
	</body>
</html>
