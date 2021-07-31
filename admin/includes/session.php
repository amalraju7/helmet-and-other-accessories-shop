<?php
class Session{
    public $message;
    public $user_id;
    public $signed_in = false;
    public $user_role;


  public  function __construct(){
        session_start();
        $this->checkMessage();
        $this->checkLogin();
    }

    public  function message($mssg=""){
        if(!empty($mssg)){
            $_SESSION['message'] = $mssg;
            $this->message = $mssg;
        
        }
        else
        {
            return $this->message;
        }
    }

    public  function checkMessage(){
        if(isset($_SESSION['message'])){
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        }
        else{
            $this->message = "";
        }
    }

    public function is_signed_in() {
		
		return $this->signed_in;
	}

    public   function login($user){
        if($user){
        $this->user_id = $_SESSION['user_id'] = $user->id;
        $this->user_role = $_SESSION['user_role'] = $user->user_type;
        $this->signed_in = true;
        }
        
    }


    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_role']);
        unset($this->user_id);
        unset($this->user_role);
        $this->signed_in = false;
    }

    public  function checkLogin(){
        if(isset($_SESSION['user_id'])){
            $this->user_id = $_SESSION['user_id'];
            $this->user_role = $_SESSION['user_role'];
            $this->signed_in = true;

        }
        else{
            unset($this->user_id);
            unset($this->user_role);
            $this->signed_in = false;
        }
    }
}

$session = new Session();
$message = $session->message();

?>