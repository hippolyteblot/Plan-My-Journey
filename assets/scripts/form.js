function visibility(input) {
  // Toggle the visibility of input #password
  if (input == "password") {
    var inputPass = document.getElementById("password");
    var passVisibility = document.getElementById("password-visibility");
    if (inputPass.type === "password") {
      inputPass.type = "text";
      passVisibility.innerHTML = "visibility";
    } else {
      inputPass.type = "password";
      passVisibility.innerHTML = "visibility_off";
    }
  } else if (input == "confirmPassword") {
    var inputConf = document.getElementById("password_confirm");
    var passVisibilityConf = document.getElementById(
      "password-confirm-visibility"
    );
    if (inputConf.type === "password") {
      inputConf.type = "text";
      passVisibilityConf.innerHTML = "visibility";
    } else {
      inputConf.type = "password";
      passVisibilityConf.innerHTML = "visibility_off";
    }
  }
}
