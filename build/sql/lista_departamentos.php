<?php
    
    function obtenerDepartamentos(){
        require '../conexion.php';
        $stmt= $pdo->prepare("SELECT * FROM departamentos ORDER BY nombre");
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);  
        $listas = "<option value=''>Seleccione Departamento</option>";
        if ($result) {
            foreach($result as $lista_departamentos){
            $listas .= "<option value='".$lista_departamentos['id_departamento']."'>".$lista_departamentos['nombre']."</option>";
            }//fin for
            return $listas;
        }
    }

    echo obtenerDepartamentos();
?>  