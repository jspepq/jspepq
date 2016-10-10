$(document).ready(function(){
	$.ajax({
		url : "http://localhost/oj/mesdelito.php",
		method : "GET",
		success : function(datos) {
			console.log(datos);
            var m = [];
            var totdel= [];
            var d = [];
            
            Morris.Bar({
                element : 'gr_bar',
                data: datos,
                xkey: 'mes',
                ykeys: ['totaldel'],
                labels: ['Delitos'],
                barRatio: 0.4,
                xLabelAngle: 35,
                hideHover: 'auto',
                barColors: ['#ac92ec']
            });
    
            
		},
		error : function(datos) {
			console.log(datos);
		}
	});
    
   
});