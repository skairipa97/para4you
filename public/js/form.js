

  // Wait until the DOM is fully loaded
  document.addEventListener("DOMContentLoaded", function () {
    const forms = document.querySelectorAll(".requires-validation");

    // Loop over each form
    Array.from(forms).forEach(function (form) {
      form.addEventListener(
        "submit",
        function (event) {
          // Prevent form submission if it's invalid
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
          }

          // Add Bootstrap validation class
          form.classList.add("was-validated");
        },
        false
      );
    });
  });
