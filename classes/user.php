<?php 
    session_start();
    include './database.php';
    
    class User extends Database{

        var $message = '<p style="color: darkred; font-weight: 700;">';

        function action($action_case){
            switch ($action_case) {
                case 'login':
                    $this->login();
                    break;
                case 'register':
                    $this->register();
                    break;
                
                default:
                    # code...
                    break;
            }
        }

        function login(){
            $email = $_REQUEST['email'];
            $pswd = $_REQUEST['pswd'];
            $captcha = 5;

            if ( $email != null && $pswd != null && $captcha != null ) {
                $get_user_query = 'SELECT * FROM usuario WHERE email = :email';
                $get_params = [':email' => $email];
                
                $this->do_query($get_user_query, $get_params);
                if( $this->query_results_num == 0 ){
                    header("location: ../login.php?m=2"); 
                }else{

                    $get_user_query = 'SELECT * FROM usuario WHERE email = :email and clave = :pswd';
                    $get_params = [':email' => $email, ':pswd' => $pswd];
                    $this->get_query($get_user_query, $get_params);
                    if( $this->query_results_num == 1 ){
                        $user_rol = $this->query_results['id_rol'];
                        if($user_rol == 1){
                            $_SESSION['admin'] = true;
                            $_SESSION['user_email'] = $this->query_results['email'];
                            $_SESSION['user_name'] = $this->query_results['nombres'];

                            header("location: ../admin/index.php");
                        }else{
                            header("location: ../user/index.php"); 
                        }
                    }else{
                        header("location: ../login.php?m=4");
                    }
                }
            }else{
                header("location: ../login.php?m=3"); 
            }
        }
        
        function register(){
            $name = $_REQUEST['name'];
            $last_name = $_REQUEST['last_name'];
            $gender = $_REQUEST['gender'];
            $pswd = $_REQUEST['pswd'];
            $email = $_REQUEST['email'];
            $captcha = 5;

            if ( $email != null && $pswd != null && $name != null && $last_name != null && $captcha != null && $gender != null ) {
                // TODO: Validar que el captcha esté correcto m=1

                $get_user_query = 'SELECT * FROM usuario WHERE email = :email';
                $get_params = [':email' => $email];
                
                $this->do_query($get_user_query, $get_params);
                if( $this->query_results_num == 1 ){
                    header("location: ../register.php?m=2"); 
                }else{
                    // FIXME: Aquí generaríamos la contraseña, pero como no funciona el email, no hay forma de saber cuál sería 
                    // FIXME: Mandar el email, si el resultado es True, hace el registro en la base de datos
    
                    switch ($gender) {
                        case 'm':
                            $gender = 2;
                            break;
                        case 'h':
                            $gender = 1;
                            break;
                        case 'o':
                            $gender = 3;
                            break;
                    }
                    $insert_user_query = '
                        INSERT INTO usuario ( id_rol, id_genero, nombres, apellidos, clave, email ) 
                        VALUES ( 2, 3, :name, :last_name, :pswd, :email );';
    
                    $params = [':name' => $name, ':last_name' => $last_name,':pswd' => $pswd, ':email' => $email,];
                    $this->do_query($insert_user_query, $params);
    
                    if($this->query_results_num == 1){
                        header("location: ../register.php?m=4");    
                    }
                }
                
            }else{
                header("location: ../register.php?m=3"); 
            }
        }

        function hashPassword($pswdText){
            $charData = 'abcde1234$*%&';
            
            $newPassword = '';
            for ($cicle=0; $cicle < strlen($pswdText); $cicle++) { 
                $randomChar = $charData[ rand(0, strlen($charData))-1 ];
                $newPassword += $randomChar;
            }
            return $newPassword;
        }
        
        function sendEmail($subject, $content, $email) : Bool {
            include '../resources/class.smtp.php';
            include '../resources/class.phpmailer.php';

            $mailer = new PHPMailer();
            $mailer->IsSMTP();
            $mailer->Host=SMTP_HOST; 
            $mailer->SMTPSecure = 'ssl';
            $mailer->Port = SMTP_PORT;  
            $mailer->SMTPDebug  = 1;  
            $mailer->SMTPAuth = true;
            $mailer->Username =  SMTP_EMAIL;
            $mailer->Password = SMTP_PSWD; 
            $mailer->From="";
            $mailer->FromName="";
            $mailer->Subject = $subject;
            $mailer->MsgHTML("<h1> ".$content." </h1>");
            $mailer->AddAddress($email);

            return $mailer->Send();
        }
    }


    $userObject = new User();
    if ( isset($_REQUEST['action']) ){
        $action_case = $_REQUEST['action'];
        $userObject->action( $action_case );
    }
?>