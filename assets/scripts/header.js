
var btn = document.getElementsByClassName("switch")[0];
var body = document.body;
var darkmode = false;
var src = './assets/images/background.png';
console.log(src);
var count = 0;
btn.addEventListener("click", () => { 
    count++;
    if (count % 2 == 0){
        if (darkmode == false){
            body.style.background = 'url(./assets/images/test.jpg)';
            body.style.backgroundSize = 'cover';
            body.style.backgroundRepeat = 'no-repeat';
            body.style.backgroundAttachment = 'fixed';
            
            darkmode = true;

        }
        else if (darkmode == true){
            body.style.background = 'url(./assets/images/background.png)';
            
            body.style.backgroundSize = 'cover';
            body.style.backgroundRepeat = 'no-repeat';
            body.style.backgroundAttachment = 'fixed';
            darkmode = false;
            
        }
        document.cookie = "darkmode=" + darkmode + ";";
    }
});
//lis les cookies 
function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

if (readCookie("darkmode") == "true"){
    document.body.style.background = 'url(./assets/images/test.jpg)';
    document.body.style.backgroundSize = 'cover';
    document.body.style.backgroundRepeat = 'no-repeat';
    document.body.style.backgroundAttachment = 'fixed';
    btn.getElementsByTagName("input")[0].checked = true;
    darkmode = true;
    
}
else if (readCookie("darkmode") == "false"){
    document.body.style.background = 'url(./assets/images/background.png)';
    document.body.style.backgroundSize = 'cover';
    document.body.style.backgroundRepeat = 'no-repeat';
    document.body.style.backgroundAttachment = 'fixed';
    btn.getElementsByTagName("input")[0].checked = false;
    darkmode = false;
}

function colorAVG(source){
// créer une nouvelle instance de l'objet Image()
let image = new Image();
image.src = source;

let pixels = [];
image.onload = () => {

    let canvas = document.createElement("canvas");
    canvas.width = image.width;
    canvas.height = image.height;
    let context = canvas.getContext("2d");
    context.drawImage(image, 0, 0);
    let imageData = context.getImageData(0, 0, image.width, image.height);
    for (let i = 0; i < imageData.data.length; i += 4) {
        pixels.push([
            imageData.data[i],
            imageData.data[i + 1],
            imageData.data[i + 2],
        ]);
    }
    let sumRed = 0;
    let sumGreen = 0;
    let sumBlue = 0;
    for (let i = 0; i < pixels.length; i++) {
        sumRed += pixels[i][0];
        sumGreen += pixels[i][1];
        sumBlue += pixels[i][2];
    }
    let avgRed = Math.round(sumRed / pixels.length)+15;
    let avgGreen = Math.round(sumGreen / pixels.length)+15;
    let avgBlue = Math.round(sumBlue / pixels.length)+15;

    // afficher le résultat
    var str = (`0 10px 21px 0 rgb(${avgRed} ${avgGreen} ${avgBlue} / 33%)`);
    console.log(str);
    
    var glass = document.querySelectorAll(".glass");

    for (let i = 0; i < glass.length; i++) {
        console.log(glass[i]);
        glass[i].style.boxShadow = str;
    }

};
}

colorAVG(src);


