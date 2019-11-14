<?php
    
    if(isset($_POST['id'])){
        function obtenerMunicipio(){
        $id_departamento = $_POST['id'];
        require '../conexion.php';
            $stmt= $pdo->prepare("SELECT m.id_municipio, m.nombre  FROM municipios as m INNER JOIN departamentos as p ON (m.id_departamento=p.id_departamento) WHERE p.id_departamento=:id_departamento ORDER BY m.nombre");
            $stmt->bindParam(":id_departamento",$id_departamento,PDO::PARAM_INT);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);  
            $listas = "<option value=''>Seleccione Municipio</option>";
            if ($result) {
                foreach($result as $lista_municipios){
                $listas .= "<option value='".$lista_municipios['id_municipio']."'>".$lista_municipios['nombre']."</option>";
                }//fin for
                return $listas;
            }
        }
    }

    echo obtenerMunicipio();
?> 