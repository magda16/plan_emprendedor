$(document).ready(function(){

   

    //Date picker
    $('#fecha_inicio').datepicker({
        autoclose: true
    })

    $('#fecha_fin').datepicker({
      autoclose: true
    })

    //Time picker
    $('#tphora_inicio').datetimepicker({
      format: 'hh:mm A'
    });

    $('#tphora_fin').datetimepicker({
      format: 'hh:mm A'
    });
  
    $.validator.addMethod("numero", function(value, element) {
        return /^[ 0-9-().,]*$/i.test(value);
    }, "Ingrese sólo números");


    $("#form_actividad").validate({
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
        nombre_actividad: {
          required: true,
          minlength: 3
        },
        fecha_inicio: {
          required: true
        },
        fecha_fin: {
          required: true
        },
        hora_inicio: {
          required: true
        },
        hora_fin: {
          required: true
        },
        descripcion: {
          required: true,
          minlength: 3
        }
      },
      messages: {
        nombre_actividad: {
          required: "Por favor, ingrese nombre actividad.",
          minlength: "Debe ingresar m&iacute;nimo 3 carácteres."
        },    
        fecha_inicio: {
          required: "Por favor, ingrese fecha de inicio.",
        },
        fecha_fin: {
          required: "Por favor, ingrese fecha de fin.",
        },
        hora_inicio: {
          required: "Por favor, ingrese hora de inicio.",
        },
        hora_fin: {
          required: "Por favor, ingrese hora de fin.",
        },
        descripcion: {
          required: "Por favor, ingrese nombre descripción.",
          minlength: "Debe ingresar m&iacute;nimo 3 carácteres."
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
 if($("#form_actividad").valid()){
  $('#bandera').val("add");
  $.ajax({
    type: 'POST',
    url: '../build/sql/crud_actividades.php',
    data: $("#form_actividad").serialize()
  })
  .done(function(resultado_ajax){
    if(resultado_ajax === "Exito"){
       $("#form_actividad")[0].reset();
       $(".form-group").removeClass("has-success").addClass("");
       PNotify.success({
         title: 'Éxito',
         text: 'Registro almacenado.',
         styling: 'bootstrap3',
         icons: 'bootstrap3'
       });
    }
    if(resultado_ajax === "Error"){
     $("#form_actividad")[0].reset();
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
   if($("#form_actividad").valid()){
    $('#bandera').val("edit");
    $.ajax({
      type: 'POST',
      url: '../build/sql/crud_actividades.php',
      data: $("#form_actividad").serialize()
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
                   location.href='../production/lista_actividades.php';
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
                 location.href='../production/lista_actividades.php';
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

