var saveBtn = document.getElementById("btn-save-journey");

// Disable submit action on form
saveBtn.addEventListener("click", function(event) {
    event.preventDefault();

    // Get elemets with the class "active"
    var activeSteps = document.getElementsByClassName("active");
    var stepsId = [];
    for(var i = 0; i < activeSteps.length; i++) {
        stepsId.push(activeSteps[i].getElementsByTagName("input")[0].value);
    }
    var journeyName = document.getElementById("journey-name").value;
    var journeyDescription = document.getElementById("journey-description").value;
    var public = document.getElementById("public").value;

    // Create form post
    var form = document.createElement("form");
    form.setAttribute("method", "post");
    form.setAttribute("action", "./?page=saveJourney");

    // Add active steps to form
    var hiddenField = document.createElement("input");
    hiddenField.setAttribute("type", "hidden");
    hiddenField.setAttribute("name", "activeSteps");
    hiddenField.setAttribute("value", stepsId);
    form.appendChild(hiddenField);

    // Add journey name to form
    hiddenField = document.createElement("input");
    hiddenField.setAttribute("type", "hidden");
    hiddenField.setAttribute("name", "journeyName");
    hiddenField.setAttribute("value", journeyName);
    form.appendChild(hiddenField);

    // Add journey description to form
    hiddenField = document.createElement("input");
    hiddenField.setAttribute("type", "hidden");
    hiddenField.setAttribute("name", "journeyDescription");
    hiddenField.setAttribute("value", journeyDescription);
    form.appendChild(hiddenField);

    // Add public to form
    hiddenField = document.createElement("input");
    hiddenField.setAttribute("type", "hidden");
    hiddenField.setAttribute("name", "public");
    hiddenField.setAttribute("value", public);
    form.appendChild(hiddenField);

    // Submit form
    document.body.appendChild(form);
    form.submit();
});


var closeBtn = document.getElementById("modal-colser");
closeBtn.addEventListener("click", function(event) {
    closeModal('save'); 
    changeValue('public', 0); 
    changeText('btn-save-journey', 'Enregistrer');
});

var openShareModal = document.getElementById("btn-modal-share");
openShareModal.addEventListener("click", function(event) {
    openModal('save'); 
    changeValue('public', 1); 
    changeText('btn-save-journey', 'Partager');
});

var openSaveModal = document.getElementById("btn-modal-save");
openSaveModal.addEventListener("click", function(event) {
    openModal('save'); 
});

function changeValue(id, value) {
	document.getElementById(id).value = value;
}
function changeText(id, value) {
	document.getElementById(id).innerHTML = value;
}

var regenerateBtn = document.getElementById("re-generate");
regenerateBtn.addEventListener("click", function(event) {
    window.location.href = "./?page=generateJourney";
}); 