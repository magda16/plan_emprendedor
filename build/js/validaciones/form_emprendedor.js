var cont2=0;
$(document).ready(function(){
  var cont=2;
  
  
  $("#div_no").hide();
  $("#div_tl").hide();
 
  var current = 1,current_step,next_step,steps;
  steps = $("fieldset").length;
  
  $(".siguiente").click(function(){
   // if($("#form_demandante").valid()){
    current_step = $(this).parent();
    next_step = $(this).parent().next();
    next_step.show();
    current_step.hide();
    setProgressBar(++current);
  //  }
  });
  $(".anterior").click(function(){
    current_step = $(this).parent();
    next_step = $(this).parent().prev();
    next_step.show();
    current_step.hide();
    setProgressBar(--current);
  });
  setProgressBar(current);
  // Change progress bar action
  function setProgressBar(curStep){
    var percent = parseFloat(100 / steps) * curStep;
    percent = percent.toFixed();
    $(".progress-bar")
      .css("width",percent+"%")
      .html(percent+"%");   
  }

    //Date picker
     $('#fecha_ingreso').datepicker({
       autoclose: true
     })

     $('#fecha_nacimiento').datepicker({
      autoclose: true
    })

    $('#fecha_inicio').datepicker({
      autoclose: true
    })


  $.validator.addMethod("numero", function(value, element) {
      return /^[ 0-9-(),.]*$/i.test(value);
  }, "Ingrese sólo números");

  $.validator.addMethod("correo", function(value, element) {
      return /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/i.test(value);
  }, "Ingrese un correo válido.");

  $.validator.addMethod("telef", function (value, element) {
    return this.optional(element) || /^\d{4}-\d{4}$/.test(value);
  }, "Por favor, digite teléfono válido");

  $("#form_demandante").validate({
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
      institucion: {
        required: false,
        minlength: 3
      },
      responsable: {
        required: false,
        minlength: 6
      },
      fecha_ingreso: {
          required: true
      },
      nombre: {
        required: false,
        minlength: 3
      },
      apellido: {
        required: false,
        minlength: 3
      },
      dui: {
        numero: false,
        required: false,
        minlength: 10,
        maxlength: 10
      },
      nit: {
        numero: false,
        required: false,
        minlength: 17,
        maxlength: 17
      },
      fecha_nacimiento: {
        required: true
      },
      comunidad: {
        required: false,
        minlength: 3
      },
      canton: {
        required: false,
        minlength: 3
      },
      departamento:{
        required: false,
        number: false
      },
      municipio:{
        required: false,
        number: false
      },
      'telefono[]': { 
        required: false, 
        telef: false
      },
      correo: {
        correo: false,
        required: false,
        minlength: 8
      },
      profesion:{
        required: false,
        minlength: 3
      },
      nivel_escolar: {
        required: false,
        minlength: 1
      },
      nombre_organizacion: {
        required: false,
        minlength: 3
      }
    },
    messages: {
      institucion: {
        required: "Por favor, ingrese institución.",
        minlength: "Debe ingresar m&iacute;nimo 3 carácteres."
      },
      responsable: {
        required: "Por favor, ingrese responsable.",
        minlength: "Debe ingresar m&iacute;nimo 6 carácteres."
      },
      fecha_ingreso: {
        required: "Por favor, ingrese fecha de ingreso.",
      },
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
      fecha_nacimiento: {
        required: "Por favor, ingrese fecha de nacimiento.",
      },
      comunidad: {
        required: "Por favor, ingrese comunidad.",
        minlength: "Debe ingresar m&iacute;nimo 3 carácteres."
      },
      canton: {
        required: "Por favor, ingrese cantón.",
        minlength: "Debe ingresar m&iacute;nimo 3 carácteres."
      },
      departamento: {
        required: "Por favor, seleccione departamento."
      },
      municipio: {
        required: "Por favor, seleccione municipio."
      }, 
      'telefono[]': { 
        required: "Por favor, digite teléfono.",
      },
      correo: {
        required: "Por favor, ingrese correo electrónico.",
        minlength: "Debe ingresar m&iacute;nimo 8 carácteres."
      },
      profesion: {
        required: "Por favor, ingrese profesión.",
        minlength: "Debe ingresar m&iacute;nimo 3 carácteres."
      }, 
      nivel_escolar: {
        required: "Por favor, ingrese nivel escolar.",
        minlength: "Debe ingresar m&iacute;nimo 1 carácter."
      },
      nombre_organizacion: {
        required: "Por favor, ingrese nombre organización.",
        minlength: "Debe ingresar m&iacute;nimo 3 carácter."
      }
    }
  });
  


     function calculateAge(birthday) {
      var birthday_arr = birthday.split("/");
      var birthday_date = new Date(birthday_arr[2], birthday_arr[1] - 1, birthday_arr[0]);
      var ageDifMs = Date.now() - birthday_date.getTime();
      var ageDate = new Date(ageDifMs);
      return Math.abs(ageDate.getUTCFullYear() - 1970);
    }
 

    $('#fecha_nacimiento').on('change', function(){
      var fecha=$('#fecha_nacimiento').val();
      if(fecha != ""){
        
        var ed = calculateAge(fecha);
        if(ed>=14 && ed<=100){
          $(".edad").text(ed + " años");
          $("#error").text("");
          $('#error_e').removeClass('has-error').addClass('has-success');
        }else{
            $(".edad").text("");
            $("#fecha_nacimiento").val("")
            $("#error").text("Fecha Incorrecta");
            $('#error_e').removeClass('has-success').addClass('has-error');
        }  
      }  
    });

    $("#tipo_local").on("change", function(){
      if($("#tipo_local").val()==="otro_tl"){
        $("#div_tl").show();
      }else{
        $("#div_tl").hide();
        $("#otro_tipo_local").val("");
      }
    });

    $('#fi_propio').on('change', function(){
      var sum=0
      var p = parseFloat($('#fi_propio').val());
      var c = parseFloat($('#fi_credito').val());
      var s = parseFloat($('#fi_sub_vencion').val());
      var o = parseFloat($('#fi_otro').val());
      if(isNaN(p)){
        p=0;
      }
      if(isNaN(c)){
        c=0;	
      }
      if(isNaN(s)){
        s=0;	
      }
      if(isNaN(o)){
        o=0;	
      }
      sum = p + c + s + o;
      $(".total").text(sum);
  });
    $('#fi_credito').on('change', function(){
      var sum=0
        var p = parseFloat($('#fi_propio').val());
        var c = parseFloat($('#fi_credito').val());
        var s = parseFloat($('#fi_sub_vencion').val());
        var o = parseFloat($('#fi_otro').val());
        if(isNaN(p)){
          p=0;
        }
        if(isNaN(c)){
          c=0;	
        }
        if(isNaN(s)){
          s=0;	
        }
        if(isNaN(o)){
          o=0;	
        }
        sum = p + c + s + o;
        $(".total").text(sum);
    });

    $('#fi_sub_vencion').on('change', function(){
      var sum=0
        var p = parseFloat($('#fi_propio').val());
        var c = parseFloat($('#fi_credito').val());
        var s = parseFloat($('#fi_sub_vencion').val());
        var o = parseFloat($('#fi_otro').val());
        if(isNaN(p)){
          p=0;
        }
        if(isNaN(c)){
          c=0;	
        }
        if(isNaN(s)){
          s=0;	
        }
        if(isNaN(o)){
          o=0;	
        }
        sum = p + c + s + o;
        $(".total").text(sum);
    });

    $('#fi_otro').on('change', function(){
      var sum=0
        var p = parseFloat($('#fi_propio').val());
        var c = parseFloat($('#fi_credito').val());
        var s = parseFloat($('#fi_sub_vencion').val());
        var o = parseFloat($('#fi_otro').val());
        if(isNaN(p)){
          p=0;
        }
        if(isNaN(c)){
          c=0;	
        }
        if(isNaN(s)){
          s=0;	
        }
        if(isNaN(o)){
          o=0;	
        }
        sum = p + c + s + o;
        $(".total").text(sum);
    });


    /*if($('#fecha').val()!=""){
      var fecha=$('#fecha').val();
      var ed = calculateAge(fecha);
        if(ed>=14 && ed<=100){
          $(".edad").text(ed + " años");
          $("#error").text("");
          $('#error_e').removeClass('has-error').addClass('has-success');
        }else{
            $(".edad").text("");
            $("#fecha").val("")
            $("#error").text("Fecha Incorrecta");
            $('#error_e').removeClass('has-success').addClass('has-error');
        }  
    }*/

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

      if($("#cont_tel").val() > 0){
        cont2=$("#cont_tel").val()-1;
      }

      $('#a_t').on('click', function(){
        
        $("#div_tel").append("<div class='form-group' id='div_"+ cont +"' name='div_"+ cont +"'><label class='control-label col-md-3 col-sm-3 col-xs-12'>Teléfono : </label><div class='col-md-5 col-sm-5 col-xs-12'><input type='text' class='form-control has-feedback-left telefono' id='telefono_"+ cont +"' name= 'telefono[]' required='required' placeholder='Digite Número de Teléfono'><span class='fa fa-phone form-control-feedback left' aria-hidden='true'></span></div><div class='col-md-1 col-sm-1 col-xs-12'><a class='btn btn-danger' onclick=\'eliminar_tel("+ cont +")\' data-toggle='tooltip' data-placement='top' title='Eliminar Teléfono'><i class='fa fa-trash-o'></i></a></div><span class='help-block'></span></div>");
        cont++;
        cont2++;

        $('.telefono').inputmask( "9999-9999" ) ;
        if(cont2==4){
          $("#a_t").hide();
        }
      });

     

    $("input[id='inscrito_organizacion']").on("change", function() {
      if ($(this).is(':checked') && $(this).val()=="Si") {
        $("#nombre_organizacion").val("");
        $("#div_no").show();
       /* if($("#dvp").val()!="No"){
          $("#detalle_vp").val($("#dvp").val());
        }*/
      } else {
        $("#div_no").hide();
        $("#nombre_organizacion").val("");
      }
    });

    

    $('input[type=file]').on('change', function() {
          var fileSize = this.files[0].size;
        
          if(fileSize > 2000000){
            $('#cu_error').text("El archivo no debe superar 2MB");
            $('#dcu_error').removeClass('has-success').addClass('has-error');
            this.value = '';
            this.files[0].name = '';
          }else{
            $('#cu_error').text("");
            $('#dcu_error').removeClass('has-error').addClass('has-success');
          }
    });

     $("#btnguardar").click(function(){
      if($("#form_demandante").valid()){
          $("#bandera").val("add");
          var formData = new FormData($("#form_demandante")[0]);
          $.ajax({
            type: 'POST',
            url: '../build/sql/crud_emprendedores.php',
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
                        location.href='../production/ingreso_emprendedor.php';
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
                        location.href='../production/ingreso_emprendedor.php';
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

        

         $("#btneditar").click(function(){
          if($("#form_demandante").valid()){
            
          $("#bandera").val("edit");
          var formData = new FormData($("#form_demandante")[0]);
          $.ajax({
            type: 'POST',
            url: '../build/sql/crud_demandantes.php',
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
                        location.href='../production/lista_demandantes.php';
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
                      location.href='../production/lista_demandantes.php';
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

function eliminar_tel(tel){
  $("#div_"+tel).remove();
  cont2--;
  if(cont2<4){
    $("#a_t").show();
  }
 
}


