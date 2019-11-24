<?php
    
    if(isset($_POST['id'])){
        function obtenerMunicipio(){
        $id_departamento = $_POST['id'];
        require '../conexion.php';
            $stmt= $pdo->prepare("SELECT DISTINCT e.municipio AS id_municipio, m.nombre AS municipio FROM emprendedor AS e INNER JOIN municipios AS m ON (e.municipio=m.id_municipio) WHERE e.departamento=:id_departamento");
            $stmt->bindParam(":id_departamento",$id_departamento,PDO::PARAM_INT);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);  
            $listas = "<option value=''>Seleccione Municipio</option>";
            if ($result) {
                foreach($result as $lista_municipios){
                $listas .= "<option value='".$lista_municipios['id_municipio']."'>".$lista_municipios['municipio']."</option>";
                }//fin for
                return $listas;
            }
        }
    }

    echo obtenerMunicipio();
?> 