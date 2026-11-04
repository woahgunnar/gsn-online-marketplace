"use strict";

// Get form elements
const form = document.querySelector(".registration_form");
const response = document.getElementById("registration_response");

const username = document.getElementById("username");
const email = document.getElementById("email");
const phone = document.getElementById("phone");
const password = document.getElementById("password");
const confirmPassword = document.getElementById("confirmPassword");

// Display response messages
function showResponse(message) {
    response.textContent = message;
}

// Validate form submission
form.addEventListener("submit", function(event) {

    // Prevent page reload
    event.preventDefault();

    // Clear previous response
    showResponse("");

    // Username validation
    if (username.value.trim().length < 3 ||
        username.value.trim().length > 24) {

        showResponse("Username must be between 3 and 24 characters.");
        username.focus();
        return;
    }

    // Email validation
    if (!email.validity.valid) {
        showResponse("Please enter a valid email address.");
        email.focus();
        return;
    }

    // Optional phone validation
    if (phone.value.trim() !== "" &&
        !/^\+?[0-9\s().-]{7,20}$/.test(phone.value.trim())) {

        showResponse("Please enter a valid phone number.");
        phone.focus();
        return;
    }

    // Password validation
    if (password.value.length < 8) {
        showResponse("Password must contain at least 8 characters.");
        password.focus();
        return;
    }

    // Confirm password validation
    if (password.value !== confirmPassword.value) {
        showResponse("Passwords do not match.");
        confirmPassword.focus();
        return;
    }

    // Check remaining required fields
    if (!form.checkValidity()) {
        showResponse("Please complete all required fields.");
        form.reportValidity();
        return;
    }

    // Successful registration
    const enteredUsername = username.value.trim();

    showResponse(
        "Thou hast been Aſſayed as Gold and thy merit in filling out internet forms astounds! " +
        enteredUsername + ", we welcome thee to our Kingdom!!!"
    );

    // Reset form after successful submission
    form.reset();

});