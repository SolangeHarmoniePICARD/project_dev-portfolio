let messageValidation = document.getElementById("message-validation")
    verifyLetter = document.getElementById("verify-letter")
    verifyCapital = document.getElementById("verify-capital")
    verifyNumber = document.getElementById("verify-number")
    verifyLength = document.getElementById("verify-length")
    verifyMatch = document.getElementById("verify-match")



inputPassword.onfocus = function() {
    messageValidation.style.display = "block"
}

inputPassword.onkeyup = function() {

    // Validate lowercase letters
    let lowerCaseLetters = /[a-z]/g;
    if(inputPassword.value.match(lowerCaseLetters)) {  
      verifyLetter.classList.remove("invalid")
      verifyLetter.classList.add("valid")
    } else {
      verifyLetter.classList.remove("valid")
      verifyLetter.classList.add("invalid")
    }
    
    // Validate capital letters
    let upperCaseLetters = /[A-Z]/g;
    if(inputPassword.value.match(upperCaseLetters)) {  
      verifyCapital.classList.remove("invalid")
      verifyCapital.classList.add("valid")
    } else {
      verifyCapital.classList.remove("valid")
      verifyCapital.classList.add("invalid")
    }
  
    // Validate numbers
    let numbers = /[0-9]/g;
    if(inputPassword.value.match(numbers)) {  
      verifyNumber.classList.remove("invalid")
      verifyNumber.classList.add("valid")
    } else {
      verifyNumber.classList.remove("valid")
      verifyNumber.classList.add("invalid")
    }
    
    // Validate length
    if(inputPassword.value.length >= 8) {
      verifyLength.classList.remove("invalid")
      verifyLength.classList.add("valid")
    } else {
      verifyLength.classList.remove("valid")
      verifyLength.classList.add("invalid")
    }

  }

  inputConfirmation.onfocus = function() {
    messageValidation.style.display = "block"
}


inputConfirmation.onkeyup = function() {
    let matchPassword = document.getElementById("input_password").value
    matchConfirmation = document.getElementById("input_pswd-confirmation").value
    // Validate match
    if(matchPassword != matchConfirmation) {
        verifyMatch.classList.remove("valid")
        verifyMatch.classList.add("invalid")
    } else {
        verifyMatch.classList.remove("invalid")
        verifyMatch.classList.add("valid")
    }

 }