<?php
    if(isset($_POST["bandera"])){
  
    $bandera=$_POST["bandera"];

    if($bandera=="add"){
        $msj="Error";
        
        function obtenerResultado(){
           include ("../conexion.php");

           $institucion=$_POST["institucion"];
           $responsable=$_POST["responsable"];
           $fecha_ingreso=$_POST["fecha_ingreso"];
          
           $nombre=$_POST["nombre"];
           $apellido=$_POST["apellido"];
           $sexo=$_POST["sexo"];
           $dui=$_POST["dui"];
           $nit=$_POST["nit"];
           $fecha_nacimiento=$_POST["fecha_nacimiento"];
           $comunidad=$_POST["comunidad"];
           $canton=$_POST["canton"];

           $departamento=$_POST["departamento"];
           $municipio=$_POST["municipio"];
  
           $array_tel=$_POST["telefono"];
          
           for($i=0 ; $i <count($array_tel); $i++ ){
            if($array_tel[$i] !=""){
              $posicion_coincidencia = strpos($array_tel[$i], "_");
              if ($posicion_coincidencia === false) {
                $tel[]=$array_tel[$i];
              }
             
            }
          }
          $telefono=json_encode($tel);

           $correo=$_POST["correo"];
           $profesion=$_POST["profesion"];
           $nivel_escolar=$_POST["nivel_escolar"];
           
            $nombre_organizacion=$_POST["inscrito_organizacion"];
            if($_POST["nombre_organizacion"]!=""){
              $nombre_organizacion=$_POST["nombre_organizacion"];
            }
           

            $actividad_eco=$_POST["actividad_eco"];
             if($_POST["otra_actividad_eco"]!=""){
               $actividad_eco=$_POST["otra_actividad_eco"];
             }
        
            $tipo_local=$_POST["tipo_local"];
            if($_POST["otro_tipo_local"]!=""){
              $tipo_local=$_POST["otro_tipo_local"];
            }

            $fecha_inicio=$_POST["fecha_inicio"];

            $latitud=$_POST["latitud"];
            $longitud=$_POST["longitud"];
            $act_eco_prin_de=$_POST["act_eco_prin_de"];
            $infraestructura=$_POST["infraestructura"];
            $equipo=$_POST["equipo"];
            $productos=$_POST["productos"];
            $recursos_humanos=$_POST["recursos_humanos"];
            $perfil_cliente=$_POST["perfil_cliente"];
            $mercado_objetivo=$_POST["mercado_objetivo"];
            $competencia_mercado=$_POST["competencia_mercado"];

            $fi_propio=0.00;
            if($_POST["fi_propio"]!=""){
              $fi_propio=$_POST["fi_propio"];
            }
            $fi_credito=0.00;
            if($_POST["fi_credito"]!=""){
              $fi_credito=$_POST["fi_credito"];
            }
            $fi_sub_vencion=0.00;
            if($_POST["fi_sub_vencion"]!=""){
              $fi_sub_vencion=$_POST["fi_sub_vencion"];
            }
            $fi_otro=0.00;
            if($_POST["fi_otro"]!=""){
              $fi_otro=$_POST["fi_otro"];
            }
           

            $situacion_legal=$_POST["situacion_legal"];
            $nombre_comercial=$_POST["nombre_comercial"];
            $nit_negocio=$_POST["nit_negocio"];
            $cuenta_bancaria=$_POST["cuenta_bancaria"];
            $matricula_comercio=$_POST["matricula_comercio"];
            $factura=$_POST["factura"];
            $registro_iva=$_POST["registro_iva"];
            $act_eco_prin_sl=$_POST["act_eco_prin_sl"];
            $otra=$_POST["otra"];
            $limitaciones=$_POST["limitaciones"];
            $estado="Activo";
           

            $id_usuario=$_POST["id_usuario"];

          date_default_timezone_set('America/El_Salvador');
        
          $fecha_ingres=$fecha_ingreso;
          list($dia, $mes, $year)=explode("/", $fecha_ingreso);
          $fecha_ingres=$year."-".$mes."-".$dia;

          $fecha_nac=$fecha_nacimiento;
          list($dia, $mes, $year)=explode("/", $fecha_nacimiento);
          $fecha_nac=$year."-".$mes."-".$dia;

          $fecha_inici=$fecha_inicio;
          list($dia, $mes, $year)=explode("/", $fecha_inicio);
          $fecha_inici=$year."-".$mes."-".$dia;


          $stmt = $pdo->prepare("SELECT MAX(id_emprendedor)+1 AS 'id' FROM emprendedor");
          $stmt->execute();
          $result=$stmt->fetchAll(PDO::FETCH_ASSOC);  
          if ($result) {
            foreach($result as $get_id){
              $id_emprendedor=$get_id['id'];
            }
          }
          if($id_emprendedor==null){
            $id_emprendedor=$id_emprendedor+1;
          }

        
          $stmt=$pdo->prepare("INSERT INTO emprendedor (id_emprendedor, institucion, responsable, fecha_ingreso, nombre, apellido, sexo, dui, nit, fecha_nacimiento, comunidad, canton, departamento, municipio, telefono, correo, profesion, nivel_escolar, nombre_organizacion, actividad_eco, tipo_local, fecha_inicio, latitud, 
          longitud, act_eco_prin_de, infraestructura, equipo, productos, recursos_humanos, perfil_cliente, mercado_objetivo, competencia_mercado, situacion_legal, nombre_comercial, nit_negocio, cuenta_bancaria, matricula_comercio, factura, registro_iva, act_eco_prin_sl, otra, limitaciones, estado, id_usuario)
          VALUES (:id_emprendedor, :institucion, :responsable, :fecha_ingres, :nombre, :apellido, :sexo, :dui, :nit, :fecha_nac, :comunidad, :canton, :departamento, :municipio, :telefono, :correo, :profesion, :nivel_escolar, :nombre_organizacion, :actividad_eco, :tipo_local, :fecha_inici, :latitud, 
          :longitud, :act_eco_prin_de, :infraestructura, :equipo, :productos, :recursos_humanos, :perfil_cliente, :mercado_objetivo, :competencia_mercado, :situacion_legal, :nombre_comercial, :nit_negocio, :cuenta_bancaria, :matricula_comercio, :factura, :registro_iva, :act_eco_prin_sl, :otra, :limitaciones, :estado, :id_usuario)");
          $stmt->bindParam(":id_emprendedor",$id_emprendedor,PDO::PARAM_INT);
          $stmt->bindParam(":institucion",$institucion,PDO::PARAM_STR);
          $stmt->bindParam(":responsable",$responsable,PDO::PARAM_STR);
          $stmt->bindParam(":fecha_ingres",$fecha_ingres,PDO::PARAM_STR);
          $stmt->bindParam(":nombre",$nombre,PDO::PARAM_STR);
          $stmt->bindParam(":apellido",$apellido,PDO::PARAM_STR);
          $stmt->bindParam(":sexo",$sexo,PDO::PARAM_STR);
          $stmt->bindParam(":dui",$dui,PDO::PARAM_STR);
          $stmt->bindParam(":nit",$nit,PDO::PARAM_STR);
          $stmt->bindParam(":fecha_nac",$fecha_nac,PDO::PARAM_STR);
          $stmt->bindParam(":comunidad",$comunidad,PDO::PARAM_STR);
          $stmt->bindParam(":canton",$canton,PDO::PARAM_STR);
          $stmt->bindParam(":departamento",$departamento,PDO::PARAM_INT);
          $stmt->bindParam(":municipio",$municipio,PDO::PARAM_INT);
          $stmt->bindParam(":telefono",$telefono,PDO::PARAM_STR);
          $stmt->bindParam(":correo",$correo,PDO::PARAM_STR);
          $stmt->bindParam(":profesion",$profesion,PDO::PARAM_STR);
          $stmt->bindParam(":nivel_escolar",$nivel_escolar,PDO::PARAM_STR);
          $stmt->bindParam(":nombre_organizacion",$nombre_organizacion,PDO::PARAM_STR);
          $stmt->bindParam(":actividad_eco",$actividad_eco,PDO::PARAM_STR);
          $stmt->bindParam(":tipo_local",$tipo_local,PDO::PARAM_STR);
          $stmt->bindParam(":fecha_inici",$fecha_inici,PDO::PARAM_STR);
          $stmt->bindParam(":latitud",$latitud,PDO::PARAM_STR);
          $stmt->bindParam(":longitud",$longitud,PDO::PARAM_STR);
          $stmt->bindParam(":act_eco_prin_de",$act_eco_prin_de,PDO::PARAM_STR);
          $stmt->bindParam(":infraestructura",$infraestructura,PDO::PARAM_STR);
          $stmt->bindParam(":equipo",$equipo,PDO::PARAM_STR);
          $stmt->bindParam(":productos",$productos,PDO::PARAM_STR);
          $stmt->bindParam(":recursos_humanos",$recursos_humanos,PDO::PARAM_STR);
          $stmt->bindParam(":perfil_cliente",$perfil_cliente,PDO::PARAM_STR);
          $stmt->bindParam(":mercado_objetivo",$mercado_objetivo,PDO::PARAM_STR);
          $stmt->bindParam(":competencia_mercado",$competencia_mercado,PDO::PARAM_STR);
          $stmt->bindParam(":situacion_legal",$situacion_legal,PDO::PARAM_STR);
          $stmt->bindParam(":nombre_comercial",$nombre_comercial,PDO::PARAM_STR);
          $stmt->bindParam(":nit_negocio",$nit_negocio,PDO::PARAM_STR);
          $stmt->bindParam(":cuenta_bancaria",$cuenta_bancaria,PDO::PARAM_STR);
          $stmt->bindParam(":matricula_comercio",$matricula_comercio,PDO::PARAM_STR);
          $stmt->bindParam(":factura",$factura,PDO::PARAM_STR);
          $stmt->bindParam(":registro_iva",$registro_iva,PDO::PARAM_STR);
          $stmt->bindParam(":act_eco_prin_sl",$act_eco_prin_sl,PDO::PARAM_STR);
          $stmt->bindParam(":otra",$otra,PDO::PARAM_STR);
          $stmt->bindParam(":limitaciones",$limitaciones,PDO::PARAM_STR);
          $stmt->bindParam(":estado",$estado,PDO::PARAM_STR);
          $stmt->bindParam(":id_usuario",$id_usuario,PDO::PARAM_INT);



          $stmt1=$pdo->prepare("INSERT INTO financiamiento (propio, credito, sub_vencion, otro, id_emprendedor) 
          VALUES (:fi_propio, :fi_credito, :fi_sub_vencion, :fi_otro, :id_emprendedor)");
          $stmt1->bindParam(":fi_propio",$fi_propio,PDO::PARAM_STR);
          $stmt1->bindParam(":fi_credito",$fi_credito,PDO::PARAM_STR);
          $stmt1->bindParam(":fi_sub_vencion",$fi_sub_vencion,PDO::PARAM_STR);
          $stmt1->bindParam(":fi_otro",$fi_otro,PDO::PARAM_STR);
          $stmt1->bindParam(":id_emprendedor",$id_emprendedor,PDO::PARAM_INT);

          if($stmt->execute() && $stmt1->execute()){
            return "Exito";
          }else{
            return "Error";
          }
          $stmt->close();
        
          return $msj;
        }
    }else if($bandera=="edit"){
      $msj="Error";
         
          function obtenerResultado(){
            include ("../conexion.php");
            $id_emprendedor=$_POST["actualizar"];
            $institucion=$_POST["institucion"];
            $responsable=$_POST["responsable"];
            $fecha_ingreso=$_POST["fecha_ingreso"];
           
            $nombre=$_POST["nombre"];
            $apellido=$_POST["apellido"];
            $sexo=$_POST["sexo"];
            $dui=$_POST["dui"];
            $nit=$_POST["nit"];
            $fecha_nacimiento=$_POST["fecha_nacimiento"];
            $comunidad=$_POST["comunidad"];
            $canton=$_POST["canton"];
 
            if($_POST["departamento"]!=""){
              $departamento=$_POST["departamento"];
              $municipio=$_POST["municipio"];
            }else{
              $departamento=$_POST["id_departamento"];
              $municipio=$_POST["id_municipio"];
            }
   
            $array_tel=$_POST["telefono"];
           
            for($i=0 ; $i <count($array_tel); $i++ ){
             if($array_tel[$i] !=""){
               $posicion_coincidencia = strpos($array_tel[$i], "_");
               if ($posicion_coincidencia === false) {
                 $tel[]=$array_tel[$i];
               }
              
             }
           }
           $telefono=json_encode($tel);
 
            $correo=$_POST["correo"];
            $profesion=$_POST["profesion"];
            $nivel_escolar=$_POST["nivel_escolar"];
            
             $nombre_organizacion=$_POST["inscrito_organizacion"];
             if($_POST["nombre_organizacion"]!=""){
               $nombre_organizacion=$_POST["nombre_organizacion"];
             }
            
 
             $actividad_eco=$_POST["actividad_eco"];
             if($_POST["otra_actividad_eco"]!=""){
               $actividad_eco=$_POST["otra_actividad_eco"];
             }

             if($actividad_eco==""){ $actividad_eco=$_POST["act_eco"]; } 
         
             $tipo_local=$_POST["tipo_local"];
             if($_POST["otro_tipo_local"]!=""){
               $tipo_local=$_POST["otro_tipo_local"];
             }

             if($tipo_local==""){ $tipo_local=$_POST["tipo_l"]; } 
 
             $fecha_inicio=$_POST["fecha_inicio"];
 
             $latitud=$_POST["latitud"];
             $longitud=$_POST["longitud"];
             $act_eco_prin_de=$_POST["act_eco_prin_de"];
             $infraestructura=$_POST["infraestructura"];
             $equipo=$_POST["equipo"];
             $productos=$_POST["productos"];
             $recursos_humanos=$_POST["recursos_humanos"];
             $perfil_cliente=$_POST["perfil_cliente"];
             $mercado_objetivo=$_POST["mercado_objetivo"];
             $competencia_mercado=$_POST["competencia_mercado"];
 
             $fi_propio=0.00;
             if($_POST["fi_propio"]!=""){
               $fi_propio=$_POST["fi_propio"];
             }
             $fi_credito=0.00;
             if($_POST["fi_credito"]!=""){
               $fi_credito=$_POST["fi_credito"];
             }
             $fi_sub_vencion=0.00;
             if($_POST["fi_sub_vencion"]!=""){
               $fi_sub_vencion=$_POST["fi_sub_vencion"];
             }
             $fi_otro=0.00;
             if($_POST["fi_otro"]!=""){
               $fi_otro=$_POST["fi_otro"];
             }
            
 
             $situacion_legal=$_POST["situacion_legal"];
             $nombre_comercial=$_POST["nombre_comercial"];
             $nit_negocio=$_POST["nit_negocio"];
             $cuenta_bancaria=$_POST["cuenta_bancaria"];
             $matricula_comercio=$_POST["matricula_comercio"];
             $factura=$_POST["factura"];
             $registro_iva=$_POST["registro_iva"];
             $act_eco_prin_sl=$_POST["act_eco_prin_sl"];
             $otra=$_POST["otra"];
             $limitaciones=$_POST["limitaciones"];
 
           date_default_timezone_set('America/El_Salvador');
         
           $fecha_ingres=$fecha_ingreso;
           list($dia, $mes, $year)=explode("/", $fecha_ingreso);
           $fecha_ingres=$year."-".$mes."-".$dia;
 
           $fecha_nac=$fecha_nacimiento;
           list($dia, $mes, $year)=explode("/", $fecha_nacimiento);
           $fecha_nac=$year."-".$mes."-".$dia;
 
           $fecha_inici=$fecha_inicio;
           list($dia, $mes, $year)=explode("/", $fecha_inicio);
           $fecha_inici=$year."-".$mes."-".$dia;

          $stmt=$pdo->prepare("UPDATE emprendedor SET institucion=:institucion, responsable=:responsable, fecha_ingreso=:fecha_ingres, nombre=:nombre, apellido=:apellido, sexo=:sexo, dui=:dui, nit=:nit, fecha_nacimiento=:fecha_nac, comunidad=:comunidad, canton=:canton, departamento=:departamento, municipio=:municipio, telefono=:telefono, correo=:correo, profesion=:profesion, nivel_escolar=:nivel_escolar, nombre_organizacion=:nombre_organizacion, actividad_eco=:actividad_eco, tipo_local=:tipo_local, fecha_inicio=:fecha_inici, latitud=:latitud, longitud=:longitud, act_eco_prin_de=:act_eco_prin_de, infraestructura=:infraestructura, equipo=:equipo, productos=:productos, recursos_humanos=:recursos_humanos, perfil_cliente=:perfil_cliente, mercado_objetivo=:mercado_objetivo, competencia_mercado=:competencia_mercado, situacion_legal=:situacion_legal, nombre_comercial=:nombre_comercial, nit_negocio=:nit_negocio, cuenta_bancaria=:cuenta_bancaria, matricula_comercio=:matricula_comercio, factura=:factura, registro_iva=:registro_iva, act_eco_prin_sl=:act_eco_prin_sl, otra=:otra, limitaciones=:limitaciones WHERE id_emprendedor=:id_emprendedor");
           $stmt->bindParam(":institucion",$institucion,PDO::PARAM_STR);
           $stmt->bindParam(":responsable",$responsable,PDO::PARAM_STR);
           $stmt->bindParam(":fecha_ingres",$fecha_ingres,PDO::PARAM_STR);
           $stmt->bindParam(":nombre",$nombre,PDO::PARAM_STR);
           $stmt->bindParam(":apellido",$apellido,PDO::PARAM_STR);
           $stmt->bindParam(":sexo",$sexo,PDO::PARAM_STR);
           $stmt->bindParam(":dui",$dui,PDO::PARAM_STR);
           $stmt->bindParam(":nit",$nit,PDO::PARAM_STR);
           $stmt->bindParam(":fecha_nac",$fecha_nac,PDO::PARAM_STR);
           $stmt->bindParam(":comunidad",$comunidad,PDO::PARAM_STR);
           $stmt->bindParam(":canton",$canton,PDO::PARAM_STR);
           $stmt->bindParam(":departamento",$departamento,PDO::PARAM_INT);
           $stmt->bindParam(":municipio",$municipio,PDO::PARAM_INT);
           $stmt->bindParam(":telefono",$telefono,PDO::PARAM_STR);
           $stmt->bindParam(":correo",$correo,PDO::PARAM_STR);
           $stmt->bindParam(":profesion",$profesion,PDO::PARAM_STR);
           $stmt->bindParam(":nivel_escolar",$nivel_escolar,PDO::PARAM_STR);
           $stmt->bindParam(":nombre_organizacion",$nombre_organizacion,PDO::PARAM_STR);
           $stmt->bindParam(":actividad_eco",$actividad_eco,PDO::PARAM_STR);
           $stmt->bindParam(":tipo_local",$tipo_local,PDO::PARAM_STR);
           $stmt->bindParam(":fecha_inici",$fecha_inici,PDO::PARAM_STR);
           $stmt->bindParam(":latitud",$latitud,PDO::PARAM_STR);
           $stmt->bindParam(":longitud",$longitud,PDO::PARAM_STR);
           $stmt->bindParam(":act_eco_prin_de",$act_eco_prin_de,PDO::PARAM_STR);
           $stmt->bindParam(":infraestructura",$infraestructura,PDO::PARAM_STR);
           $stmt->bindParam(":equipo",$equipo,PDO::PARAM_STR);
           $stmt->bindParam(":productos",$productos,PDO::PARAM_STR);
           $stmt->bindParam(":recursos_humanos",$recursos_humanos,PDO::PARAM_STR);
           $stmt->bindParam(":perfil_cliente",$perfil_cliente,PDO::PARAM_STR);
           $stmt->bindParam(":mercado_objetivo",$mercado_objetivo,PDO::PARAM_STR);
           $stmt->bindParam(":competencia_mercado",$competencia_mercado,PDO::PARAM_STR);
           $stmt->bindParam(":situacion_legal",$situacion_legal,PDO::PARAM_STR);
           $stmt->bindParam(":nombre_comercial",$nombre_comercial,PDO::PARAM_STR);
           $stmt->bindParam(":nit_negocio",$nit_negocio,PDO::PARAM_STR);
           $stmt->bindParam(":cuenta_bancaria",$cuenta_bancaria,PDO::PARAM_STR);
           $stmt->bindParam(":matricula_comercio",$matricula_comercio,PDO::PARAM_STR);
           $stmt->bindParam(":factura",$factura,PDO::PARAM_STR);
           $stmt->bindParam(":registro_iva",$registro_iva,PDO::PARAM_STR);
           $stmt->bindParam(":act_eco_prin_sl",$act_eco_prin_sl,PDO::PARAM_STR);
           $stmt->bindParam(":otra",$otra,PDO::PARAM_STR);
           $stmt->bindParam(":limitaciones",$limitaciones,PDO::PARAM_STR);
           $stmt->bindParam(":id_emprendedor",$id_emprendedor,PDO::PARAM_INT);
 
 
 
           $stmt1=$pdo->prepare("UPDATE financiamiento SET propio=:fi_propio, credito=:fi_credito, sub_vencion=:fi_sub_vencion, otro=:fi_otro WHERE id_emprendedor=:id_emprendedor");
           $stmt1->bindParam(":fi_propio",$fi_propio,PDO::PARAM_STR);
           $stmt1->bindParam(":fi_credito",$fi_credito,PDO::PARAM_STR);
           $stmt1->bindParam(":fi_sub_vencion",$fi_sub_vencion,PDO::PARAM_STR);
           $stmt1->bindParam(":fi_otro",$fi_otro,PDO::PARAM_STR);
           $stmt1->bindParam(":id_emprendedor",$id_emprendedor,PDO::PARAM_INT);
 
           if($stmt->execute() && $stmt1->execute()){
             return "Exito";
           }else{
             return "Error";
           }
           $stmt->close();
         
           return $msj;
         }
  }else if($bandera=="dar_baja"){
    $msj="Error";
  
    function obtenerResultado(){
        include ("../conexion.php");
        $id_emprendedor=$_POST["id"];
        $estado="Inactivo";
    
        $stmt=$pdo->prepare("UPDATE emprendedor SET estado=:estado WHERE id_emprendedor=:id_emprendedor");
        $stmt->bindParam(":estado",$estado,PDO::PARAM_STR);
        $stmt->bindParam(":id_emprendedor",$id_emprendedor,PDO::PARAM_INT);

        if($stmt->execute()){
          return "Exito";
        }else{
          return "Error";
        }
        $stmt->close();
    
      return $msj;
    }
  }else if($bandera=="dar_alta"){
    $msj="Error";
  
    function obtenerResultado(){
        include ("../conexion.php");
        $id_emprendedor=$_POST["id"];
        $estado="Activo";
    
        $stmt=$pdo->prepare("UPDATE emprendedor SET estado=:estado WHERE id_emprendedor=:id_emprendedor");
        $stmt->bindParam(":estado",$estado,PDO::PARAM_STR);
        $stmt->bindParam(":id_emprendedor",$id_emprendedor,PDO::PARAM_INT);

        if($stmt->execute()){
          return "Exito";
        }else{
          return "Error";
        }
        $stmt->close();
    
      return $msj;
    }
  }

  }

 
    echo obtenerResultado();
?>