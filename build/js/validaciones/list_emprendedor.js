$(document).ready(function(){
    var estado = $('#estado').val();
    $.ajax({
      type: 'POST',
      url: '../production/tabla_emprendedores.php',
      data: {'estado': estado}
    })
    .done(function(obtenerDatos){
      $('#div_tabla_emprendedores').html(obtenerDatos);
      table=$('#datatable-responsive').DataTable();
                     
    })
    .fail(function(){
      alert('Error al cargar la Pagina')
    })


$('input[id=estado_e]').on('change', function() {
  if ($(this).is(':checked') ) {
    var estado = "Activo";
    var table = $('#datatable-responsive').DataTable();
    $.ajax({
      type: 'POST',
      url: '../production/tabla_emprendedores.php',
      data: {'estado': estado}
    })
    .done(function(obtenerDatos){
      table.destroy();
      $('#div_tabla_emprendedores').html(obtenerDatos);
      table=$('#datatable-responsive').DataTable();
                     
    })
    .fail(function(){
      alert('Error al cargar la Pagina')
    })
  } else {
    var estado = "Inactivo";
    var table = $('#datatable-responsive').DataTable();
    $.ajax({
      type: 'POST',
      url: '../production/tabla_emprendedores.php',
      data: {'estado': estado}
    })
    .done(function(obtenerDatos){
      table.destroy();
      $('#div_tabla_emprendedores').html(obtenerDatos);
      table=$('#datatable-responsive').DataTable();
                     
    })
    .fail(function(){
      alert('Error al cargar la Pagina')
    })
  }

});

$($("#btncancelar")).on('click', function() {
  
  $("#from_agregar_foto")[0].reset();
  $(".form-group").removeClass("has-success").addClass("");
  $('#modal_agregar_foto').modal('hide');   

});



$("#from_agregar_foto").validate({
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
    foto:{
      required: true
    },
    descripcion:{
      required: false,
      minlength: 3
    }
  },
  messages: {
    foto: {
      required: "Por favor, seleccione foto."
    },
    descripcion:{
      required: "Por favor, ingrese descripción.",
      minlength: "Debe ingresar m&iacute;nimo 3 carácteres."
    }
  }
});


});

function mostrar_emprendedor(id){
    $("#mostrar").val(id);
    $("#from_mostrar_emprendedor").submit();
   }
   
   function editar_emprendedor(id){
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
      $("#from_editar_emprendedor").submit();
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

   function agregar_foto(id){
    $('#baccion').val(id);
    $('#modal_agregar_foto').modal({show:true});
   }
   

  $("#btnguardar").click(function(){
    if($("#from_agregar_foto").valid()){
      $("#bandera").val("add");
      var formData = new FormData($("#from_agregar_foto")[0]);
      $.ajax({
        type: 'POST',
        url: '../build/sql/crud_agregar_foto.php',
        //datos del formulario
        data: formData,
        //necesario para subir archivos via ajax
        cache: false,
        contentType: false,
        processData: false,
      })
      .done(function(resultado_ajax){
        if(resultado_ajax === "Exito"){

          PNotify.success({
            title: 'Éxito',
            text: 'Registro almacenado.',
            styling: 'bootstrap3',
            icons: 'bootstrap3'
          });

          $("#from_agregar_foto")[0].reset();
          $(".form-group").removeClass("has-success").addClass("");
          $('#modal_agregar_foto').modal('hide');       
            
        }
        if(resultado_ajax === "Error"){
        
          PNotify.error({
            title: 'Error',
            text: 'Sin conexión a la base de datos.',
            styling: 'bootstrap3',
            icons: 'bootstrap3'
          });

          $("#from_agregar_foto")[0].reset();
          $(".form-group").removeClass("has-success").addClass("");
          $('#modal_agregar_foto').modal('hide');     
    
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


   
   
   function dar_baja_emprendedor(id){
   
    var notice = PNotify.notice({
      title: 'Advertencia',
      text: '¿Esta seguro que desea dar de baja al registro?',
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
        var bandera = "dar_baja";
        $.ajax({
         type: 'POST',
         url: '../build/sql/crud_emprendedores.php',
         data: {'bandera' : bandera, 'id' : id}
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
                      location.href='../production/lista_emprendedores.php';
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


   function dar_alta_emprendedor(id){
   
    var notice = PNotify.notice({
      title: 'Advertencia',
      text: '¿Esta seguro que desea activar el registro?',
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
        var bandera = "dar_alta";
        $.ajax({
         type: 'POST',
         url: '../build/sql/crud_emprendedores.php',
         data: {'bandera' : bandera, 'id' : id}
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
                      location.href='../production/lista_emprendedores.php';
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