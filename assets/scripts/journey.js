
var journeyPreviewList = document.getElementsByClassName("journey-preview");

for (var i = 0; i < journeyPreviewList.length; i++) {
    journeyPreviewList[i].addEventListener("click", function () {
        openJourney(this.id);
    });
}


function openJourney(journeyId) {
    window.location.href = "./?page=journeyViewer&id=" + journeyId;
}