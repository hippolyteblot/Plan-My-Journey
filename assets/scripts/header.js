
    var btn = document.getElementsByClassName("switch")[0];
console.log()
var body = document.body;
var darkmode = false;
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
