$(document).ready(function(){
    //Date picker
    $('#fecha_desde').datepicker({
        autoclose: true
    })

    $('#fecha_hasta').datepicker({
        autoclose: true
    })


});

function validate_fechaMayorQue(fechaInicial,fechaFinal)
{
    valuesStart=fechaInicial.split("/");
    valuesEnd=fechaFinal.split("/");

    // Verificamos que la fecha no sea posterior a la actual
    var dateStart=new Date(valuesStart[2],(valuesStart[1]-1),valuesStart[0]);
    var dateEnd=new Date(valuesEnd[2],(valuesEnd[1]-1),valuesEnd[0]);
    if(dateStart>=dateEnd)
    {
        return 0;
    }
    return 1;
}

$("#fecha_hasta").on("change", function(){
    
    var fechaInicial=$("#fecha_desde").val();
    var fechaFinal=$("#fecha_hasta").val();
    if(validate_fechaMayorQue(fechaInicial,fechaFinal))
    {
        $('#result_f_d_error').text("");
        $('#result_f_d').removeClass('has-error').addClass('has-success');
        $('#result_f_h').removeClass('has-error').addClass('has-success');
    }else{
        $("#fecha_desde").val("");
        $('#result_f_d_error').text("Fecha incorrecta");
        $('#result_f_d').removeClass('has-success').addClass('has-error');
        $('#result_f_h').removeClass('has-error').addClass('has-success');
    }
});


$("#fecha_desde").on("change", function(){
    var fechaInicial=$("#fecha_desde").val();
    var fechaFinal=$("#fecha_hasta").val();
    if(fechaFinal!=""){
        if(validate_fechaMayorQue(fechaInicial,fechaFinal))
        {
            $('#result_f_d_error').text("");
            $('#result_f_d').removeClass('has-error').addClass('has-success');
            $('#result_f_h').removeClass('has-error').addClass('has-success');
        }else{
            $("#fecha_desde").val("");
            $('#result_f_d_error').text("Fecha incorrecta");
            $('#result_f_d').removeClass('has-success').addClass('has-error');
        }
    }
});

$("#btnenviar").click(function(){
    if($("#fecha_desde")!=""){
        if($("#fecha_hasta")!=""){
            $("#form_reporte").submit();
        }
    }
    
});