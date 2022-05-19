let messageValidation = document.getElementById("message-validation")

inputPassword.onfocus = function() {
    messageValidation.style.display = "block"
}

inputPassword.onkeyup = function() {

    // Validate not empty
    let fieldPassword = document.forms["form_registration"]["data_password"].value
        verifyEmpty = document.getElementById("verify-empty")
    if (fieldPassword == "") {
      verifyEmpty.classList.remove("valid")
      verifyEmpty.classList.add("invalid")
    } else {
      verifyEmpty.classList.remove("invalid")
      verifyEmpty.classList.add("valid")
    }

    // Validate lowercase letters
    let lowerCaseLetters = /[a-z]/g
        verifyLetter = document.getElementById("verify-letter")
    if(inputPassword.value.match(lowerCaseLetters)) {  
      verifyLetter.classList.remove("invalid")
      verifyLetter.classList.add("valid")
    } else {
      verifyLetter.classList.remove("valid")
      verifyLetter.classList.add("invalid")
    }
    
    // Validate capital letters
    let upperCaseLetters = /[A-Z]/g
        verifyCapital = document.getElementById("verify-capital")
    if(inputPassword.value.match(upperCaseLetters)) {  
      verifyCapital.classList.remove("invalid")
      verifyCapital.classList.add("valid")
    } else {
      verifyCapital.classList.remove("valid")
      verifyCapital.classList.add("invalid")
    }
  
    // Validate numbers
    let numbers = /[0-9]/g
        verifyNumber = document.getElementById("verify-number")
    if(inputPassword.value.match(numbers)) {  
      verifyNumber.classList.remove("invalid")
      verifyNumber.classList.add("valid")
    } else {
      verifyNumber.classList.remove("valid")
      verifyNumber.classList.add("invalid")
    }

    // Validate length
    let verifyLength = document.getElementById("verify-length")
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
        verifyMatch = document.getElementById("verify-match")
    // Validate match
    if(matchPassword != matchConfirmation) {
        verifyMatch.classList.remove("valid")
        verifyMatch.classList.add("invalid")
    } else {
        verifyMatch.classList.remove("invalid")
        verifyMatch.classList.add("valid")
    }
}


