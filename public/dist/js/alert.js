// Show the alert message
var alertMessage = document.getElementById("alertMessage");
alertMessage.style.display = "block";

// Set a timeout to hide the alert message after x seconds
setTimeout(function () {
    alertMessage.style.display = "none";
}, 3000); // Change 3000 to the duration in milliseconds (e.g., 3000 for 3 seconds)
