<?php require_once("admin/includes/init.php"); ?>
<?php 

if(isset($_POST['submit'])){
   
    $email = trim($_POST['email']);
    $sql = "SELECT * FROM users WHERE email = '$email'";

    $user = User::find_by_query($sql);
    $user = (!empty($user)) ? array_shift($user) : false ;
   
    $user->forgot_password();
    echo "<script>window.location.assign('mail.php')</script>";}






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
          
            <form class="forgot__form" action="" method="post">
                <label class="forgot__label" for="email">Enter your email address</label>
            <input id="email" name="email" class="forgot__input login__control" type="email">
            
          
            <input type="submit" name="submit" class="forgot__submit login__button" value="Submit">
            </form>
         
            </div>
      
        
       
        

    </body>
</html>