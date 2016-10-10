
$(document).ready(function(){
    
   
    //Ejemplo 1
    $("#btng1").click(function(event) {
      var an = $("#aniog1").val().toString();
        
        $("#htmlext").load('g1.php?an='+an);
        
        
        
    });
    
    $("#btng3").click(function(event)
                     {
        $("#htmlext3").load('gp3.php');
    });
    
     //Reiniciar contenido
    $(".reiniciar").click(function(){
         $('#htmlext').html("hola");
    });

});