<?php require_once("admin/includes/init.php"); ?>
<?php 

if(isset($_POST['signUp'])){
    $user = new User();
    $name = $_POST['name'];
    $name = explode(" ",$name);
    $count = count($name);
    if(  $count == 3){
        $user->first_name = $name[0];
        $user->last_name = $name[2];
    }
    else{
        $user->first_name = $name[0];
     @   $user->last_name = $name[1]; 
    }
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];
    $user->user_type = "customer";
    $user->address_id = 0;
    $user->card_id = 0;
    $user->password = password_hash($user->password, PASSWORD_DEFAULT);
    $users = User::find_all();
    $flag=0;
    foreach($users as $u){
        if($u->email == $user->email){
            $flag=1;
  
        }
    }
    if($flag==1){
        $session->message = "User Already Exists";
    }
    else
    {
    $user->save();
    $user->email_verification();
    echo "<script>window.location.assign('mail.php')</script>";
}}

if(isset($_POST['signIn'])){

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $user_found = User::verify_user($email,$password);
    if($user_found){
        if($user_found->verified == 1 && $user_found->status==1 ){
        $session->login($user_found);
        
        if($session->user_role == "customer")
        {
            redirect("index.php");
        }
        else{
            redirect("admin/index.php");
        }
   
    }
    else if($user_found->verified == 0){
        $session->message = "You are not verified yet . We have sent the link to your mail on " . $user_found->date ." ";
       
    }
    else if($user_found->status == 0){
        $session->message = "Sorry , You are blocked ";
    }
    else{
        $session->message =  "Your Password Or Username Are Incorrect";
    }
}
    else{
        $session->message =  "Your Password Or Username Are Incorrect";
        

        }
}

    else{
        $username = "";
        $password = "";
    }




?>

<!DOCTYPE html>
<html>
    <head>
      
        <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/527093011c.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Ibarra+Real+Nova:wght@400;700&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>" media="all" type="text/css"> 
  
    </head>
    <body class="section-login">
        <a class="login__back" href="index.php">&#10006;</a>
    <h4 class="bg-danger"><?php echo $session->message; ?></h4>
        
        <div class="container" id="container">
            <div class="form-container sign-up-container">
                <form class="login__form" method="POST">
                    <h1 class="login__header--primary" >Create Account</h1>
                    <!-- <div class="login__social-container">
                        <a class="login__link" href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                        <a class="login__link" href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                        <a class="login__link" href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <span>or use your email for registration</span> -->
                    <div class="login__container" >
                    <input class="login__control" name="name" required type="text" required placeholder="Name" ></div>
                    <div class="login__container">
                    <input class="login__control" name="email"  required type="email" required placeholder="Email" ></div>
                    <div class="login__container">
                    <input class="login__control" name="password" minlength=10 required type="password" placeholder="Password" ></div>
                    <button class="login__button" name="signUp" >Sign Up</button>
                </form>
            </div>
            <div class="form-container sign-in-container">
                <form class="login__form" method="POST">
                    <h1 class="login__header--primary">Sign in</h1>
                    <!-- <div class="login__social-container">
                        <a class="login__link" href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                        <a class="login__link" href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                        <a class="login__link" href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <span>or use your account</span> -->
                    <input class="login__control" required  name="email" type="email" placeholder="Email" />
                    <input class="login__control" required name="password" type="password" placeholder="Password" />
                    <a class="login__link" href="forgotpage.php">Forgot your password?</a>
                    <button class="login__button" name="signIn">Sign In</button>
                </form>
            </div>
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <h1 class="login__header--primary">Welcome Back!</h1>
                        <p class="login__text">To keep connected with us please login with your personal info</p>
                        <button class="login__button ghost" id="signIn">Sign In</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h1 class="login__header--primary">Hello, Friend!</h1>
                        <p class="login__text">Enter your personal details and start journey with us</p>
                        <button class="login__button ghost" id="signUp">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>
        
       
        
        <script type="text/javascript" src="js/loginslide.js" ></script>
    </body>
</html>