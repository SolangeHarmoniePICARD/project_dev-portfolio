let warningCapsLock = document.getElementById("warning_capsLock")

inputPassword.addEventListener("keyup", function(event) {
    if (event.getModifierState("CapsLock")) {
        warningCapsLock.style.display = "block"
    } else {
        warningCapsLock.style.display = "none"
    }
})