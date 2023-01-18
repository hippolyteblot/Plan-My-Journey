function scrollRightBtn(id) {
    var elem = document.getElementById(id);
    var counter = 0;
    var id = setInterval(frame, 3);
    function frame() {
        if (counter == 100) {
            clearInterval(id);
        } else {
            counter++;
            elem.scrollLeft += 3;
        }
    }
}

function scrollLeftBtn(id) {
    var elem = document.getElementById(id);
    var counter = 0;
    var id = setInterval(frame, 3);
    function frame() {
        if (counter == 100) {
            clearInterval(id);
        } else {
            counter++;
            elem.scrollLeft -= 3;
        }
    }
}
