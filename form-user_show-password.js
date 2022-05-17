let inputPassword = document.getElementById("input_password")
document.getElementById("input_show-password").addEventListener('click', function() {
  if (inputPassword.type === "password") {
    inputPassword.type = "text"
  } else {
    inputPassword.type = "password"
  }
})
