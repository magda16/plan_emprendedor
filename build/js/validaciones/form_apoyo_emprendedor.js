$(document).ready(function(){

  $.ajax({
    type: 'POST',
    url: '../build/sql/lista_apoyo_emp.php'
    })
    .done(function(lista_emprendedores){
      $('#emprendedor').html(lista_emprendedores)
    })
    .fail(function(){
      alert('Error al cargar la Pagina')
    })

    $("#form_apoyo_socio").validate({
      errorPlacement: function (error, element) {
            $(element).closest('.form-group').find('.help-block').html(error.html());
        },
        highlight: function (element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            $(element).closest('.form-group').find('.help-block').html('');
        },
      rules: {
        emprendedor:{
          required: true,
          number: true
        }
      },
      messages: {
        emprendedor: {
          required: "Por favor, seleccione emprendedor."
        }
      }
    });
  

});

$("#btnlista").click(function(){
   
  if($("#form_apoyo_socio").valid()){

    
  var user = $('#user').val();
  var id_user = $('#id_usuario').val();
  var id_emprendedor = $('#emprendedor').val();
  var table = $('#datatable-responsive').DataTable();
  $.ajax({
    type: 'POST',
    url: '../production/tabla_apoyo_emp.php',
    data: {'user': user, 'id_user': id_user, 'id_emprendedor': id_emprendedor}
  })
  .done(function(obtenerDatos){
    table.destroy();
    $('#div_tabla_apoyo_socio').html(obtenerDatos);
    table=$('#datatable-responsive').DataTable();
                   
  })
  .fail(function(){
    alert('Error al cargar la Pagina')
  })
} 

});