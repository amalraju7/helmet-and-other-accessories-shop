
<?php require_once("admin/includes/init.php"); ?>
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
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
		<script type="text/javascript" src="js/cardslider.js" ></script>

    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>" media="all" type="text/css"> 
</head>
<body style="background:black;" class="wrapper">
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
<?php
include_once("includes/navigation.php");
?>

    <main class="main">
        <div class="demo-cont">
            <!-- slider start -->
            <div class="fnc-slider example-slider">
              <div class="fnc-slider__slides">
                <!-- slide start -->
                <div class="fnc-slide m--blend-green m--active-slide">
                  <div class="fnc-slide__inner">
                    <div class="fnc-slide__mask">
                      <div class="fnc-slide__mask-inner"></div>
                    </div>
                    <div class="fnc-slide__content">
                      <h2 class="fnc-slide__heading">
                        <div class="fnc-slide__heading-line">
                            <blockquote><p> &#10077;Happiness Isn’t Around the Corner. Happiness is the Corner&#10078;
                            </p>
                            <footer class="fnc-slide__footer">
                                &mdash; Giacomo Agostini
                            </footer></blockquote>
                        </div>
                        
                      </h2>
                      
                    </div>
                  </div>
                </div>
                <!-- slide end -->
                <!-- slide start -->
                <div class="fnc-slide m--blend-dark">
                  <div class="fnc-slide__inner">
                    <div class="fnc-slide__mask">
                      <div class="fnc-slide__mask-inner"></div>
                    </div>
                    <div class="fnc-slide__content">
                      <h2 class="fnc-slide__heading">
                        <div class="fnc-slide__heading-line">
                          <blockquote><p> &#10077;Riding a Motorcycle is Like an Art: Something You Do Because You Feel Something Inside&#10078;</p>
                        <footer class="fnc-slide__footer">
                            &mdash; Valentino Rossi
                        </footer></blockquote>
                        
                        </div>
                       
                      </h2>
                      
                    </div>
                  </div>
                </div>
                <!-- slide end -->
                <!-- slide start -->
                <div class="fnc-slide m--blend-red">
                  <div class="fnc-slide__inner">
                    <div class="fnc-slide__mask">
                      <div class="fnc-slide__mask-inner"></div>
                    </div>
                    <div class="fnc-slide__content">
                      <h2 class="fnc-slide__heading">
                        <div class="fnc-slide__heading-line">
                            <blockquote><p> &#10077;Life is Not About Waiting for the Storms to Pass. It’s About Learning to Ride in the Rain&#10078; </p>
                                <footer class="fnc-slide__footer">
                                    &mdash; Ángel Nieto
                                </footer></blockquote>
                        </div>
                        
                      </h2>
                      
                    </div>
                  </div>
                </div>
                <!-- slide end -->
                <!-- slide start -->
                <div class="fnc-slide m--blend-blue">
                  <div class="fnc-slide__inner">
                    <div class="fnc-slide__mask">
                      <div class="fnc-slide__mask-inner"></div>
                    </div>
                    <div class="fnc-slide__content">
                      <h2 class="fnc-slide__heading">
                        <div class="fnc-slide__heading-line">
                            <blockquote><p> &#10077;A Good Long Ride Can Clear Your Mind, Restore Your Faith and Use Up a Lot of Fuel&#10078;</p>
                                <footer class="fnc-slide__footer">
                                    &mdash; Mike Hailwood
                                </footer></blockquote>
                        </div>
                        
                      </h2>
                      
                    </div>
                  </div>
                </div>
                <!-- slide end -->
              </div>
              <nav class="fnc-nav">
                <div class="fnc-nav__bgs">
                  <div class="fnc-nav__bg m--navbg-green m--active-nav-bg"></div>
                  <div class="fnc-nav__bg m--navbg-dark"></div>
                  <div class="fnc-nav__bg m--navbg-red"></div>
                  <div class="fnc-nav__bg m--navbg-blue"></div>
                </div>
                <div class="fnc-nav__controls">
                  <button class="fnc-nav__control">
                    EAT &nbsp;<i class="fas  fa-utensils"></i>
                    <span class="fnc-nav__control-progress">
                    
                    </span>
                  </button>
                  <button class="fnc-nav__control">
                    SLEEP &nbsp;<i class="fas  fa-bed"></i>
                    <span class="fnc-nav__control-progress"  ></span>
                  </button>
                  <button class="fnc-nav__control">
                   RIDE &nbsp;<i class="fas  fa-biking"></i>
                    <span class="fnc-nav__control-progress"></span>
                  </button>
                  <button class="fnc-nav__control">
                    REPEAT &nbsp; <i class="fas  fa-redo"></i>
                    <span class="fnc-nav__control-progress"></span>
                  </button>
                </div>
              </nav>
            </div>
        </div>
       
        
            <!-- slider end -->
           
          </div>  
          <section class="section-brands">
          
            <div class="card">
              <div class="card__side card__side--front card__side--front-1">
                
              </div>
              <div class="card__side card__side--back  card__side--back-1">
                  <a href="view_by_brand.php?brand=3" class="btn btn--home">View Products</a>
              </div>
                
            </div>
            <div class="card">
              <div class="card__side card__side--front card__side--front-2">
              
              </div>
              <div class="card__side card__side--back card__side--back-2">
                  <a href="view_by_brand.php?brand=4" class="btn btn--home">View Products</a>
              </div>
                
            </div>
            <div class="card">
              <div class="card__side card__side--front  card__side--front-3">
               
              </div>
              <div class="card__side card__side--back card__side--back-3">
                  <a href="view_by_brand.php?brand=9" class="btn  btn--home">View Products</a>
              </div>
             </div>

             <div class="card">
              <div class="card__side card__side--front card__side--front-4">
              
              </div>
              <div class="card__side card__side--back card__side--back-4">
                  <a href="view_by_brand.php?brand=7" class="btn btn--home">View Products</a>
              </div>
             </div>

             <div class="card">
              <div class="card__side card__side--front card__side--front-5">
              
              </div>
              <div class="card__side card__side--back card__side--back-5">
                  <a href="view_by_brand.php?brand=8" class="btn btn--home">View Products</a>
              </div>
                
            </div>
            <div class="card">
              <div class="card__side card__side--front card__side--front-6">
               
              </div>
              <div class="card__side card__side--back card__side--back-6">
                <a href="view_by_brand.php?brand=11" class="btn btn--home">View Products</a>
              </div>
                
            </div>
            <div class="card">
              <div class="card__side card__side--front card__side--front-7">
               
              </div>
              <div class="card__side card__side--back card__side--back-7">
                  <a href="view_by_brand.php?brand=10" class="btn btn--home">View Products</a>
              </div>
             </div>

             <div class="card">
              <div class="card__side card__side--front card__side--front-8">
               
              </div>
              <div class="card__side card__side--back card__side--back-8">
                  <a href="view_by_brand.php?brand=12" class="btn btn--home">View Products</a>
              </div>
             </div>
        </section>
        <section class="section-stories">
          <div class="bg-video">
            <video class="bg-video__content" autoplay loop >
                <source src="img/videos/video.mp4" type="video/mp4">
               
                Your browser is not supported!
            </video>
        </div>
       

        <div class="card__container">
          <div class="card__button--prev "></div>
          <div class="card__button--next "></div>
          <ul class="card__items">
            <li class="card__item"><img class="card__image" src="img/home-products/helmet.png" alt=""></li>
            <li class="card__item" ><img  class="card__image"  src="img/home-products/jacket.png" alt="" ></li>
            <li class="card__item"><img class="card__image"  src="img/home-products/lube.png" alt="" ></li>
            <li class="card__item"><img  class="card__image" src="img/home-products/boot.png" alt="" ></li>
            <li class="card__item"><img  class="card__image" src="img/home-products/glove.png" alt="" ></li>
            <li class="card__item"><img  class="card__image" src="img/home-products/visor.png" alt="" ></li>
            <li class="card__item"><img  class="card__image" src="img/home-products/pant.png" alt="" ></li>
            <li class="card__item"></li>
          </ul>
        </div>
        
        
        
    
        <script>
        var state;
          $('.card__container').cardSlide();
        </script>

        </section>
          
    </main>
    <?php include("includes/footer.php"); ?>
   
<script src="js/dropdown.js"></script>
    <script src="js/imageslider.js"></script>
    <script>
      $('.icon').click(function(){
        $('span').toggleClass("cancel");
      });
    </script>

  
</body>
</html>