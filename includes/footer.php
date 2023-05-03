<footer class="footer">
    <div class="footer__top">
    <div class="footer__leftbox">
        <div ><img src="img/favicon.png" alt="Website Logo" class="footer__logo"></div>
        <?php if($session->is_signed_in()){ if($session->user_role == "customer"){ ?>
      <div class="footer__name"> Mactanse</div>

        <?php } else { ?>
            <a href="admin/products.php"> <div class="footer__name"> Mactanse</div></a>
        <?php }} ?>
    </div>
  <div class="footer__aboutus">
    <div class="footer__header">About Us</div>
    <div class="footer__text">Bacon ipsum dolor amet ribeye pork belly ham flank jerky andouille sausage kevin cow frankfurter pork salami. Chuck frankfurter bacon turducken shank. Capicola brisket hamburger meatball. Chuck prosciutto cupim tri-tip corned beef meatball, brisket pastrami alcatra meatloaf. Boudin pork loin corned beef t-bone sausage pork drumstick pork chop.</div>
  </div>
    <div class="footer__centerbox">
          <div class="footer__header">Information </div> 
          <div class="footer__text">About Us</div>
          <div class="footer__text">Support</div>
          <div class="footer__text">Our Network</div>
          <div class="footer__text">Store Locator</div>
          <div class="footer__header">Contact Us </div> 
          <div class="footer__text">7907071717</div>
          <div class="footer__text">sngranites7@gmail.com</div>


    </div>

    <div class="footer__rightbox">
        <div class="footer__subscribe">
        Subscribe For More Info</div
        <form action="">
            <input class="footer__email" type="email">
            <button class="footer__button">Subscrie</button>
        </form>
    </div></div>
    <hr>
    <div class="footer__bottom">
          <div class="footer__social-container">  
                  <a class="login__link" href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                  <a class="login__link" href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                  <a class="login__link" href="#" class="social"><i class="fab fa-twitter"></i></a>
                  <a class="login__link" href="#" class="social"><i class="fab fa-instagram"></i></a>
              </div>
        
  
    <div class="footer__copyright">
        2020 &copy; Mactanse.Ltd .  All Right reserved
    </div>
</footer>