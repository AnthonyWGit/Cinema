document.addEventListener("DOMContentLoaded", function() { //waiting for all content to load

  function checkFormInputsNotEmpty() {        //loop trough all the inputs
    for (var i = 0; i < inputs.length; i++) {
      if (inputs[i].value.trim() === "") {
        return false;
      }
    }
    return true;
  }

  // function isEmailValid(email)
  // {
  //   // Regular expression pattern for email validation
  //   var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  //   return emailPattern.test(email);
  // }

  // function checkEmail() 
  // {
  //   var email = emailInput.value.trim();
  //   if (!isEmailValid(email)) 
  //   {
  //     modalButton.removeAttribute("data-bs-toggle");
  //     modalButton.removeAttribute("data-bs-target");
  //   }
  // }

  function checkInputsAndToggleModal() 
  {
    if (!checkFormInputsNotEmpty()) {
      form.action = "index.php?action=checkInfosModalVide";
      iframe.src = "index.php?action=checkInfosModalVide";
      // alert("Please fill in all form fields.");
    } else {
      form.action = "index.php?action=checkInfosModal";
      iframe.src = "index.php?action=checkInfosModal"; // Set the URL here
      
    }
  }

;

  var emailInput = document.getElementById("email-input");
  const iframe = document.getElementById("iframe");
  const form = document.querySelector("#form-register");
  const modalButton = document.getElementById("password-input-confirm-modal");
  const inputs = form.querySelectorAll("input")

  form.target = "iframe"
  modalButton.addEventListener("click", checkInputsAndToggleModal);
  // modalButton.addEventListener("click", checkEmail);
  form.action = "index.php?action=checkInfosModal";
  emailInput.type = "text"

  inputs.forEach(function(input) {
    input.removeAttribute("required");
  });

});







