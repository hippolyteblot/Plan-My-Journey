// Check the input with the user notation
var notation = document.getElementsByName("notation");
var stars = document.getElementsByTagName("label");
var oldNotation = document.getElementsByName("oldNotation")[0].value;
for(var i = 0; i < notation.length; i++) {
    var star = stars[i];
    if(notation[i].value >= oldNotation) {
        star.classList.remove("fa-star");
        star.classList.add("fa-star-o");
    } else {
        star.classList.remove("fa-star-o");
        star.classList.add("fa-star");
    }
}