  
  <?php
    $estado="Activo";
    if(isset($_REQUEST['user'])){
        $user = $_REQUEST['user'];
        $id_user = $_REQUEST['id_user'];
        $id_emprendedor = $_REQUEST['id_emprendedor'];
    }

    if($estado=="Activo"){
        echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'> Activas </label>";
    }else if($estado=="Inactivo"){
        echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'> Inactivas </label>";
    }
    ?>
                    <br /><br />
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Nombre Cooperante</th>
                          <th>Monto ($)</th>
                          <th>Tipo Ayuda</th>
                          <th>Fecha Ingreso</th>
                          <th>Empresario</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        
                        include ("../build/conexion.php");
                        $contador=1;
                        if($user=="Administrador General"){
                          $stmt= $pdo->prepare("SELECT c.id_cooperante, c.nombre_cooperante, c.monto, c.tipo_ayuda, DATE_FORMAT(c.fecha_ingreso, '%d/%m/%Y') AS fecha_ingreso, e.nombre, e.apellido FROM cooperante AS c INNER JOIN emprendedor AS e ON (c.id_emprendedor=e.id_emprendedor) WHERE e.id_emprendedor=:id_emprendedor");
                          $stmt->bindParam(":id_emprendedor",$id_emprendedor,PDO::PARAM_STR);
                          $stmt->execute();
                        }else if($user=="Administrador Territorio"){
                          $stmt= $pdo->prepare("SELECT c.id_cooperante, c.nombre_cooperante, c.monto, c.tipo_ayuda, DATE_FORMAT(c.fecha_ingreso, '%d/%m/%Y') AS fecha_ingreso, e.nombre, e.apellido FROM cooperante AS c INNER JOIN emprendedor AS e ON (c.id_emprendedor=e.id_emprendedor) WHERE c.id_usuario=:id_user AND e.id_emprendedor=:id_emprendedor");
                          $stmt->bindParam(":id_user",$id_user,PDO::PARAM_STR);
                          $stmt->bindParam(":id_emprendedor",$id_emprendedor,PDO::PARAM_STR);
                          $stmt->execute();
                        }
                        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach($result as $lista_cooperante){
                             
                              echo "<tr>";
                              echo "<td>" .$contador. "</td>";
                              echo "<td>" . $lista_cooperante['nombre_cooperante'] . "</td>";
                              echo "<td>" . $lista_cooperante['monto'] . "</td>";
                              echo "<td>" . $lista_cooperante['tipo_ayuda'] . "</td>";
                              echo "<td>" . $lista_cooperante['fecha_ingreso'] . "</td>";
                              echo "<td>" . $lista_cooperante['nombre'] . " " . $lista_cooperante['apellido'] . "</td>";
                              echo "<td>";
                              
                                echo "<a class='btn btn-success' onclick='mostrar_apoyo_socio(".$lista_cooperante['id_cooperante'].")' data-toggle='tooltip' data-placement='top' title='Mostrar Apoyo a Socio'><i class='fa fa-eye'></i></a>";
                                echo "<a class='btn btn-info' onclick='editar_apoyo_socio(".$lista_cooperante['id_cooperante'].")' data-toggle='tooltip' data-placement='top' title='Editar Apoyo a Socio'><i class='fa fa-edit'></i></a>";
                                echo "<a class='btn btn-danger' onclick='eliminar_apoyo_socio(".$lista_cooperante['id_cooperante'].")' data-toggle='tooltip' data-placement='top' title='Eliminar Apoyo a Socio'><i class='fa fa-trash-o'></i></a>";
                             
                              echo "</td>";
                              echo "</tr>";
                              $contador++;
                          }
                        ?>
                      </tbody>
                    </table>