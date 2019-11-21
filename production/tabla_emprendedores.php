  
  <?php
    $estado="Activo";
    if(isset($_REQUEST['estado'])){
        $estado = $_REQUEST['estado'];
    }

    if($estado=="Activo"){
        echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'> Activos </label>";
    }else if($estado=="Inactivo"){
        echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'> Inactivos </label>";
    }
    ?>
                    <br /><br />
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Empresario</th>
                          <th>Recursos Humanos</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        
                        include ("../build/conexion.php");
                        $contador=1;
                        $stmt= $pdo->prepare("SELECT * FROM emprendedor WHERE estado=:estado");
                        $stmt->bindParam(":estado",$estado,PDO::PARAM_STR);
                        $stmt->execute();
                        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach($result as $lista_emprendedor){
                             
                              echo "<tr>";
                              echo "<td>" .$contador. "</td>";
                              echo "<td>" . $lista_emprendedor['nombre'] . " " . $lista_emprendedor['apellido'] . "</td>";
                              echo "<td>" . $lista_emprendedor['recursos_humanos'] . "</td>";
                      
                              echo "<td>";
                              
                                echo "<a class='btn btn-success' onclick='mostrar_emprendedor(".$lista_emprendedor['id_emprendedor'].")' data-toggle='tooltip' data-placement='top' title='Mostrar Emprendedor'><i class='fa fa-eye'></i></a>";
                                
                                if($estado=="Activo"){
                                  echo "<a class='btn btn-info' onclick='editar_emprendedor(".$lista_emprendedor['id_emprendedor'].")' data-toggle='tooltip' data-placement='top' title='Editar Emprendedor'><i class='fa fa-edit'></i></a>";
                                  echo "<a class='btn btn-cafe' onclick='agregar_foto(".$lista_emprendedor['id_emprendedor'].")' data-toggle='tooltip' data-placement='top' title='Agregar Foto'><i class='fa fa-file-image-o'></i></a>";
                                  echo "<a class='btn btn-danger' onclick='dar_baja_emprendedor(".$lista_emprendedor['id_emprendedor'].")' data-toggle='tooltip' data-placement='top' title='Dar Baja Emprendedor'><i class='fa fa-long-arrow-down'></i></a>";
                                }else if($estado=="Inactivo"){
                                    echo "<a class='btn btn-primary' onclick='dar_alta_emprendedor(".$lista_emprendedor['id_emprendedor'].")' data-toggle='tooltip' data-placement='top' title='Activar Emprendedor'><i class='fa fa-long-arrow-up'></i></a>";
                                }  
                              echo "</td>";
                              echo "</tr>";
                              $contador++;
                          }
                        ?>
                      </tbody>
                    </table>