  
  <?php
    if(isset($_REQUEST['id_usuario'])){
        $id_usuario = $_REQUEST['id_usuario'];
        include ("../build/conexion.php");

        $stmt= $pdo->prepare("SELECT * FROM usuarios WHERE id_usuario=:id_usuario");
        $stmt->bindParam(":id_usuario",$id_usuario,PDO::PARAM_STR);
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $lista_bitacora){
          $nombre= $lista_bitacora['nombre']." ".$lista_bitacora['apellido'];
          $cargo= $lista_bitacora['nivel'];
        }

        echo "<br /><label class='control-label col-md-3 col-sm-3 col-xs-12'>Nombre: ".$nombre."</label>";
        echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>Cargo: ".$cargo."</label><br />";
    }
    ?>
                    <br /><br />
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Transacción</th>
                          <th>Descripción</th>
                          <th>Fecha</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        
                        
                        $contador=1;
                        $stmt1= $pdo->prepare("SELECT transaccion, descripcion, DATE_FORMAT(fecha, '%d/%m/%Y') AS fecha FROM bitacora WHERE id_usuario=:id_usuario");
                        $stmt1->bindParam(":id_usuario",$id_usuario,PDO::PARAM_STR);
                        $stmt1->execute();
                        $result1=$stmt1->fetchAll(PDO::FETCH_ASSOC);
                        foreach($result1 as $lista_bitacora){
                             
                              echo "<tr>";
                              echo "<td>" .$contador. "</td>";
                              echo "<td>" . $lista_bitacora['transaccion'] . "</td>";
                              echo "<td>" . $lista_bitacora['descripcion'] . "</td>";
                              echo "<td>" . $lista_bitacora['fecha'] . "</td>";
                              echo "</tr>";
                              $contador++;
                          }
                        ?>
                      </tbody>
                    </table>