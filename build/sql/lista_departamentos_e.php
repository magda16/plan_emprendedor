<?php
    
    function obtenerDepartamentos(){
        require '../conexion.php';
        $stmt= $pdo->prepare("SELECT DISTINCT e.departamento AS id_departamento, d.nombre AS departamento FROM emprendedor AS e INNER JOIN departamentos AS d ON (e.departamento=d.id_departamento) ORDER BY d.nombre");
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);  
        $listas = "<option value=''>Seleccione Departamento</option>";
        if ($result) {
            foreach($result as $lista_departamentos){
            $listas .= "<option value='".$lista_departamentos['id_departamento']."'>".$lista_departamentos['departamento']."</option>";
            }//fin for
            return $listas;
        }
    }

    echo obtenerDepartamentos();
?>  