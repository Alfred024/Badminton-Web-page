<?php 
    include '../classes/database.php';
    // session_start();
    
    class Renta extends Database{

        var $message = '<p style="color: darkred; font-weight: 700;">';

        function action($action_case){
            switch ($action_case) {
                case 'formEdit':
                case 'formNew':

                    if ( $action_case == 'formNew' ){
                        $button_label = 'Crear';
                        $method_name = 'create';
                        $id_renta = '';
                        $id_usuario_empleado = '';
                        $id_usuario_cliente = '';
                        $id_equipo = '';
                        $fecha = '';
                        $hora = '';
                        $duracion = '';
                        $costo = '';
                    }else{
                        $button_label = 'Actualizar';
                        $method_name = 'update';
                        $id_renta = $_REQUEST['id_renta'];
                        $id_usuario_empleado = $_REQUEST['id_usuario_empleado'];
                        $id_usuario_cliente = $_REQUEST['id_usuario_cliente'];
                        $id_equipo = $_REQUEST['id_equipo'];
                        $fecha = $_REQUEST['fecha'];
                        $hora = $_REQUEST['hora'];
                        $duracion = $_REQUEST['duracion'];
                        $costo = $_REQUEST['costo'];
                    }

                    $form = '
                    <div class="container mb-5">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="POST" >
                                '. (isset($id) ? "<input type='hidden' name='id_renta' value=".$id.">" : "") .'
                        
                                    <div class="form-group">
                                        <label for="role_name">
                                            Empleado: 
                                        </label>
                                        '. $this->select_field('id_usuario', 'usuario', 'id_usuario', 'nombres') .'
                                    </div>

                                    <div class="form-group">
                                        <label for="role_name">
                                            Cliente: 
                                        </label>
                                       '. $this->select_field('id_usuario', 'usuario', 'id_usuario', 'nombres') .'
                                    </div>

                                    <div class="form-group">
                                        <label for="role_name">
                                            No. de serie: 
                                        </label>
                                    '. $this->select_field('id_equipo', 'equipo', 'id_equipo', 'no_serie') .'
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="role_name">
                                            Forma de pago: 
                                        </label>
                                        '. $this->select_field('id_forma_pago', 'forma_pago', 'id_forma_pago', 'forma_pago') .'
                                    </div>

                                    <div class="form-group">
                                        <label for="role_name">
                                            Estado de la renta: 
                                        </label>
                                        '. $this->select_field('id_estado_renta', 'estado_renta', 'id_estado_renta', 'estado_renta') .'
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="role_name">
                                            Fecha: 
                                        </label>
                                        <input id="role_name" name="no_serie" type="time" class="form-control" value="'.$fecha.'"/>
                                    </div>

                                    <div class="form-group">
                                        <label for="role_name">
                                            Hora: 
                                        </label>
                                        <input id="role_name" name="no_serie" type="hour" class="form-control" value="'.$hora.'"/>
                                    </div>

                                    <div class="form-group">
                                        <label for="role_name">
                                            Duración: 
                                        </label>
                                        <input id="role_name" name="no_serie" type="number" class="form-control" value="'.$duracion.'"/>
                                    </div>

                                    <div class="form-group">
                                        <label for="role_name">
                                            Costo: 
                                        </label>
                                        <input id="role_name" name="no_serie" type="number" class="form-control" value="'.$costo.'"/>
                                    </div>

                                    <div class="d-flex justify-content-end mt-3">
                                        <button type="submit" class="btn bg-blue text-white">
                                            '.$button_label.'
                                        </button>
                                    </div>
                                    <input type="hidden" value="'.$method_name.'" name="action">
                                </form>
                            </div>
                        </div>
                    </div>
                    ';
                    echo $form;
                break;
                case 'create':
                    $this->create();
                    break;
                case 'update':
                    $this->update();
                    break;
                case 'read':
                    $this->read();
                break;
                case 'delete':
                    $this->delete();
                    break;
                default:
                    # code...
                    break;
            }
        }

        function create(){
            $id_marca = $_POST['id_marca'];
            $no_serie = $_POST['no_serie'];
            $descripcion = $_POST['descripcion'];

            $insert_equipo_query = '
                INSERT INTO equipo (  id_marca, no_serie, descripcion ) 
                VALUES ( :id_marca, :no_serie, :descripcion );';
            
            $params = [ ':id_marca' => $id_marca, ':no_serie' => $no_serie, ':descripcion' => $descripcion ];
            
            $this->do_query($insert_equipo_query, $params);
            $this->read();
            echo $insert_equipo_query;
        }

        function update(){
            $id_marca = $_POST['id_marca'];
            $no_serie = $_POST['no_serie'];
            $descripcion = $_POST['descripcion'];
            
            $update_equipo_query = '
                UPDATE equipo SET id_marca = :id_marca, no_serie = :no_serie, descripcion = :descripcion;';
            $params = [ ':id_marca' => $id_marca, ':no_serie' => $no_serie, ':descripcion' => $descripcion ];

            $this->do_query($update_equipo_query, $params);
            $this->read();
        }


        function read(){
            $get_user_query = 'SELECT * FROM renta';
            $this->get_query($get_user_query);

            $result = '
            <div class="d-flex justify-content-end mb-3">
                <form method="POST">
                    <button class="btn btn-success btn-sm" title="Agregar nuevo id_marca">
                        <i class="bi bi-plus-lg"></i> Agregar Renta
                    </button>
                    <input type="hidden" name="action" value="formNew">
                </form>
            </div>

            <div class="table-responsive">
            <table class="table table-striped table-hover shadow-sm">
                <thead class="table-primary text-center">
                    <tr>
                        <th scope="col">Id Renta</th>
                        <th scope="col">Empleado</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Id Equipo</th>
                        <th scope="col">Forma de pago</th>
                        <th scope="col">Estado de la renta</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Duración</th>
                        <th scope="col">Costo</th>
                        <th scope="col" style="width: 100px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>';

            foreach($this->query_results as $register){
                $result .= "
                    <tr>
                        <th class='text-center'> ".$register['id_renta']." </th>
                        <td class='text-center'> ".$register['id_usuario_empleado']." </td>
                        <th class='text-center'> ".$register['id_usuario_cliente']." </th>
                        <th class='text-center'> ".$register['id_equipo']." </th>
                        <th class='text-center'> ".$register['id_forma_pago']." </th>
                        <td class='text-center'> ".$register['id_estado_renta']." </td>
                        <th class='text-center'> ".$register['fecha']." </th>
                        <th class='text-center'> ".$register['hora']." </th>
                        <th class='text-center'> ".$register['duracion']." </th>
                        <td class='text-center'> ".$register['costo']." </td>
                        <td class='text-center'>
                            <div class='d-flex justify-content-center gap-2'>
                                <form method='POST' class='btn btn-primary'>
                                    <input type='image' class='svg-white' style='width: 25px;' src='../assets/icons/edit-button.svg' alt='Edit icon' srcset=''>
                                    <input type='hidden' name='action' value='formEdit'>
                                    <input type='hidden' name='id_renta' value=".$register['id_renta'].">
                                    <input type='hidden' name='id_usuario_empleado' value=".$register['id_usuario_empleado'].">
                                    <input type='hidden' name='id_usuario_cliente' value=".$register['id_usuario_cliente'].">
                                    <input type='hidden' name='id_equipo' value=".$register['id_equipo'].">
                                    <input type='hidden' name='id_forma_pago' value=".$register['id_forma_pago'].">
                                    <input type='hidden' name='id_estado_renta' value=".$register['id_estado_renta'].">
                                    <input type='hidden' name='fecha' value=".$register['fecha'].">
                                    <input type='hidden' name='hora' value=".$register['hora'].">
                                    <input type='hidden' name='duracion' value=".$register['duracion'].">
                                    <input type='hidden' name='costo' value=".$register['costo'].">
                                </form>
                                <form method='POST' class='btn btn-danger'>
                                    <input type='image' class='svg-white' style='width: 30px;' src='../assets/icons/delete.svg' alt='Delete icon' srcset=''>
                                    <input type='hidden' name='action' value='delete'>
                                    <input type='hidden' name='id_renta' value=".$register['id_renta'].">
                                </form>
                            </div>
                        </td>
                    </tr>";
            }
            $result .= '
                </tbody>
            </table>
            </div>';

            echo $result;
        }

        function delete(){
            $id_renta = $_REQUEST['id_renta']; 
            $delete_renta_query = 'DELETE FROM renta WHERE id_renta = :id_renta;';
            $params = [':id_renta' => $id_renta,];
            $this->do_query($delete_renta_query, $params);

            $this->read();
        }
    }


    $equipoObject = new Renta();
    if ( isset($_REQUEST['action']) ){
        $action_case = $_REQUEST['action'];
        echo $equipoObject->action( $action_case );
    }else{
        echo $equipoObject->action('read');
    }
?>