// validate.js
function validatePassword() {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirm_password").value;

    if (password !== confirmPassword) {
        alert("Passwords do not match!");
        return false;  // Prevent form submission
    }

    // Simulate a successful registration
    showSuccessMessage();

    return false;  // Prevent form submission for this example
}

// Show password functionality
document.getElementById("show-password-btn1").addEventListener("click", function() {
    var passwordField = document.getElementById("password");
    var type = passwordField.type === "password" ? "text" : "password";
    passwordField.type = type;
    this.textContent = type === "password" ? "Show" : "Hide";
});

document.getElementById("show-password-btn2").addEventListener("click", function() {
    var passwordField = document.getElementById("confirm_password");
    var type = passwordField.type === "password" ? "text" : "password";
    passwordField.type = type;
    this.textContent = type === "password" ? "Show" : "Hide";
});


function showSuccessMessage() {
    var messageElement = document.getElementById("successMessage");
    var messageText = document.getElementById("messageText");
    messageText.textContent = "Registration Successful!";

    messageElement.style.display = "block";  

    setTimeout(function() {
        messageElement.style.display = "none";
    }, 3000);
}

function closePopup() {
    var messageElement = document.getElementById("successMessage");
    messageElement.style.display = "none";

    document.getElementById("registrationForm").reset();
}
