<?php
    
    function obtenerAdministrador(){
        require '../conexion.php';
        $stmt= $pdo->prepare("SELECT * FROM usuarios WHERE nivel='Administrador' ORDER BY nombre");
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);  
        $listas = "<option value=''>Seleccione Administrador</option>";
        if ($result) {
            foreach($result as $lista_admin){
            $listas .= "<option value='".$lista_admin['id_usuario']."'>".$lista_admin['nombre']." ".$lista_admin['apellido']."</option>";
            }//fin for
            return $listas;
        }
    }

    echo obtenerAdministrador();
?>  