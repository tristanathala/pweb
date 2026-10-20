function resetErrors() {
  ["name", "address", "email", "password", "subject", "agree"].forEach(function (id) {
    document.getElementById(id + "-error").textContent = "";
  });
}

function validateForm() {
  var name = document.getElementById("name").value.trim();
  var addr = document.getElementById("address").value.trim();
  var email = document.getElementById("email").value.trim();
  var pass = document.getElementById("password").value;
  var sub = document.getElementById("subject").value;
  var agree = document.getElementById("agree").checked;

  resetErrors();
  var valid = true;

  if (name === "" || /\d/.test(name)) {
    document.getElementById("name-error").textContent = "Please enter your name properly.";
    valid = false;
  }
  if (addr === "") {
    document.getElementById("address-error").textContent = "Please enter your address.";
    valid = false;
  }
  if (email === "" || email.indexOf("@") === -1 || email.indexOf(".") === -1) {
    document.getElementById("email-error").textContent = "Please enter a valid email address.";
    valid = false;
  }
  if (pass === "" || pass.length < 6) {
    document.getElementById("password-error").textContent = "Please enter a password with at least 6 characters.";
    valid = false;
  }
  if (sub === "") {
    document.getElementById("subject-error").textContent = "Please select your course.";
    valid = false;
  }
  if (!agree) {
    document.getElementById("agree-error").textContent = "Please agree to the above information.";
    valid = false;
  }

  if (valid) {
    alert("Form submitted successfully!");
  }
  return false;
}

function validateEmail() {
  var email = document.getElementById("emailInput").value.trim();
  var msg = document.getElementById("emailMsg");
  var regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

  if (email === "") {
    msg.textContent = "Email tidak boleh kosong";
    msg.style.color = "red";
  } else if (regex.test(email)) {
    msg.textContent = "Email valid";
    msg.style.color = "green";
  } else {
    msg.textContent = "Email tidak valid";
    msg.style.color = "red";
  }
}
