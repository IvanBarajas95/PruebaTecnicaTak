<?php 
include ('conexionalumno.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- MDBootstrap Datatables  -->
    <link href="css/addons/datatables.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    
    <!-- MDBootstrap Datatables  -->
    <script type="text/javascript" src="js/addons/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js" ></script>
    <link rel="stylesheet" type="text/css" href="css/custom.css">
    <title>Alumnos</title>
</head>
<body>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row py-5">
                    <div class="col-sm-8"><h2>Registro de Alumnos <b>Colegio San Luis</b></h2></div>
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">
                            <i class="material-icons pull-left">add_circle</i>Crear Estudiante
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php
            $estudiantes= new Database();
            if(isset($_POST) && !empty($_POST)){
                $nombres = $estudiantes->sanitize($_POST['nombres']);
                $apellidos = $estudiantes->sanitize($_POST['apellidos']);
                $tipodoc = $estudiantes->sanitize($_POST['documentoSelect']);
                $numdoc = $estudiantes->sanitize($_POST['documento']);
                $departamento = $estudiantes->sanitize($_POST['departamentoSelect']);
                $ciudad = $estudiantes->sanitize($_POST['ciudad']);
                
                $res = $estudiantes->create($nombres, $apellidos, $tipodoc, $numdoc, $departamento, $ciudad);
                if($res){
                    $message= "Datos insertados con ??xito";
                    $class="alert alert-success alert-dismissible fade show";
                }else{
                    $message="No se pudieron insertar los datos";
                    $class="alert alert-danger alert-dismissible fade show";
                }
            
        ?>
        <div class="<?php echo $class?>">
            <?php echo $message;?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>	
            <?php
        }
        ?>
        <!-- modal registro-->
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog " role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Crear <b>Alumno</b></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 mx-auto">
                        <form method="post">
                            <div class="form-group">
                                
                                    <label>Nombres:</label>
                                    <input type="text" name="nombres" id="nombres" class='form-control' maxlength="100" required placeholder="Nombres..." >
                            </div>
                            <div class="form-group">
                                    <label>Apellidos:</label>
                                    <input type="text" name="apellidos" id="apellidos" class='form-control' maxlength="100" required placeholder="Apellidos...">
                                
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="documentoSelect">Tipo Documento</label>
                                    <select required class="form-control" name="documentoSelect">
                                        <option value="">Seleccione .:.</option>
                                        <option value="CC">C??dula de ciudadan??a</option>
                                        <option value="TI">Tarjeta de Identidad</option>
                                        <option value="CE">C??dula de extranjer??a</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label for="documento">N??mero de documento</label>
                                    <input required name="documento" type="text" class="form-control"  placeholder="# de documento..." >
                                </div>
                            </div>
                            <div class="form-group">
                                
                                    <label for="departamentoSelect">Departamento de Residencia</label>
                                    <select id="depto" required class="form-control" name="departamentoSelect">
                                    <option value="">Seleccione .:.</option>
                                    <?php
                                        $deptos=$estudiantes->readDepto();
                                        while ($row=mysqli_fetch_object($deptos)){
                                            $id=$row->id_departamento;
                                            $departamento=$row->departamento;
                                                echo '<option value="'.$id.'">'.$departamento.'</option>';
                                        }
                                    ?>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label for="ciudad">Ciudad de Residencia</label>
                                <select id="municipio" required class="form-control" name="ciudad">
                                    <option value="">Seleccione .:.</option>
                                </select>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <div class="">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                </div>
                                <div class="">
                                    <button type="submit" class="btn btn-success"><i class="material-icons pull-left">save</i>Crear</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    
                </div>
                </div>
            </div>
        </div>
        <!-- end modal-->
        <hr>
        <!--tabla de datos-->
        <div class="container my-3">
            <table id="dtBasicExample" class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nombres y Apellidos</th>
                        <th scope="col">Documento</th>
                        <th scope="col">Departamento</th>
                        <th scope="col">Ciudad</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $listado=$estudiantes->read();
                    while ($row=mysqli_fetch_object($listado)){
                        $id=$row->id;
                        $nombres=$row->nombres." ".$row->apellidos;
                        $documento=$row->tipodoc." # ".$row->numdoc;
                        $departamento=$row->departamento; 
                        $ciudad=$row->ciudad;
                            echo "<tr>";
                            echo "<td>" .$nombres."</td>";
                            echo "<td>" .$documento."</td>";
                            echo "<td>" .$departamento."</td>";
                            echo "<td>" .$ciudad."</td>";
                            echo "<td>"?>
                            <a href="actualizaralumno.php?id=<?php echo $id;?>" class="edit" title="Editar" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            <!--<a href="delete.php?id=<?php echo $id;?>" class="delete" title="Eliminar" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>-->
                            <a href="#" class="delete" id='del_<?= $id ?>' data-id='<?= $id ?>' ><i class="material-icons">&#xE872;</i></a>
                            <?php
                            echo "</td>";
                            echo "</tr>";
                        }?>
                </tbody>
            </table>
        </div>
        <!--end tabla de datos-->
    </div>
    <script>
    $(document).ready(function () {
        $('#dtBasicExample').DataTable({
            "pagingType": "simple_numbers" 
        });
        $('.dataTables_length').addClass('bs-select');

        $("#depto").change(function(){
            $.get("municipios.php","depto_id="+$("#depto").val(), function(data){
                $("#municipio").html(data);
            });
        });
    }); 

    // Delete 
    $('.delete').click(function(){
        var el = this;
    
        // Delete id
        var deleteid = $(this).data('id');
    
        // Confirm box
        bootbox.confirm("Esta seguro que desea eliminar el estudiante?", function(result) {
    
            if(result){
                // AJAX Request
                $.ajax({
                url: 'eliminaralumno.php',
                type: 'POST',
                data: { id:deleteid },
                success: function(response){

                    // Removing row from HTML Table
                if(response == 1){
                $(el).closest('tr').css('background','tomato');
                        $(el).closest('tr').fadeOut(800,function(){
                $(this).remove();
                });
                }else{
                bootbox.alert('Eliminiaci??n cancelada.');
                }

                }
                });
            }
        });
    });
    //End delete
    </script>
</body>
</html>