<?php
    
    function obtenerEmprendedores(){
        require '../conexion.php';
        $stmt= $pdo->prepare("SELECT * FROM emprendedor ORDER BY actividad_eco ASC");
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);  
        $listas = "<option value=''>Seleccione Actividad Económica</option>";
        if ($result) {
            foreach($result as $lista_emprendedores){
            $listas .= "<option value='".strtoupper($lista_emprendedores['actividad_eco'])."'>".strtoupper($lista_emprendedores['actividad_eco'])."</option>";
            }//fin for
            return $listas;
        }
    }

    echo obtenerEmprendedores();
?>  