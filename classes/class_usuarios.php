<?php 
    include '../classes/database.php';
    // session_start();
    
    class Usuario extends Database{

        var $message = '<p style="color: darkred; font-weight: 700;">';

        function action($action_case){
            switch ($action_case) {
                case 'formEdit':
                case 'formNew':

                    if ( $action_case == 'formNew' ){
                        $button_label = 'Crear';
                        $method_name = 'create';
                        $nombres = '';
                        $apellidos = '';
                        $clave = '';
                        $email = '';
                    }else{
                        $button_label = 'Actualizar';
                        $method_name = 'update';
                        $id = $_REQUEST['id_usuario'];
                        $nombres = $_REQUEST['nombres'];
                        $apellidos = $_REQUEST['apellidos'];
                        $clave = $_REQUEST['clave'];
                        $email = $_REQUEST['email'];
                    }

                    $form = '
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="POST" >
                                '. (isset($id) ? "<input type='hidden' name='id_usuario' value=".$id.">" : "") .'

                                    <div class="form-group">
                                        
                                        <label for="role_name">
                                            Usuario nombre: 
                                        </label>
                                        <input id="role_name" name="nombres" type="text" class="form-control" value="'.$nombres.'"/>
                                    </div>
                                    <div class="form-group">
                                        
                                        <label for="role_name">
                                            Apellido: 
                                        </label>
                                        <input id="role_name" name="apellidos" type="text" class="form-control" value="'.$apellidos.'"/>
                                    </div>
                                    <div class="form-group">
                                        
                                        <label for="role_name">
                                            Email: 
                                        </label>
                                        <input id="role_name" name="email" type="text" class="form-control" value="'.$email.'"/>
                                    </div>
                                    <div class="form-group">
                                        
                                        <label for="role_name">
                                            Clave: 
                                        </label>
                                        <input id="role_name" name="clave" type="text" class="form-control" value="'.$clave.'"/>
                                    </div>

                                    '. ( $method_name == 'create' 
                                        ? "
                                        <div class='form-group'>
                                            
                                            <label for='role_name'>
                                                Confirmar Clave: 
                                            </label>
                                            <input id='role_name' name='clave2' type='text' class='form-control' value='".$clave."'/>
                                        </div>
                                        " : "" ) .'
                                  

                                    <div class="d-flex justify-content-end mt-4">
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
            // echo ' VAMOS A HACER UN INSERT ';
            
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $email = $_POST['email'];
            $clave = $_POST['clave'];
            // TODO: Validar que las claves sean iguales
            $clave2 = $_POST['clave2'];

            $insert_rol_query = '
                INSERT INTO usuario ( nombres, apellidos, email, clave ) 
                VALUES ( :nombres, :apellidos, :email, :clave);';
            
            $params = [':nombres' => $nombres, ':apellidos' => $apellidos, ':email' => $email, ':clave' => $clave];
            
            $this->do_query($insert_rol_query, $params);
            $this->read();
        }

        function update(){
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $email = $_POST['email'];
            $clave = $_POST['clave'];
            $id_usuario = $_POST['id_usuario'];
            
            $update_rol_query = '
                UPDATE usuario SET nombres = :nombres, apellidos = :apellidos, email = :email, clave = :clave   
                WHERE id_usuario = :id_usuario;';
            $params = [':nombres' => $nombres, ':apellidos' => $apellidos, ':email' => $email, ':clave' => $clave, ':id_usuario' => $id_usuario];

            $this->do_query($update_rol_query, $params);
            $this->read();
        }


        function read(){
            $get_user_query = 'SELECT * FROM usuario';
            $this->get_query($get_user_query);

            $result = '
            <div class="d-flex justify-content-end mb-3">
                <form method="POST">
                    <button class="btn btn-success btn-sm" title="Agregar nuevo nombres">
                        <i class="bi bi-plus-lg"></i> Agregar Usuario
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
                        <th scope="col">Apellidos</th>
                        <th scope="col">Email</th>
                        <th scope="col">Ultimo acceso</th>
                        <th scope="col" style="width: 100px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>';

            foreach($this->query_results as $register){
                $result .= "
                    <tr>
                        <th class='text-center'> ".$register['id_usuario']." </th>
                        <td class='text-center'> ".$register['nombres']." </td>
                        <th class='text-center'> ".$register['apellidos']." </th>
                        <th class='text-center'> ".$register['email']." </th>
                        <td class='text-center'> ".$register['ultimo_acceso']." </td>
                        <td class='text-center'>
                            <div class='d-flex justify-content-center gap-2'>
                                <form method='POST' class='btn btn-primary'>
                                    <input type='image' class='svg-white' style='width: 25px;' src='../assets/icons/edit-button.svg' alt='Edit icon' srcset=''>
                                    <input type='hidden' name='action' value='formEdit'>
                                    <input type='hidden' name='id_usuario' value=".$register['id_usuario'].">
                                    <input type='hidden' name='nombres' value=".$register['nombres'].">
                                    <input type='hidden' name='apellidos' value=".$register['apellidos'].">
                                    <input type='hidden' name='email' value=".$register['email'].">
                                    <input type='hidden' name='clave' value=".$register['clave'].">
                                </form>
                                <form method='POST' class='btn btn-danger'>
                                    <input type='image' class='svg-white' style='width: 30px;' src='../assets/icons/delete.svg' alt='Delete icon' srcset=''>
                                    <input type='hidden' name='action' value='delete'>
                                    <input type='hidden' name='id_usuario' value=".$register['id_usuario'].">
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
            $id_usuario = $_REQUEST['id_usuario']; 
            $delete_rol_query = 'DELETE FROM usuario WHERE id_usuario = :id_usuario;';
            $params = [':id_usuario' => $id_usuario,];
            $this->do_query($delete_rol_query, $params);

            $this->read();
        }
    }


    $roleObject = new Usuario();
    if ( isset($_REQUEST['action']) ){
        $action_case = $_REQUEST['action'];
        echo $roleObject->action( $action_case );
    }else{
        echo $roleObject->action('read');
    }
?>