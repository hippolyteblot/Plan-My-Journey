//addEventListeners on input04 classname, event is input, function is anonymous function
//check if password is valid
//if password is less than 8 characters, set red border-box
//else, set custom validity to empty string
const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
const passwordDiv = document.getElementsByClassName("item04")[0];
const passwordInput = document.getElementById("password1");
passwordDiv.addEventListener("input", function () {
	//check if passwordDiv is valid
	passwordDiv.style.borderRadius = "100px";
	if (passwordRegex.test(passwordInput.value)) {
		passwordDiv.style.border = "2px solid #4FCA78";
	} else {
		passwordDiv.style.border = "2px solid #E94E4E";
	}
});

//check is confirm password is the same than the first one
//if not, set red border-box
//else, set custom validity to empty string
const confirmPasswordDiv = document.getElementsByClassName("item05")[0];
const confirmPasswordInput = document.getElementById("password2");
confirmPasswordDiv.addEventListener("input", function () {
	confirmPasswordDiv.style.borderRadius = "100px";
	if (passwordInput.value === confirmPasswordInput.value) {
		confirmPasswordDiv.style.border = "2px solid #4FCA78";
	} else {
		confirmPasswordDiv.style.border = "2px solid #E94E4E";
	}
});

//check if email is valid
//if not, set red border-box
//else, set custom validity to empty string
const emailRegex =
	/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
const emailDiv = document.getElementsByClassName("item03")[0];
const emailInput = document.getElementById("email");
emailDiv.addEventListener("input", function () {
	emailDiv.style.borderRadius = "100px";
	if (emailRegex.test(emailInput.value)) {
		emailDiv.style.border = "2px solid #4FCA78";
	} else {
		emailDiv.style.border = "2px solid #E94E4E";
	}
});
