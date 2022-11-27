
var btnsSwitchLeft = document.querySelectorAll('.arrow-left');
var btnsSwitchRight = document.querySelectorAll('.arrow-right');

btnsSwitchLeft.forEach(function (btn) {
    btn.addEventListener('click', function (e) {
        e.preventDefault();
        var parent = e.target.parentNode.parentNode.querySelector(".candidates");
        var active = parent.querySelector('.active');
        var prev = active.previousElementSibling;
        if (prev) {
            active.classList.remove('active');
            prev.classList.add('active');
        } else {
            active.classList.remove('active');
            parent.lastElementChild.classList.add('active');
        }
    });
    }
);

btnsSwitchRight.forEach(function (btn) {
    btn.addEventListener('click', function (e) {
        e.preventDefault();
        var parent = e.target.parentNode.parentNode.querySelector(".candidates");
        var active = parent.querySelector('.active');
        var next = active.nextElementSibling;
        if (next) {
            active.classList.remove('active');
            next.classList.add('active');
        } else {
            active.classList.remove('active');
            parent.firstElementChild.classList.add('active');
        }
    });
    }
);