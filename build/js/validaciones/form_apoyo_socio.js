$(document).ready(function(){

    $("#div_ta").hide();
    $("#div_mta").hide();
    $("#div_emp").hide();

    //Date picker
    $('#fecha_ingreso').datepicker({
        autoclose: true
    })
  
    $.validator.addMethod("numero", function(value, element) {
        return /^[ 0-9-().,]*$/i.test(value);
    }, "Ingrese sólo números");


    $("#form_ayuda_recibida").validate({
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
        nombre_cooperante: {
          required: true,
          minlength: 3
        },
        monto: {
          numero: true,
          required: true,
          minlength: 2
        }, 
        tipo_ayuda:{
          required: true
        },
        otro_tipo_ayuda: {
          required: true,
          minlength: 3
        },
        fecha_ingreso: {
          required: true
        },
        emprendedor:{
          required: true,
          number: true
        }
      },
      messages: {
        nombre_cooperante: {
          required: "Por favor, ingrese nombre cooperante.",
          minlength: "Debe ingresar m&iacute;nimo 3 carácteres."
        },
        monto: {
          required: "Por favor, ingrese monto.",
          minlength: "Debe ingresar m&iacute;nimo 2 carácteres."
        },
        tipo_ayuda: {
          required: "Por favor, seleccione tipo ayuda."
        },  
        otro_tipo_ayuda: {
          required: "Por favor, ingrese otro tipo ayuda.",
          minlength: "Debe ingresar m&iacute;nimo 3 carácteres."
        },       
        fecha_ingreso: {
          required: "Por favor, ingrese fecha de ingreso.",
        },
        emprendedor: {
          required: "Por favor, seleccione emprendedor."
        }
      }
    });

    $('input[id=cta]').on('change', function() {
      if ($(this).is(':checked') ) {
          $("#div_mta").show();
      } else {
          $("#div_mta").hide();
      }
    });

      $("#tipo_ayuda").on("change", function(){
        if($("#tipo_ayuda").val()==="otro_ta"){
          $("#div_ta").show();
        }else{
          $("#div_ta").hide();
          $("#otro_tipo_ayuda").val("");
        }
      });

      $('input[id=em]').on('change', function() {
        if ($(this).is(':checked') ) {
            $("#div_emp").show();
        } else {
            $("#div_emp").hide();
            $("#emprendedor").val("");
        }
      });

      $.ajax({
        type: 'POST',
        url: '../build/sql/lista_emprendedores.php'
        })
        .done(function(lista_emprendedores){
          $('#emprendedor').html(lista_emprendedores)
        })
        .fail(function(){
          alert('Error al cargar la Pagina')
        })


  $("#btnguardar").click(function(){
 if($("#form_ayuda_recibida").valid()){
  $('#bandera').val("add");
  $.ajax({
    type: 'POST',
    url: '../build/sql/crud_ayudas_recibidas.php',
    data: $("#form_ayuda_recibida").serialize()
  })
  .done(function(resultado_ajax){
    if(resultado_ajax === "Exito"){
       $("#form_ayuda_recibida")[0].reset();
       $(".form-group").removeClass("has-success").addClass("");
       PNotify.success({
         title: 'Éxito',
         text: 'Registro almacenado.',
         styling: 'bootstrap3',
         icons: 'bootstrap3'
       });
    }
    if(resultado_ajax === "Error"){
     $("#form_ayuda_recibida")[0].reset();
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
   if($("#form_ayuda_recibida").valid()){
    $('#bandera').val("edit");
    $.ajax({
      type: 'POST',
      url: '../build/sql/crud_ayudas_recibidas.php',
      data: $("#form_ayuda_recibida").serialize()
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
                   location.href='../production/lista_ayudas_recibidas.php';
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
                 location.href='../production/lista_ayudas_recibidas.php';
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

