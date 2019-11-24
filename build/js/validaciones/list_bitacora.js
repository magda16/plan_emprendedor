$(document).ready(function(){
    var id_usuario = $('#id_usuario').val();
    $.ajax({
      type: 'POST',
      url: '../production/tabla_bitacora.php',
      data: {'id_usuario': id_usuario}
    })
    .done(function(obtenerDatos){
      $('#div_tabla_bitacora').html(obtenerDatos);
      table=$('#datatable-responsive').DataTable();
                     
    })
    .fail(function(){
      alert('Error al cargar la Pagina')
    })

});