$(document).ready(function(){
     
     $("#form_cambiar_clave").validate({
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
         clave: {
            required: true,
            minlength: 5,
            maxlength: 30
         },
         nueva_clave: {
            required: true,
            minlength: 5,
            maxlength: 30
         },
         confirmar_clave: {
          required:true,
          equalTo: "#nueva_clave"
         }
       },
       messages: {
         clave: {
            required: "Por favor, ingrese contraseña.",
            maxlength: "Debe ingresar m&aacute;ximo 30 carácteres.",
            minlength: "Debe ingresar m&iacute;nimo 5 carácteres."
         },
         nueva_clave: {
            required: "Por favor, ingrese contraseña.",
            maxlength: "Debe ingresar m&aacute;ximo 30 carácteres.",
            minlength: "Debe ingresar m&iacute;nimo 5 carácteres."
         },          
         confirmar_clave: {
           required: "Por favor, ingrese contraseña.",
           equalTo: "Contrase&ntilde;a no coincide"
         }
       }
     });

  $("#btneditar").click(function(){

    if($("#form_cambiar_clave").valid()){
     $('#bandera').val("edit_clave");
     $.ajax({
       type: 'POST',
       url: '../build/sql/crud_usuarios.php',
       data: $("#form_cambiar_clave").serialize()
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
                  location.href='../production/index.php';
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
        text: 'Contraseña Actual Inválida o \nSin conexión a la base de datos.',
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
                location.href='../production/cambiar_clave.php';
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
      

  }
     
    });

});



