 
    var estado = $('#estado').val();
    var user = $('#user').val();
    var id_user = $('#id_usuario').val();
    $.ajax({
      type: 'POST',
      url: '../production/tabla_instituciones.php',
      data: {'estado': estado, 'user': user, 'id_user': id_user}
    })
    .done(function(obtenerDatos){
      $('#div_tabla_instituciones').html(obtenerDatos);
      table=$('#datatable-responsive').DataTable();
                     
    })
    .fail(function(){
      alert('Error al cargar la Pagina')
    })


$('input[id=estado_i]').on('change', function() {
  if ($(this).is(':checked') ) {
    var estado = "Activo";
    var user = $('#user').val();
    var id_user = $('#id_usuario').val();
    var table = $('#datatable-responsive').DataTable();
    $.ajax({
      type: 'POST',
      url: '../production/tabla_instituciones.php',
      data: {'estado': estado, 'user': user, 'id_user': id_user}
    })
    .done(function(obtenerDatos){
      table.destroy();
      $('#div_tabla_instituciones').html(obtenerDatos);
      table=$('#datatable-responsive').DataTable();
                     
    })
    .fail(function(){
      alert('Error al cargar la Pagina')
    })
  } else {
    var estado = "Inactivo";
    var user = $('#user').val();
    var id_user = $('#id_usuario').val();
    var table = $('#datatable-responsive').DataTable();
    $.ajax({
      type: 'POST',
      url: '../production/tabla_instituciones.php',
      data: {'estado': estado, 'user': user, 'id_user': id_user}
    })
    .done(function(obtenerDatos){
      table.destroy();
      $('#div_tabla_instituciones').html(obtenerDatos);
      table=$('#datatable-responsive').DataTable();
                     
    })
    .fail(function(){
      alert('Error al cargar la Pagina')
    })
  }
});

function mostrar_institucion(id){
    $("#mostrar").val(id);
    $("#from_mostrar_institucion").submit();
   }
   
   function editar_institucion(id){
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
      $("#from_editar_institucion").submit();
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
   
   function dar_baja_institucion(id){
   
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
         url: '../build/sql/crud_instituciones.php',
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


   function dar_alta_institucion(id){
   
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
         url: '../build/sql/crud_instituciones.php',
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