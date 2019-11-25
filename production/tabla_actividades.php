  
  <?php
    $estado="Activo";
    if(isset($_REQUEST['estado'])){
        $estado = $_REQUEST['estado'];
        $user = $_REQUEST['user'];
        $id_user = $_REQUEST['id_user'];
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
                          <th>Nombre</th>
                          <th>Fecha Inicio</th>
                          <th>Fecha Fin</th>
                          <th>Hora Inicio</th>
                          <th>Hora Fin</th>
                          <th>Descripción</th>
                          <th>Estado</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        
                        include ("../build/conexion.php");
                        $contador=1;
                        if($user=="Administrador General"){
                          $stmt= $pdo->prepare("SELECT id_actividad, nombre, DATE_FORMAT(fecha_inicio, '%d/%m/%Y') AS fecha_inicio, DATE_FORMAT(fecha_fin, '%d/%m/%Y') AS fecha_fin, hora_inicio, hora_fin, descripcion, estado FROM actividad WHERE estado=:estado");
                          $stmt->bindParam(":estado",$estado,PDO::PARAM_STR);
                          $stmt->execute();
                        }else if($user=="Administrador Territorio"){
                          $stmt= $pdo->prepare("SELECT id_actividad, nombre, DATE_FORMAT(fecha_inicio, '%d/%m/%Y') AS fecha_inicio, DATE_FORMAT(fecha_fin, '%d/%m/%Y') AS fecha_fin, hora_inicio, hora_fin, descripcion, estado FROM actividad WHERE estado=:estado AND id_usuario=:id_user");
                          $stmt->bindParam(":estado",$estado,PDO::PARAM_STR);
                          $stmt->bindParam(":id_user",$id_user,PDO::PARAM_STR);
                          $stmt->execute();
                        }
                        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach($result as $lista_actividad){
                             
                              echo "<tr>";
                              echo "<td>" .$contador. "</td>";
                              echo "<td>" . $lista_actividad['nombre'] . "</td>";
                              echo "<td>" . $lista_actividad['fecha_inicio'] . "</td>";
                              echo "<td>" . $lista_actividad['fecha_fin'] . "</td>";
                              echo "<td>" . $lista_actividad['hora_inicio'] . "</td>";
                              echo "<td>" . $lista_actividad['hora_fin'] . "</td>";
                              echo "<td>" . $lista_actividad['descripcion'] . "</td>";
                              echo "<td>" . $lista_actividad['estado'] . "</td>";
                              echo "<td>";
                              
                                echo "<a class='btn btn-success' onclick='mostrar_actividad(".$lista_actividad['id_actividad'].")' data-toggle='tooltip' data-placement='top' title='Mostrar Actividad'><i class='fa fa-eye'></i></a>";
                                echo "<a class='btn btn-info' onclick='editar_actividad(".$lista_actividad['id_actividad'].")' data-toggle='tooltip' data-placement='top' title='Editar Actividad'><i class='fa fa-edit'></i></a>";
                                if($estado=="Activo"){
                                    echo "<a class='btn btn-danger' onclick='dar_baja_actividad(".$lista_actividad['id_actividad'].")' data-toggle='tooltip' data-placement='top' title='Dar Baja Actividad'><i class='fa fa-long-arrow-down'></i></a>";
                                }else if($estado=="Inactivo"){
                                    echo "<a class='btn btn-primary' onclick='dar_alta_actividad(".$lista_actividad['id_actividad'].")' data-toggle='tooltip' data-placement='top' title='Activar Actividad'><i class='fa fa-long-arrow-up'></i></a>";
                                }  
                              echo "</td>";
                              echo "</tr>";
                              $contador++;
                          }
                        ?>
                      </tbody>
                    </table>