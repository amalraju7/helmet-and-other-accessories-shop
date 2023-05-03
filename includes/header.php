<?php ob_start();
 require_once("admin/includes/init.php"); ?>
<?php require_once("admin/includes/functions.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/png" href="img/favicon.png">
    <title>Mactanse | For Riders  </title>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya:ital,wght@0,700;1,500&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Alegreya:wght@700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/527093011c.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,700,700italic,900,900italic" rel="stylesheet">
		
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>" media="all" type="text/css"> 
</head>
<body >
    <header class="header">
        <div class="header__leftbox ">
           <form action="products.php" method="GET" class="search__box">
               <input type="text" name="search" class="search__text" placeholder="Type here.....">
               <button  type="submit" class="search__button"><i class="fas  fa-search"></i></button>
</form>

        </div>
        <div class="header__centerbox">
        <div class="header__logo-box"> <img src="img/favicon.png" alt="Website Logo" class="header__logo"></div>
        <div class="header__text-box"><h1 class="header__text">Mactanse</h1></div>
    </div>
    <div class="header__rightbox">
    <?php if(!$session->is_signed_in()) { ?>
        <a class="header__button" href="login.php">Login</a>
    <?php } else {
        ?>
      <a class="header__button" href="admin/logout.php">Logout</a>
    <?php } ?>
       <a href="account.php"> <i class="fas  fa-user-circle"></i></a>
       <a href="cart.php">   <i class="fas  fa-shopping-bag"></i></a>
    </div>
    </header>