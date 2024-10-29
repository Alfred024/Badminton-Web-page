<?php 
    include '../classes/database.php';
    // session_start();
    
    class Role extends Database{

        var $message = '<p style="color: darkred; font-weight: 700;">';

        function action($action_case){
            switch ($action_case) {
                case 'formNew':
                    // $methodForm = $_REQUEST['name']; // insert/update

                    $form = '
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" >
                                    <div class="form-group">
                                        
                                        <label for="role_name">
                                            Rol: 
                                        </label>
                                        <input id="role_name" name="rol" type="text" class="form-control"/>
                                    </div>
                                    <div class="d-flex justify-content-end mt-4">
                                        <button type="submit" class="btn bg-blue text-white">
                                            Crear/Actualizar
                                        </button>
                                    </div>
                                    <input type="hidden" value="create" name="action">
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
            // echo ' VAMOS A HACER UN INSERT ';
            $rol = $_POST['rol'];
            $insert_rol_query = '
                INSERT INTO rol ( rol ) 
                VALUES ( :rol );';
            
            $params = [':rol' => $rol,];
            
            $this->do_query($insert_rol_query, $params);
            $this->read();
        }

        function update(){
            $rol = $_POST['rol'];
            $update_rol_query = '
                UPDATE rol ( rol ) 
                VALUES ( :rol );';

            $params = [':rol' => $rol,];

            $this->do_query($update_rol_query, $params);
        }


        function read(){
            $get_user_query = 'SELECT * FROM rol';
            $this->get_query($get_user_query);

            $result = '
            <div class="d-flex justify-content-end mb-3">
                <form method="POST">
                    <button class="btn btn-success btn-sm" title="Agregar nuevo rol">
                        <i class="bi bi-plus-lg"></i> Agregar Rol
                    </button>
                    <input type="hidden" name="action" value="formNew">
                </form>
            </div>

            <div class="table-responsive">
            <table class="table table-striped table-hover shadow-sm">
                <thead class="table-primary text-center">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col" style="width: 100px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>';

            foreach($this->query_results as $register){
                $result .= "
                    <tr>
                        <th class='text-center'> ".$register['id_rol']." </th>
                        <td class='text-center'> ".$register['rol']." </td>
                        <td class='text-center'>
                            <div class='d-flex justify-content-center gap-2'>
                                <form class='btn btn-primary'>
                                    <input type='image' class='svg-white' style='width: 25px;' src='../assets/icons/edit-button.svg' alt='Edit icon' srcset=''>
                                   
                                </form>
                                <form method='POST' class='btn btn-danger'>
                                    <input type='image' class='svg-white' style='width: 30px;' src='../assets/icons/delete.svg' alt='Delete icon' srcset=''>
                                    <input type='hidden' name='action' value='delete'>
                                    <input type='hidden' name='id_rol' value=".$register['id_rol'].">
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
            $id_rol = $_POST['id_rol'];
            $delete_rol_query = 'DELETE FROM rol WHERE id_rol = :id_rol;';

            $params = [':id_rol' => $id_rol,];
            $this->do_query($delete_rol_query, $params);
            $this->read();
        }
    }


    $roleObject = new Role();
    if ( isset($_REQUEST['action']) ){
        $action_case = $_REQUEST['action'];
        echo $roleObject->action( $action_case );
    }else{
        echo $roleObject->action('read');
    }
?>