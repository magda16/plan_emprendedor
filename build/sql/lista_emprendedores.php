<?php
    
    function obtenerEmprendedores(){
        require '../conexion.php';
        $stmt= $pdo->prepare("SELECT * FROM emprendedor ORDER BY nombre");
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);  
        $listas = "<option value=''>Seleccione Emprendedor</option>";
        if ($result) {
            foreach($result as $lista_emprendedores){
            $listas .= "<option value='".$lista_emprendedores['id_emprendedor']."'>".$lista_emprendedores['nombre']." ".$lista_emprendedores['apellido']."</option>";
            }//fin for
            return $listas;
        }
    }

    echo obtenerEmprendedores();
?>  