var saveBtn = document.getElementById("save-journey");

// Disable submit action on form
saveBtn.addEventListener("click", function(event) {
    event.preventDefault();

    // Get elemets with the class "active"
    var activeSteps = document.getElementsByClassName("active");
    var stepsId = [];
    for(var i = 0; i < activeSteps.length; i++) {
        stepsId.push(activeSteps[i].getElementsByTagName("input")[0].value);
    }

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

    // Submit form
    document.body.appendChild(form);
    form.submit();
});