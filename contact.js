
document.getElementById("contactForm").addEventListener("submit", function (event) {
    event.preventDefault(); // Form submit hone se roke ga
  
    let name = document.getElementById("name").value.trim();
    let email = document.getElementById("email").value.trim();
    let subject = document.getElementById("subject").value.trim();
    let message = document.getElementById("message").value.trim();
  
    let isValid = true;
  
    // Name Validation
    if (name === "") {
      document.getElementById("nameError").innerText = "Name is required";
      isValid = false;
    } else {
      document.getElementById("nameError").innerText = "";
    }
  
    // Email Validation
    if (email === "") {
      document.getElementById("emailError").innerText = "Email is required";
      isValid = false;
    } else if (!/^\S+@\S+\.\S+$/.test(email)) {
      document.getElementById("emailError").innerText = "Invalid email format";
      isValid = false;
    } else {
      document.getElementById("emailError").innerText = "";
    }
  
    // Subject Validation
    if (subject === "") {
      document.getElementById("subjectError").innerText = "Subject is required";
      isValid = false;
    } else {
      document.getElementById("subjectError").innerText = "";
    }
  
    // Message Validation
    if (message === "") {
      document.getElementById("messageError").innerText = "Message is required";
      isValid = false;
    } else {
      document.getElementById("messageError").innerText = "";
    }
  
    // If All Validations Pass
    if (isValid) {
      Swal.fire({
        title: "Thanks for Contacting!",
        text: "Your message has been submitted successfully.",
        icon: "success",
        confirmButtonText: "OK"
      });
  
      // Form Reset
      document.getElementById("contactForm").reset();
    }
  });