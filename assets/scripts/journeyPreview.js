var listOfNotations = document.getElementsByClassName("notation");
for (var i = 0; i < listOfNotations.length; i++) {
    var value = listOfNotations[i].getElementsByTagName("input")[0].value;
    if (value == "0") {
        listOfNotations[i].innerHTML = "Aucune note";
    } else {
        var stars = listOfNotations[i].getElementsByTagName("span");
        for (var j = 0; j < stars.length; j++) {
            if (j < value) {
                stars[j].className = "fa fa-star";
            } else {
                stars[j].className = "fa fa-star-o";
            }
        }
    }
}

var journeyPreviewList = document.getElementsByClassName("journey-preview");

for (var i = 0; i < journeyPreviewList.length; i++) {
    journeyPreviewList[i].addEventListener("click", function () {
        openJourney(this.id);
    });
}


function openJourney(journeyId) {
    window.location.href = "./?page=journeyViewer&id=" + journeyId;
}