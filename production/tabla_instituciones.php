  
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
                          <th>Áreas de Trabajo</th>
                          <th>Productos y Servicios al Emprendedor</th>
                          <th>Departamento</th>
                          <th>Municipio</th>
                          <th>Estado</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        
                        include ("../build/conexion.php");
                        $contador=1;
                        if($user=="Administrador General"){
                          $stmt= $pdo->prepare("SELECT i.id_institucion, i.nombre, i.areas_trabajo, i.producto_servicio_emp ,d.nombre AS departamento, m.nombre AS municipio, i.estado FROM institucion AS i INNER JOIN departamentos AS d ON (i.id_departamento=d.id_departamento) INNER JOIN municipios AS m ON (i.id_municipio=m.id_municipio) WHERE i.estado=:estado");
                          $stmt->bindParam(":estado",$estado,PDO::PARAM_STR);
                          $stmt->execute();
                        }else if($user=="Administrador Territorio"){
                          $stmt= $pdo->prepare("SELECT i.id_institucion, i.nombre, i.areas_trabajo, i.producto_servicio_emp ,d.nombre AS departamento, m.nombre AS municipio, i.estado FROM institucion AS i INNER JOIN departamentos AS d ON (i.id_departamento=d.id_departamento) INNER JOIN municipios AS m ON (i.id_municipio=m.id_municipio) WHERE i.estado=:estado AND i.id_usuario=:id_user");
                          $stmt->bindParam(":estado",$estado,PDO::PARAM_STR);
                          $stmt->bindParam(":id_user",$id_user,PDO::PARAM_STR);
                          $stmt->execute();
                        }
                        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach($result as $lista_institucion){
                             
                              echo "<tr>";
                              echo "<td>" .$contador. "</td>";
                              echo "<td>" . $lista_institucion['nombre'] . "</td>";
                              echo "<td>" . $lista_institucion['areas_trabajo'] . "</td>";
                              echo "<td>" . $lista_institucion['producto_servicio_emp'] . "</td>";
                              echo "<td>" . $lista_institucion['departamento'] . "</td>";
                              echo "<td>" . $lista_institucion['municipio'] . "</td>";
                              echo "<td>" . $lista_institucion['estado'] . "</td>";
                              echo "<td>";
                              
                                echo "<a class='btn btn-success' onclick='mostrar_institucion(".$lista_institucion['id_institucion'].")' data-toggle='tooltip' data-placement='top' title='Mostrar Institución'><i class='fa fa-eye'></i></a>";
                                echo "<a class='btn btn-info' onclick='editar_institucion(".$lista_institucion['id_institucion'].")' data-toggle='tooltip' data-placement='top' title='Editar Institución'><i class='fa fa-edit'></i></a>";
                                if($estado=="Activo"){
                                    echo "<a class='btn btn-danger' onclick='dar_baja_institucion(".$lista_institucion['id_institucion'].")' data-toggle='tooltip' data-placement='top' title='Dar Baja Institución'><i class='fa fa-long-arrow-down'></i></a>";
                                }else if($estado=="Inactivo"){
                                    echo "<a class='btn btn-primary' onclick='dar_alta_institucion(".$lista_institucion['id_institucion'].")' data-toggle='tooltip' data-placement='top' title='Activar Institución'><i class='fa fa-long-arrow-up'></i></a>";
                                }  
                              echo "</td>";
                              echo "</tr>";
                              $contador++;
                          }
                        ?>
                      </tbody>
                    </table>