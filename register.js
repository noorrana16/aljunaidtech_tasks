
document.getElementById("registerForm").addEventListener("submit", function (event) {
    event.preventDefault(); // Form ko submit hone se roknay ke liye
  
    let fullName = document.getElementById("fullName").value.trim();
    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value.trim();
    let confirmPassword = document.getElementById("confirmPassword").value.trim();
    let isValid = true;
//Submit button disable ke liye
    /*document.getElementById("registerForm").addEventListener("input", function () {
      let isValid = document.getElementById("fullName").value.trim() !== "" &&
                    document.getElementById("email").value.trim() !== "" &&
                    document.getElementById("password").value.length >= 6 &&
                    document.getElementById("confirmPassword").value === document.getElementById("password").value;
    
      //document.getElementById("submitBtn").disabled = !isValid;
      document.getElementById("submitBtn").disabled = false;

    });*/
    // Full Name Validation
    if (fullName === "") {
      document.getElementById("nameError").innerText = "Full name is required";
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
  
    // Password Validation
    if (password.length < 6) {
      document.getElementById("passwordError").innerText = "Password must be at least 6 characters";
      isValid = false;
    } else {
      document.getElementById("passwordError").innerText = "";
    }
  
    // Confirm Password Validation
    if (confirmPassword !== password) {
      document.getElementById("confirmPasswordError").innerText = "Passwords do not match";
      isValid = false;
    } else {
      document.getElementById("confirmPasswordError").innerText = "";
    }
  
    // If Validation Passes
    if (isValid) {
      Swal.fire({
        title: "Registration Successful!",
        text: "You have been registered successfully.",
        icon: "success",
        confirmButtonText: "OK"
      });
  
      // Form Reset
      document.getElementById("registerForm").reset();
    }
    
  });