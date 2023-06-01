document.addEventListener("DOMContentLoaded", function() { //waiting for all content to load

  function checkFormInputsNotEmpty() {        //loop trough all the inputs
    for (var i = 0; i < inputs.length; i++) {
      if (inputs[i].value.trim() === "") {
        return false;
      }
    }
    return true;
  }

  function checkInputsAndToggleModal() {
    if (!checkFormInputsNotEmpty()) {
      // alert("Please fill in all form fields.");
    } else {
      iframe.src = "index.php?action=checkInfos"; // Set the URL here
    }
  }

;
  const iframe = document.getElementById("iframe");
  const form = document.querySelector("#form-register");
  const modalButton = document.getElementById("password-input-confirm-modal");
  const inputs = form.querySelectorAll("input")

  form.target = "iframe"
  modalButton.addEventListener("click", checkInputsAndToggleModal);

  inputs.forEach(function(input) {
    input.removeAttribute("required");
  });

});







