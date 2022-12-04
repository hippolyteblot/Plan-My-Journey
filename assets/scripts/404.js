//recuperer url
var tab = window.location.href.split("/");
tab.pop();
var url = tab.join("/");
window.setTimeout('window.location="' + url + '"; ', 5000);


