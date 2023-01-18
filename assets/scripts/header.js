
var btn = document.getElementsByClassName("switch")[0];
var body = document.body;
var darkmode = false;
var src = '';
var count = 0;
btn.addEventListener("click", () => { 
    count++;
    if (count % 2 == 0){
        if (darkmode == false){
            body.style.background = 'url(./assets/images/test.jpg)';
            body.style.backgroundSize = 'cover';
            body.style.backgroundRepeat = 'no-repeat';
            body.style.backgroundAttachment = 'fixed';
            colorAVG('./assets/images/test.jpg');

            darkmode = true;
            

        }
        else if (darkmode == true){
            changeBackground();
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

if (readCookie("dynamique") == "true"){
    document.body.style.background = 'url(./assets/images/background3.png)';
    document.body.style.backgroundSize = 'cover';
    document.body.style.backgroundRepeat = 'no-repeat';
    document.body.style.backgroundAttachment = 'fixed';
}
if (readCookie("darkmode") == "true"){
    document.body.style.background = 'url(./assets/images/test.jpg)';
    document.body.style.backgroundSize = 'cover';
    document.body.style.backgroundRepeat = 'no-repeat';
    document.body.style.backgroundAttachment = 'fixed';
    colorAVG('./assets/images/test.jpg');
    btn.getElementsByTagName("input")[0].checked = true;
    darkmode = true;
    
}


else if (readCookie("darkmode") == "false" && readCookie("dynamique") == "false" || readCookie("darkmode") == "false" && readCookie("dynamique") == null){
    console.log("noaml");
    changeBackground();
    btn.getElementsByTagName("input")[0].checked = false;
    darkmode = false;
}

// ASync function to get the average color of an image
async function colorAVG(source){
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
        
        var glass = document.querySelectorAll(".glass");
    
        for (let i = 0; i < glass.length; i++) {
            glass[i].style.boxShadow = str;
        }
    
    };
}



function hoursToInt(){
    let heure = new Date().getHours();
    let chiffre;
    
    if (heure >= 6 && heure < 10) {
      chiffre = 1;
    } else if (heure >= 10 && heure < 14) {
      chiffre = 2;
    } else if (heure >= 14 && heure < 18) {
      chiffre = 3;
    } else if (heure >= 18 && heure < 23) {
      chiffre = 4;
    } else {
      chiffre = 5;
    }
    
    return chiffre;
}





function changeBackground() {
    var listebg = []
    listebg[0] = "./assets/images/test.jpg";
    listebg[1] = "./assets/images/background1.jpg";
    listebg[2] = "./assets/images/background2.jpg";
    listebg[3] = "./assets/images/background3.png";
    listebg[4] = "./assets/images/background4.jpg";
    listebg[5] = "./assets/images/background5.jpg";
    var chiffre = hoursToInt() + 1;
    document.body.style.background = 'url('+ listebg[chiffre] +')';
    document.body.style.backgroundSize = 'cover';
    document.body.style.backgroundRepeat = 'no-repeat';
    document.body.style.backgroundAttachment = 'fixed';
    colorAVG(listebg[chiffre]);
}