document.addEventListener("DOMContentLoaded", function() { //waiting for all content to load

  const iframe = document.getElementById("iframe");
  const form = document.querySelector("#form-register");
  const modalButton = document.getElementById("password-input-confirm-modal");
  var inputs = form.querySelectorAll("input");

  iframe.src = "index.php?action=checkInfos"; // Set the URL here
  form.target = "iframe"
  modalButton.addEventListener("click", checkInputsAndToggleModal);

  inputs.forEach(function(input)                  //If used has js remove required because it messes with view 
  {
    input.removeAttribute("required");
  });

});







