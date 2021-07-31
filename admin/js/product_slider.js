

let thumbnails = document.getElementsByClassName('productS__thumbnail');
let active = document.getElementsByClassName('active')

for(var i=0 ; i < thumbnails.length ; i++){
thumbnails[i].addEventListener('mouseover',function(){
    if(active.length>0){
        active[0].classList.remove('active');
    }
  
    this.classList.add('active');
    
    document.getElementsByClassName('productS__featured')[0].src = this.src;
   
});
}


let arrowDown = document.querySelector('.arrow-up');
let arrowUp = document.querySelector('.arrow-down');

arrowUp.addEventListener('click',function(){
    document.querySelector('.productS__slider').scrollTop += 180;
});

arrowDown.addEventListener('click',function(){
    document.querySelector('.productS__slider').scrollTop -= 180;
});




//zoom effect 
document.getElementsByClassName('productS__featured-box')[0].addEventListener('mouseover',function(){
    imgZoom('lens')
})

function imgZoom(imgId)
{
    
let featured = document.getElementById(imgId);
let lens = document.getElementsByClassName('productS__lens')[0];


lens.style.backgroundImage = `url( ${featured.src} )`;
let ratio =3;
lens.style.backgroundSize = (featured.width * ratio) + "px " + (featured.height * ratio) + "px ";

featured.addEventListener('mousemove',moveLens);
lens.addEventListener('mousemove',moveLens);
featured.addEventListener('touchmove',moveLens);


function moveLens(){

  let pos = getCursor();  

lens.style.opacity = "1";
let positionLeft = pos.x - (lens.offsetWidth / 2);
let positionTop = pos.y - (lens.offsetHeight / 2);

if(positionLeft < 0){
    positionLeft = 0;
}

if(positionTop < 0){
    positionTop = 0;
}

if(positionLeft > featured.width - lens.offsetWidth / 3 ){
    positionLeft = featured.width - lens.offsetWidth / 3 
}

if(positionTop > featured.height - lens.offsetHeight / 3 ){
    positionTop = featured.height - lens.offsetHeight / 3 
}


lens.style.left = positionLeft + "px";
lens.style.top = positionTop + "px";


lens.style.backgroundPosition = "-" + (pos.x * ratio ) + "px -" + (pos.y * ratio) + "px";
}

function getCursor()
{ 
    let e = window.event;
    let bounds = featured.getBoundingClientRect();
   


    let x=(e.pageX - bounds.left);
    let y=(e.pageY - bounds.top);
    x = x - window.pageXOffset;
    y = y -window.pageYOffset;

    return{'x':x , 'y':y};
}


}

