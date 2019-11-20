$(document).ready(function(){

    $("#div_ta").hide();
    $("#div_mta").hide();
    $("#m_mapa").hide();

    //Date picker
    $('#fecha_ingreso').datepicker({
        autoclose: true
    })
  
    /*$('#genero').on('change', function(){
      var genero = $('#genero').val()
      $.ajax({
        type: 'POST',
        url: '../production/mapas.php',
        data: {'genero': genero}
      })
      .done(function(obtenerDatos){
        
        $('#m_mapa').html(obtenerDatos);
        $("#m_mapa").show();

                       
      })
      .fail(function(){
        alert('Error al cargar la Pagina')
      })
    });*/
   
  

});

