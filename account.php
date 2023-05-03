<?php ob_start();
 require_once("admin/includes/init.php");
 require_once("admin/includes/functions.php");

 if(!$session->is_signed_in()) {header('Location: login.php');} 

?>

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
<body style="background:repeating-linear-gradient(45deg, hsla(64,83%,54%,0.05) 0px, hsla(64,83%,54%,0.05) 1px,transparent 1px, transparent 11px,hsla(64,83%,54%,0.05) 11px, hsla(64,83%,54%,0.05) 12px,transparent 12px, transparent 32px),repeating-linear-gradient(90deg, hsla(64,83%,54%,0.05) 0px, hsla(64,83%,54%,0.05) 1px,transparent 1px, transparent 11px,hsla(64,83%,54%,0.05) 11px, hsla(64,83%,54%,0.05) 12px,transparent 12px, transparent 32px),repeating-linear-gradient(0deg, hsla(64,83%,54%,0.05) 0px, hsla(64,83%,54%,0.05) 1px,transparent 1px, transparent 11px,hsla(64,83%,54%,0.05) 11px, hsla(64,83%,54%,0.05) 12px,transparent 12px, transparent 32px),repeating-linear-gradient(135deg, hsla(64,83%,54%,0.05) 0px, hsla(64,83%,54%,0.05) 1px,transparent 1px, transparent 11px,hsla(64,83%,54%,0.05) 11px, hsla(64,83%,54%,0.05) 12px,transparent 12px, transparent 32px),linear-gradient(90deg, rgba(248,10,19,0.5),rgba(249,77,77,0.5)) , url('img/acc.jpg'); background-size:cover;">
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
<nav class="navigation">
  
<label for="btn" class="icon">
        <span class="fa fa-bars"></span>
      </label>
      <input class="navigation__checkbox" type="checkbox" id="btn">
      <ul class="navigation__items">
<li><a href="index.php">Home</a></li>
<li>
          <label for="btn-1" class="show">Brands +</label>
          <a href="#">Brands</a>
          <input class="navigation__checkbox" type="checkbox" id="btn-1">
          <ul>
              <?php
              $brands = Brand::find_all(); 
              foreach($brands as $brand){
                  
              ?>

<li><a href="view_by_brand.php?brand=<?php echo $brand->id ?>"><?php echo $brand->name;?></a></li>

              <?php } ?>
</ul>
</li>
<li>
          <label for="btn-2" class="show">Products +</label>
          <a href="#">Product</a>
          <input  class="navigation__checkbox" type="checkbox" id="btn-2">
          <ul>
<!-- <li><a href="#">Web Design</a></li>
<li><a href="#">App Design</a></li> -->

<?php $categories = Category::find_all();
foreach($categories as $category){ ?>
<li>
              <label for="btn-3" class="show">More +</label>
              <a href="view_by_category.php?category=<?php echo $category->id ; ?>"><?php echo $category->name; ?> <span class="fa fa-plus"></span></a>
              <input class="navigation__checkbox" type="checkbox" id="btn-3">
              <ul>
              <?php
              $sql = "SELECT * FROM subcategory where category_id = $category->id ";
              $subcategories = Subcategory::find_by_query($sql);
foreach($subcategories as $subcategory){ ?>         
<li><a href="view_by_subcategory.php?subcategory=<?php echo $subcategory->id ; ?>"><?php echo $subcategory->name; ?></a></li>
<?php } ?>
</ul>

</li>
<?php } ?>



</ul>
</li>
<li><i class="fas  fa-globe-americas"></i><a href="contactus.php" >Feedback</a></li>
<!-- <li><i class="fas  fa-globe-americas"></i><a href="trial/nav.html" >Our Network</a></li> -->
<li><i class="fas  fa-headset"></i><a href="contactus.php" >Support</a></li>
<!-- <li><a href="#" >Store Locator</a></li> -->
<li><a href="products.php" >BestSellers</a></li>
<li><a href="products.php" >Today's Deals</a></li>
</ul>
</nav>
<?php $user = User::find_by_id($session->user_id); ?>
<?php 
if(isset($_POST['first_name'])){
    $user->first_name = $_POST['first_name'];

}
else if(isset($_POST['last_name'])){
    $user->last_name = $_POST['last_name'];

}

else if(isset($_POST['password'])){
    $user->password = $_POST['password'];
  
    $user->password = password_hash($user->password, PASSWORD_DEFAULT);

}
else if(isset($_POST['submit'])){

    $user->set_file($_FILES['file']);
    $user->save_data_and_image();
  
}
$user->save();

