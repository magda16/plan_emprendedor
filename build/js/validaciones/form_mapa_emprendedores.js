$(document).ready(function(){

    $("#div_genero").hide();
    $("#div_edad").hide();
    $("#div_ubicacion").hide();
    $("#div_actividad_economica").hide();
    $("#div_tiempo_operacion").hide();

    //Date picker
    $('#fecha_inicio').datepicker({
        autoclose: true
    })

    $.validator.addMethod("numero", function(value, element) {
      return /^[ 0-9-().,]*$/i.test(value);
  }, "Ingrese sólo números");


  $("#form_mostrar_mapa").validate({
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
      mostrar_mapa:{
        required: true
      },
      genero: {
        required: true
      },
      desde: {
        numero: true,
        required: true,
        minlength: 2
      },
      hasta: {
        numero: true,
        required: true,
        minlength: 2
      },
      departamento:{
        required: true,
        number: true
      },
      municipio:{
        required: true,
        number: true
      },
      actividad_economica:{
        required: true
      },
      fecha_inicio: {
        required: true
      }
    },
    messages: {
      mostrar_mapa: {
        required: "Por favor, seleccione criterio."
      },
      genero: {
        required: "Por favor, seleccione género."
      },
      desde: {
        required: "Por favor, ingrese desde.",
        minlength: "Debe ingresar m&iacute;nimo 2 carácteres."
      },
      hasta: {
        required: "Por favor, ingrese hasta.",
        minlength: "Debe ingresar m&iacute;nimo 2 carácteres."
      },
      departamento: {
        required: "Por favor, seleccione departamento."
      },
      municipio: {
        required: "Por favor, seleccione municipio."
      },     
      actividad_economica: {
        required: "Por favor, seleccione actividad económica."
      }, 
      fecha_inicio: {
        required: "Por favor, ingrese fecha de inicio.",
      }
    }
  });


    $.ajax({
      type: 'POST',
      url: '../build/sql/lista_departamentos.php'
    })
    .done(function(lista_departamentos){
        $('#departamento').html(lista_departamentos)
    })
    .fail(function(){
        alert('Error al cargar la Pagina')
    })

    $('#departamento').on('change', function(){
        var id = $('#departamento').val()
        $.ajax({
          type: 'POST',
          url: '../build/sql/lista_municipios.php',
          data: {'id': id}
        })
        .done(function(lista_municipios){
          $('#municipio').html(lista_municipios)
        })
        .fail(function(){
          alert('Error al cargar la Pagina')
        })
      });

      $.ajax({
        type: 'POST',
        url: '../build/sql/lista_actividad_economica.php'
      })
      .done(function(lista_actividad_economica){
          $('#actividad_economica').html(lista_actividad_economica)
      })
      .fail(function(){
          alert('Error al cargar la Pagina')
      })

    $("#mostrar_mapa").on("change", function(){
      
      if($("#mostrar_mapa").val()==="genero"){
        $("#div_genero").show();
        $("#div_edad").hide();
        $("#div_ubicacion").hide();
        $("#div_actividad_economica").hide();
        $("#div_tiempo_operacion").hide();
        $("#desde").val("");
        $("#hasta").val("");
        $("#departamento").val("");
        $("#municipio").val("");
        $("#actividad_economica").val("");
        $("#fecha_inicio").val("");
      }else if($("#mostrar_mapa").val()==="edad"){
        $("#div_edad").show();
        $("#div_genero").hide();
        $("#div_ubicacion").hide();
        $("#div_actividad_economica").hide();
        $("#div_tiempo_operacion").hide();
        $("#genero").val("");
        $("#departamento").val("");
        $("#municipio").val("");
        $("#actividad_economica").val("");
        $("#fecha_inicio").val("");
      }else if($("#mostrar_mapa").val()==="ubicacion"){
        $("#div_ubicacion").show();
        $("#div_genero").hide();
        $("#div_edad").hide();
        $("#div_actividad_economica").hide();
        $("#div_tiempo_operacion").hide();
        $("#genero").val("");
        $("#desde").val("");
        $("#hasta").val("");
        $("#actividad_economica").val("");
        $("#fecha_inicio").val("");
      }else if($("#mostrar_mapa").val()==="actividad_economica"){
        $("#div_actividad_economica").show();
        $("#div_genero").hide();
        $("#div_edad").hide();
        $("#div_ubicacion").hide();
        $("#div_tiempo_operacion").hide();
        $("#genero").val("");
        $("#desde").val("");
        $("#hasta").val("");
        $("#departamento").val("");
        $("#municipio").val("");
        $("#fecha_inicio").val("");
      }else if($("#mostrar_mapa").val()==="tiempo_operacion"){
        $("#div_tiempo_operacion").show();
        $("#div_genero").hide();
        $("#div_edad").hide();
        $("#div_ubicacion").hide();
        $("#div_actividad_economica").hide();
        $("#genero").val("");
        $("#desde").val("");
        $("#hasta").val("");
        $("#departamento").val("");
        $("#municipio").val("");
        $("#actividad_economica").val("");
      }
    });

      $("#btnmapa").click(function(){
        if($("#form_mostrar_mapa").valid()){
          $("#form_mostrar_mapa").submit();      
        }        
      });
   
});

