var form = document.querySelector("#form-register");
var modalButton = document.getElementById("password-input-confirm-modal");

modalButton.addEventListener("click", function(event) {
  // Prevent the default behavior of the button click
  event.preventDefault();

  // Perform form validation before showing the modal
  if (isFormValid()) {
    // Set the target attribute of the form to the iframe
    form.setAttribute("target", "iframe");
    // Submit the form
    form.submit();
    // Trigger the modal
    var modal = new bootstrap.Modal(document.getElementById("exampleModal"));
    modal.show();
  }
});

function isFormValid() {
    var inputs = form.querySelectorAll("input[required]");
    var isValid = true;
  
    inputs.forEach(function(input) {
      if (input.value.trim() === "") { //must be stricly equal to empty 
        isValid = false;
      }
    });
  
    return isValid;
  }
