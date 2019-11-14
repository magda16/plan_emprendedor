<?php
    require "../conexion.php"; 
    if(isset($_POST['nombre'])){

        $tabla = $_POST['tabla'];
        $nombre = $_POST['nombre'];
        $nombre_campo = $_POST['nombre_campo'];

        $stmt = $pdo->prepare("SELECT * FROM $tabla WHERE $nombre_campo=:nombre");
        $stmt->bindParam(":nombre",$nombre,PDO::PARAM_STR);
		$stmt->execute();
        
        if ($stmt) {
            while ($fila = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
                echo "exito";
            }//fin while
        }
    }
   
?>