function validateRegistration() {
    var password = document.forms["registrationForm"]["password"].value;
    if (password.length < 6) {
        alert("Password must be at least 6 characters long.");
        return false;
    }
    return true;
}

function validateLogin() {
    var email = document.forms["loginForm"]["email"].value;
    var password = document.forms["loginForm"]["password"].value;
    if (email == "" || password == "") {
        alert("Both fields are required.");
        return false;
    }
    return true;
}

function validateFeedback() {
    var tags = document.forms["feedbackForm"]["tags"].value;
    var feedback = document.forms["feedbackForm"]["feedback"].value;
    if (tags == "" || feedback == "") {
        alert("Both fields are required.");
        return false;
    }
    return true;
}
