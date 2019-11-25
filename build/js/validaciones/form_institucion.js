$(document).ready(function(){

    $("#div_depto").hide();

    $("#form_institucion").validate({
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
        nombre_institucion: {
          required: true,
          minlength: 3
        },
        areas_trabajo: {
          required: true,
          minlength: 3
        }, 
        producto_servicio_emp: {
          required: true,
          minlength: 3
        }, 
        departamento:{
            required: true,
            number: true
        },
        municipio:{
            required: true,
            number: true
        }
      },
      messages: {
        nombre_institucion: {
          required: "Por favor, ingrese nombre institución.",
          minlength: "Debe ingresar m&iacute;nimo 3 carácteres."
        },
        areas_trabajo: {
          required: "Por favor, ingrese áreas de trabajo.",
          minlength: "Debe ingresar m&iacute;nimo 3 carácteres."
        },
        producto_servicio_emp: {
          required: "Por favor, ingrese productos y servicios al emprendedor.",
          minlength: "Debe ingresar m&iacute;nimo 3 carácteres."
        },
        departamento: {
            required: "Por favor, seleccione departamento."
        },
        municipio: {
            required: "Por favor, seleccione municipio."
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

        $('input[id=depto]').on('change', function() {
          if ($(this).is(':checked') ) {
              $("#div_depto").show();
          } else {
              $("#div_depto").hide();
              $("#departamento").val("");
              $("#municipio").val("");
          }
        });
    


  $("#btnguardar").click(function(){
 if($("#form_institucion").valid()){
  $('#bandera').val("add");
  $.ajax({
    type: 'POST',
    url: '../build/sql/crud_instituciones.php',
    data: $("#form_institucion").serialize()
  })
  .done(function(resultado_ajax){
    if(resultado_ajax === "Exito"){
       $("#form_institucion")[0].reset();
       $(".form-group").removeClass("has-success").addClass("");
       PNotify.success({
         title: 'Éxito',
         text: 'Registro almacenado.',
         styling: 'bootstrap3',
         icons: 'bootstrap3'
       });
    }
    if(resultado_ajax === "Error"){
     $("#form_institucion")[0].reset();
     $(".form-group").removeClass("has-success").addClass("");
     PNotify.error({
       title: 'Error',
       text: 'Sin conexión a la base de datos.',
       styling: 'bootstrap3',
       icons: 'bootstrap3'
     });

    }             
  })
  .fail(function(){
    alert('Error al cargar la Pagina')
  })
     
 }else{
  PNotify.info({
    title: 'Información',
    text: 'Revise que los datos esten completos.',
    styling: 'bootstrap3',
    icons: 'bootstrap3'
  });

}
  
 });

 $("#btneditar").click(function(){
   if($("#form_institucion").valid()){
    $('#bandera').val("edit");
    $.ajax({
      type: 'POST',
      url: '../build/sql/crud_instituciones.php',
      data: $("#form_institucion").serialize()
    })
    .done(function(resultado_ajax){
      if(resultado_ajax === "Exito"){
         
         PNotify.success({
           title: 'Éxito',
           text: 'Registro actualizado.',
           styling: 'bootstrap3',
           icons: 'bootstrap3',
           hide: false,
           modules: {
             Confirm: {
               confirm: true,
               buttons: [{
                 text: 'Aceptar',
                 primary: true,
                 click: function(notice) {
                   notice.close();
                   location.href='../production/lista_instituciones.php';
                 }
               }]
             },
             Buttons: {
               closer: false,
               sticker: false
             },
             History: {
               history: false
             }
           }
         });
         
      }
      if(resultado_ajax === "Error"){
       
       PNotify.error({
         title: 'Error',
         text: 'Sin conexión a la base de datos.',
         styling: 'bootstrap3',
         icons: 'bootstrap3',
         hide: false,
         modules: {
           Confirm: {
             confirm: true,
             buttons: [{
               text: 'Aceptar',
               primary: true,
               click: function(notice) {
                 notice.close();
                 location.href='../production/lista_instituciones.php';
               }
             }]
           },
           Buttons: {
             closer: false,
             sticker: false
           },
           History: {
             history: false
           }
         }
       });
              
      }             
    })
    .fail(function(){
      alert('Error al cargar la Pagina')
    })   
 
   }else{
    PNotify.info({
      title: 'Información',
      text: 'Revise que los datos esten completos.',
      styling: 'bootstrap3',
      icons: 'bootstrap3'
    });

  }
    
   });

});