?>
    <main  >
       

        <section class="section-account"> 
            <!-- <h1 class="heading-secondary">Your Account</h1>  -->
        <div class="account__details">
            <div style="background-image: <?php 
            
            
           if(empty($user->filename)) {

           
           echo "url('img/userplace.png')";
           }
           else{
               echo "url('admin/images/$user->filename')";
           }
            
            
            
            
            ?> ;" class="account__image-box">
            <form class="account__form" action="" method="post" enctype="multipart/form-data">
 
  <input class="account__imginput" type="file" name="file" id="fileToUpload">
  <input class="account__imgbtn" type="submit" value="Upload Image" name="submit" >
</form>
               
               
                <!-- <img class="account__image" src="admin/images/index.jpg" alt=""> -->
            </div>
            <?php if(isset($_GET['change'])){ ?>
<div>First Name :</div> <?php  if($_GET['change'] == "fname"){
     ?> <form method="POST" class="account__form"> <input type="text"  name="first_name" value="<?php echo $user->first_name; ?>"> <input value="change" type="submit"> </form> <?php  } else { ?>  <div ><?php echo $user->first_name; ?> </div>   <?php } ?> <button> <a href="account.php?change=fname" ><i class="fa fa-pencil" aria-hidden="true"></i>
     </a></button>
     <div>Last Name :</div> <?php   if($_GET['change'] == "lname"){
     ?> <form method="POST" class="account__form"><input type="text"   name="last_name" value="<?php echo $user->last_name; ?>">  <input value="change" type="submit"> </form> <?php  } else  { ?>  <div ><?php echo $user->last_name; ?></div>   <?php } ?> <button > <a href="account.php?change=lname" ><i class="fa fa-pencil" aria-hidden="true"></i>
     </a></button>
     
      <div> Password :</div> <?php   if($_GET['change'] == "pass"){
     ?> <form  method="POST" class="account__form"><input type="password"  name="password" placeholder="Enter your password" value="">  <input value="change" type="submit"> </form> <?php  } else  { ?>  <div >************* </div>   <?php } ?> <button> <a href="account.php?change=pass"><i class="fa fa-pencil" aria-hidden="true"></i>
     </a></button>
            <!-- <div>Last Name :</div> <div >Raju </div> <button> <a href="account.php?change=lname">Edit </a></button>
            <div>Email :</div> <div >sngranites&@gmail.com </div> <button> <a href="account.php?change=email">Edit </a></button>
            <div>Passoword :</div> <div > ************* </div><button> <a href="account.php?change=pass">Edit </a></button> -->
     <?php } else { ?>

     <div>First Name :</div> 
      <div ><?php echo $user->first_name; ?> </div>  <button > <a href="account.php?change=fname" >Edit </a></button>
            <div>Last Name :</div> <div ><?php echo $user->last_name; ?> </div> <button> <a href="account.php?change=lname">Edit </a></button>

            <div>Password :</div> <div > ************* </div><button> <a href="account.php?change=pass">Edit </a></button>

     <?php } ?> 
     <div>Email:</div> <div><?php echo $user->email; ?> </div> <br>
 <div>User Role:</div> <div><?php echo $user->user_type; ?> </div>
        </div>
         <div class="account__cards">

              <div class="card card--account">
                <div class="card__side card__side--front  card__side--front-13">
                  
                    <h1> Your Orders </h1>
                </div>
                <div class="card__side card__side--back card__side--back-10">
                <a href="vieworder.php" class="btn btn--home">Orders </a>
                </div>
               </div> 
              <div class="card card--account">
                <div class="card__side card__side--front  card__side--front-13">
                   
                    <h1> Your Addresses </h1>
                </div>
                <div class="card__side card__side--back card__side--back-11">
                <a href="viewaddress.php" class="btn btn--home">Addresses </a>
                </div>
               </div>

               <div class="card card--account">
                <div class="card__side card__side--front card__side--front-13">
                    
             <h1>Payment Options  </h1>
                </div>
                <div class="card__side card__side--back card__side--back-12">
                <a href="viewcard.php" class="btn btn--home">Payment </a> 
                </div>
               </div>

            </div>
          </section>
          </main>
          <?php include_once("includes/footer.php"); ?>
          <script type="text/javascript" src="js/particles.js"></script>
          <script type="text/javascript" src="js/app.js"></script>

</body>
</html>