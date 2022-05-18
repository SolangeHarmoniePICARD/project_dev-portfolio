let inputPassword = document.getElementById("input_password")
    inputConfirmation = document.getElementById("input_pswd-confirmation")

document.getElementById("input_show-password").addEventListener('click', function() {
  if (inputPassword.type === "password") {
    inputPassword.type = "text"
  } else {
    inputPassword.type = "password"
  }
})

document.getElementById("input_show-confirmation").addEventListener('click', function() {
  if (inputConfirmation.type === "password") {
    inputConfirmation.type = "text"
  } else {
    inputConfirmation.type = "password"
  }
})
