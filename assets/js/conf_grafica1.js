$(document).ready(function(){
	$.ajax({
		url : "http://localhost/oj/delitos.php",
		method : "GET",
		success : function(datos) {
			Morris.Donut({
                element: 'gr_dona',
                data:datos ,
                colors: ['#3498db', '#2980b9', '#34495e','#ed5565','#4ECDC4','#fff344'],
                formatter: function(y){
                    return y 
                }
            });
    
            
		},
		error : function(datos) {
			console.log(datos);
		}
	});
    
   
});