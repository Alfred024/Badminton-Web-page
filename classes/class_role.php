<?php 
    include '../classes/database.php';
    // session_start();
    
    class Role extends Database{

        var $message = '<p style="color: darkred; font-weight: 700;">';

        function action($action_case){
            switch ($action_case) {
                case 'create':
                    $this->create();
                    break;
                case 'read':
                    $this->read();
                break;
                case 'update':
                    $this->update();
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
            $rol = $_POST['rol'];
            $insert_rol_query = '
                INSERT INTO rol ( rol ) 
                VALUES ( :rol );';

            $params = [':rol' => $rol,];

            $this->do_query($insert_rol_query, $params);


        }

        function read(){
            $get_user_query = 'SELECT * FROM rol';
            $this->get_query($get_user_query);

            $result = '
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
                                <button class='btn btn-primary'><img class='svg-white' style='width: 25px;' src='../assets/icons/edit-button.svg' alt='Edit icon' srcset=''></button>
                                <button class='btn btn-danger'><img class='svg-white' style='width: 30px;' src='../assets/icons/delete.svg' alt='Delete icon' srcset=''></button>
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

        function update(){
            
        }

        function delete(){
            
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