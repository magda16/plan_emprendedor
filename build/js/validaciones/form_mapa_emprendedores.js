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
      'criterio[]': { 
        required: true
      },
      desde: {
        numero: true,
        required: true,
        minlength: 1
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
      canton:{
        required: false,
        number: false
      },
      comunidad:{
        required: false,
        number: false
      },
      actividad_economica:{
        required: true
      },
      fecha_inicio: {
        required: true
      }
    },
    messages: {
      'criterio[]': { 
        required: "Por favor, seleccione criterio."
      },
      genero: {
        required: "Por favor, seleccione género."
      },
      desde: {
        required: "Por favor, ingrese desde.",
        minlength: "Debe ingresar m&iacute;nimo 1 caracter."
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
      canton: {
        required: "Por favor, seleccione cantón."
      },
      comunidad: {
        required: "Por favor, seleccione comunidad."
      },    
      actividad_economica: {
        required: "Por favor, seleccione actividad económica."
      }, 
      fecha_inicio: {
        required: "Por favor, ingrese fecha de inicio.",
      }
    }
  });

  $("input[id='genero_c']").on("change", function() {
    if ($(this).is(':checked') ) {
      $("#div_genero").show();
    } else {
      $("#div_genero").hide();
      $("#genero").val("");
    }
  });

  $("input[id='edad_c']").on("change", function() {
    if ($(this).is(':checked') ) {
      $("#div_edad").show();
    } else {
      $("#div_edad").hide();
      $("#desde").val("");
      $("#hasta").val("");
    }
  });

  $("input[id='ubicacion_c']").on("change", function() {
    if ($(this).is(':checked') ) {
      $("#div_ubicacion").show();
    } else {
      $("#div_ubicacion").hide();
      $("#departamento").val("");
      $("#municipio").val("");
      $("#canton").val("");
      $("#comunidad").val("");
    }
  });

  $("input[id='actividad_economica_c']").on("change", function() {
    if ($(this).is(':checked') ) {
      $("#div_actividad_economica").show();
    } else {
      $("#div_actividad_economica").hide();
      $("#actividad_economica").val("");
    }
  });

  $("input[id='tiempo_operacion_c']").on("change", function() {
    if ($(this).is(':checked') ) {
      $("#div_tiempo_operacion").show();
    } else {
      $("#div_tiempo_operacion").hide();
      $("#fecha_inicio").val("");
    }
  });

    $.ajax({
      type: 'POST',
      url: '../build/sql/lista_departamentos_e.php'
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
          url: '../build/sql/lista_municipios_e.php',
          data: {'id': id}
        })
        .done(function(lista_municipios){
          $('#municipio').html(lista_municipios)
        })
        .fail(function(){
          alert('Error al cargar la Pagina')
        })
      });

      $('#municipio').on('change', function(){
        var id_departamento = $('#departamento').val()
        var id_municipio = $('#municipio').val()
        $.ajax({
          type: 'POST',
          url: '../build/sql/lista_canton_e.php',
          data: {'id_departamento': id_departamento, 'id_municipio': id_municipio}
        })
        .done(function(lista_canton){
          $('#canton').html(lista_canton)
        })
        .fail(function(){
          alert('Error al cargar la Pagina')
        })
      });

      $('#canton').on('change', function(){
        var id_departamento = $('#departamento').val()
        var id_municipio = $('#municipio').val()
        $.ajax({
          type: 'POST',
          url: '../build/sql/lista_comunidad_e.php',
          data: {'id_departamento': id_departamento, 'id_municipio': id_municipio}
        })
        .done(function(lista_comunidad){
          $('#comunidad').html(lista_comunidad)
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

      $("#btnmapa").click(function(){
        if($("#form_mostrar_mapa").valid()){
          $("#form_mostrar_mapa").submit();      
        }        
      });
   
});

