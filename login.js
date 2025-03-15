document.getElementById("loginForm").addEventListener("submit", function (event) {
    event.preventDefault(); // Form ko submit hone se roknay ke liye
  
    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value.trim();
  
    let isValid = true;
  
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
    document.getElementById("togglePassword").addEventListener("click", function () {
        let passwordInput = document.getElementById("password");
        passwordInput.type = passwordInput.type === "password" ? "text" : "password";
      });
  
    // If Validation Passes
    if (isValid) {
      Swal.fire({
        title: "Login Successful!",
        text: "You have logged in successfully.",
        icon: "success",
        confirmButtonText: "OK"
      });
  
      // Form Reset
      document.getElementById("loginForm").reset();
    }
    
  });