$.ajax({
		url : "http://localhost/oj/delitosanio.php?an=2002",
		method : "GET",
		success : function(datos) {
			console.log(datos);
            
          Morris.Line({
            element: 'gr-graph',
            data: datos,
            xkey: 'anio',
            ykeys: ['cantdelit'],
            labels: ['Delitos'],
            lineColors:['#4ECDC4','#ed5565']
          });

		},
		error : function(datos) {
			console.log(datos);
		}
	});