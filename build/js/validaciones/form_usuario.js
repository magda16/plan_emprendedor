$(document).ready(function(){
      
       $.validator.addMethod("numero", function(value, element) {
           return /^[ 0-9-()]*$/i.test(value);
       }, "Ingrese sólo números");
   
       $.validator.addMethod("correo", function(value, element) {
           return /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/i.test(value);
       }, "Ingrese un correo v&aacute;lido.");
   
       $("#form_usuario").validate({
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
           nombre: {
             required: true,
             minlength: 3
           },
           apellido: {
            required: true,
            minlength: 3
          },
          dui: {
            numero: true,
            required: true,
            minlength: 10,
            maxlength: 10
          },
          nit: {
            numero: true,
            required: true,
            minlength: 17,
            maxlength: 17
          },
          usuario: {
            required: true,
            minlength: 5
          }, 
          nivel:{
            required: true
          },
          nivel_e:{
            required: true
          },
           correo: {
            correo: true,
            required: true,
            minlength: 8
          },
          clave: {
            required: true,
            minlength: 5,
            maxlength: 30
          },
          confirmar_clave: {
            required:true,
            equalTo: "#clave"
          }
         },
         messages: {
          nombre: {
            required: "Por favor, ingrese nombre.",
            minlength: "Debe ingresar m&iacute;nimo 3 carácteres."
          },
          apellido: {
            required: "Por favor, ingrese apellido.",
            minlength: "Debe ingresar m&iacute;nimo 3 carácteres."
          },
          dui: {
            required: "Por favor, digite DUI.",
            maxlength: "Debe ingresar m&aacute;ximo 10 dígitos.",
            minlength: "Debe ingresar m&iacute;nimo 10 dígitos."
          },
          nit: {
            required: "Por favor, digite NIT.",
            maxlength: "Debe ingresar m&aacute;ximo 17 dígitos.",
            minlength: "Debe ingresar m&iacute;nimo 17 dígitos."
          },
          usuario: {
            required: "Por favor, ingrese usuario.",
            minlength: "Debe ingresar m&iacute;nimo 5 carácteres."
          },
          nivel: {
            required: "Por favor, seleccione nivel."
          },
          nivel_e: {
            required: "Por favor, seleccione nivel."
          },
           correo: {
            required: "Por favor, ingrese correo electrónico.",
            minlength: "Debe ingresar m&iacute;nimo 8 carácteres."
          },
           clave: {
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

      
        
  
        $('input[id=of]').on('change', function() {
          if ($(this).is(':checked') ) {
              $("#div_o").show();
          } else {
              $("#div_o").hide();
              $("#oficina").val("");
          }
        }); 

        $('input[id=em]').on('change', function() {
          if ($(this).is(':checked') ) {
            $("#div_empresa").append("<div class='form-group' id='div_emp' name='div_emp'><label class='control-label col-md-3 col-sm-3 col-xs-12' for='empresa'>Empresa: <span class='required' style='color: #CD5C5C;'> *</span></label><div class='col-md-6 col-sm-6 col-xs-12'><select class='form-control' id='empresa' name='empresa'></select></div><span class='help-block'></span></div>");
          
            $.ajax({
              type: 'POST',
              url: '../build/sql/lista_empresas.php'
              })
              .done(function(lista_empresas){
                $('#empresa').html(lista_empresas)
              })
              .fail(function(){
                alert('Error al cargar la Pagina')
              })
          } else {
            $("#div_emp").remove();
          }
        }); 

        $("#nivel").on("change", function(){
          if($("#nivel").val()==="Tecnico"){
            $("#div_administrador").append("<div class='form-group' id='div_admin' name='div_admin'><label class='control-label col-md-3 col-sm-3 col-xs-12' for='jefe'>Administrador: <span class='required' style='color: #CD5C5C;'> *</span></label><div class='col-md-6 col-sm-6 col-xs-12'><select class='form-control' id='jefe' name='jefe'></select></div><span class='help-block'></span></div>");
          
            $.ajax({
              type: 'POST',
              url: '../build/sql/lista_administrador.php'
              })
              .done(function(lista_empresas){
                $('#jefe').html(lista_empresas)
              })
              .fail(function(){
                alert('Error al cargar la Pagina')
              })
          }else{
            $("#div_admin").remove();
          }
        });

        
    $("#btnguardar").click(function(){
    if($("#form_usuario").valid()){
     $('#bandera').val("add");
     
     $.ajax({
       type: 'POST',
       url: '../build/sql/crud_usuarios.php',
       data: $("#form_usuario").serialize()
     })
     .done(function(resultado_ajax){
      if(resultado_ajax === "Exito"){
        PNotify.success({
          title: 'Éxito',
          text: 'Registro almacenado.',
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
                  location.href='../production/ingreso_usuario.php';
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
                  location.href='../production/ingreso_usuario.php';
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

    

    $("#btneditar").click(function(){

      if($("#form_usuario").valid()){
       $('#bandera').val("edit");
       $.ajax({
         type: 'POST',
         url: '../build/sql/crud_usuarios.php',
         data: $("#form_usuario").serialize()
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
                    location.href='../production/lista_usuarios.php';
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
                  location.href='../production/lista_usuarios.php';
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
  
  function mostrar_usuario(id){
    $("#mostrar").val(id);
    $("#from_mostrar_usuario").submit();
  }

  function editar_usuario(id){

    var notice = PNotify.notice({
      title: 'Advertencia',
      text: '¿Esta seguro que desea modificar el registro?',
      styling: 'bootstrap3',
      icons: 'bootstrap3',
      icon: true,
      hide: false,
      stack: {
        'dir1': 'down',
        'modal': true,
        'firstpos1': 25
      },
      modules: {
        Confirm: {
          confirm: true
        },
        Buttons: {
          closer: false,
          sticker: false
        },
        History: {
          history: false
        },
      }
    });
    notice.on('pnotify.confirm', function() {
      $("#id").val(id);
      $("#from_editar_usuario").submit();
    });
    notice.on('pnotify.cancel', function() {
      PNotify.success({
        title: 'Éxito',
        text: 'Proceso Cancelado.',
        styling: 'bootstrap3',
        icons: 'bootstrap3'
      });
    });
  }
  
  function eliminar_usuario(id){

    var notice = PNotify.notice({
      title: 'Advertencia',
      text: '¿Esta seguro que desea eliminar el registro?',
      styling: 'bootstrap3',
      icons: 'bootstrap3',
      addclass: 'dark',
      icon: true,
      hide: false,
      stack: {
        'dir1': 'down',
        'modal': true,
        'firstpos1': 25
      },
      modules: {
        Confirm: {
          confirm: true,
        },
        Buttons: {
          closer: false,
          sticker: false
        },
        History: {
          history: false
        },
      }
    });
    notice.on('pnotify.confirm', function() {
      var bandera = "delete";
       $.ajax({
         type: 'POST',
         url: '../build/sql/crud_usuarios.php',
         data: {'bandera' : bandera, 'id' : id}
       })
       .done(function(resultado_ajax){

         if(resultado_ajax === "Exito"){
            
            PNotify.success({
              title: 'Éxito',
              text: 'Registro eliminado.',
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
                      location.href='../production/lista_usuarios.php';
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
            icons: 'bootstrap3'
          });
                 
         }             
       })
       .fail(function(){
         alert('Error al cargar la Pagina')
       })
    });
    notice.on('pnotify.cancel', function() {
      PNotify.success({
        title: 'Éxito',
        text: 'Proceso Cancelado.',
        styling: 'bootstrap3',
        icons: 'bootstrap3'
      });
    });

  }