// Script permettant de modifier un parcours (prépare le formulaire POST avant l'envoi)

function updateJourney() {
    var ids = [];
    var selectedSteps = document.getElementsByClassName("active");
    for (var i = 0; i < selectedSteps.length; i++) {
        var step = selectedSteps[i];
        ids.push(step.getElementsByClassName("stepId")[0].value);
    }
    var strArray = ids.join(",");
    document.getElementById("candidatesUpdate").value = strArray;
}

var arrows = document.getElementsByClassName("change-step");
for (var i = 0; i < arrows.length; i++) {
    arrows[i].addEventListener("click", updateJourney);
}