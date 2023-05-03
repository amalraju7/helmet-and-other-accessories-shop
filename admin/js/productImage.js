
let img = document.getElementsByClassName('product-card__image');
var imgO;

for(var i=0 ;i<img.length;i++)
{
img[i].addEventListener('mouseenter',imageChanger);
img[i].addEventListener('touchmove',imageChanger);
img[i].addEventListener('mouseleave',imagechanger)
}
function imageChanger(){
    imgO =this.src;
  
    let imgName = this.src.split('/');
   
    let imgNa = imgName[imgName.length-1];

    let imgI = imgNa.split('.');
   
    
    let imgN = imgI[0].split('');

    imgN[imgN.length - 1]=3;
    

    imgN = imgN.join('');

    

    imgI[0]=imgN;
    
    imgName[imgName.length-1]= imgI.join('.');
    this.src=imgName.join('/');
   


}
function imagechanger(){
    this.src = imgO;
}


