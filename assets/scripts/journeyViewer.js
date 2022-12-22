// Check the input with the user notation
var notation = document.getElementsByName("notation");
var oldNotation = document.getElementsByName("oldNotation")[0].value;
for(var i = 0; i < notation.length; i++) {
    if(notation[i].value == oldNotation) {
        notation[i].checked = true;
        notation[i].style.backgroundColor = "#f1c40f";
    }
}