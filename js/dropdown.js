function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
  }
  
  document.getElementsByClassName("navigation__button")[0].addEventListener("click",function(){
console.log("hiii");

    var dropdowns = document.getElementsByClassName("navigation__dropdown");
    console.log(dropdowns)
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
    
        openDropdown.classList.toggle('show');
  
    
  }

  });
  <nav class="navigation">
  <ul class="navigation__items">
  
      <li class="navigation__item"><i class="fas  fa-home"></i><a href="#" class="navigation__link  ">Home</a></li>
      <li class="navigation__item"><a class="navigation__link navigation__button">Products</a><div id="myDropdown" class="navigation__dropdown">
<a href="#">Link 1</a>
<a href="#">Link 2</a>
<a href="#">Link 3</a>
</div></li>
      <li class="navigation__item"><a href="#" class="navigation__link">Brands</a></li>
      <li class="navigation__item"><i class="fas  fa-globe-americas"></i><a href="#" class="navigation__link">Our Network</a></li>
      <li class="navigation__item"><i class="fas  fa-headset"></i><a href="#" class="navigation__link">Support</a></li>
      <li class="navigation__item"><a href="#" class="navigation__link">Store Locator</a></li>
      <li class="navigation__item"><a href="#" class="navigation__link">BestSellers</a></li>
      <li class="navigation__item"><a href="#" class="navigation__link">Today's Deals</a></li>
