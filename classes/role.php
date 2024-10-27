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
           
        }

        function read(){
            $get_user_query = 'SELECT * FROM rol';
            $this->get_query($get_user_query);

            $result = '
            <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>';

            foreach($this->query_results as $register){
                $result .= "
                    <tr>
                        <th> ".$register['id_rol']." </th>
                        <td> ".$register['rol']." </td>
                        <td>
                            <div class='d-flex'>
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