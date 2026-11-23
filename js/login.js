// this is only to display an error message
// when the entered credentials don't exist

"use strict";

const error = new URLSearchParams(window.location.search).get("error");
const errorMessage = document.getElementById("login-error");

if (error === "invalid") {
  errorMessage.textContent = "Invalid email or password.";
}
