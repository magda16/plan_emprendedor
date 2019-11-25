<?php
    
    function obtenerEmprendedores(){
        require '../conexion.php';
        $stmt= $pdo->prepare("SELECT DISTINCT c.id_emprendedor, e.id_emprendedor, e.nombre, e.apellido FROM cooperante AS c INNER JOIN emprendedor AS e ON (c.id_emprendedor=e.id_emprendedor) ORDER BY e.nombre");
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