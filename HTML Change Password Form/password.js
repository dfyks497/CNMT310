// Collaboration, refrences, and citations:: The code below is a combination of resources and collaboration with Ethan Ostopowicz
// Comparing two input fields. (n.d.). Stack Overflow. Retrieved September 27, 2023, from https://stackoverflow.com/questions/12058081/comparing-two-input-fields
// HTML DOM Element AddEventListener() Method. (n.d.). W3 Schools. Retrieved September 27, 2023, from https://www.w3schools.com/jsref/met_element_addeventlistener.asp
// JavaScript String concat() Method. (n.d.). W3 Schools. Retrieved September 27, 2023, from https://www.w3schools.com/jsref/jsref_concat_string.asp
// PreventDefault() event Method. (n.d.). W3 Schools. Retrieved September 27, 2023, from https://www.w3schools.com/jsref/event_preventdefault.asp

document.getElementById("password-form").addEventListener("submit", function (submit) {
    const newPassword = document.getElementById("new-password").value;
    const confirmPassword = document.getElementById("confirm-password").value;
    let warningMessage = "";

    if (newPassword != confirmPassword) {
        warningMessage = warningMessage.concat("Password entries do not match! \n")
    }

    if (newPassword.length < 4 || newPassword.length > 8 || confirmPassword.length < 4 || confirmPassword.length > 8) {
        warningMessage = warningMessage.concat("Password length must be at least 4 characters, and no greater than 8 characters! \n")
    }

    if (!/[A-Z]/.test(newPassword) || !/[A-Z]/.test(confirmPassword)) {
        warningMessage = warningMessage.concat("Password must include an uppercase character! \n")
    }

    if (!/\d/.test(newPassword) || !/\d/.test(confirmPassword)) {
        warningMessage = warningMessage.concat("Password must include a numerical character! \n")
    }

    if (warningMessage != "") {
        document.getElementById("warning-message").innerText = warningMessage;
        submit.preventDefault();
    }

    else {
        alert("Password successfully changed!")
    }
});