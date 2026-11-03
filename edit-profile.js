const usernameDialog = document.getElementById("username-dialog");
const usernameForm = document.getElementById("username-form");
const usernameMessage = document.getElementById("username-message");
const newUsername = document.getElementById("new-username");
const changeUsernameButton = document.getElementById("change-username");
const confirmUsernameButton = document.getElementById("confirm-username");
const cancelUsernameButton = document.getElementById("cancel-username");

changeUsernameButton.addEventListener("click", function () {
  usernameDialog.showModal();
});

confirmUsernameButton.addEventListener("click", function () {
  alert("Saving username changes is not available yet.");
  usernameDialog.close();
});

cancelUsernameButton.addEventListener("click", function () {
  // reset the form to avoid previous messages from appearing when reopening the dialog
  usernameForm.reset();
  usernameMessage.textContent = "";

  usernameDialog.close();
});

usernameForm.addEventListener("input", function () {
  if (newUsername.validity.valueMissing) {
    usernameMessage.textContent = "Username cannot be empty.";
  } else if (newUsername.validity.tooShort) {
    usernameMessage.textContent = "Username must be at least 3 characters.";
  } else if (newUsername.validity.tooLong) {
    usernameMessage.textContent = "Username cannot be more than 20 characters.";
  } else if (newUsername.validity.patternMismatch) {
    usernameMessage.textContent =
      "Username can only contain letters, numbers, and underscores.";
  } else {
    usernameMessage.textContent = "Username is good to go!";
  }
});
