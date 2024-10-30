function validateEmail() {
  const input = document.getElementById('adminlogin').value;

  const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

  if (regex.test(input)) {
    alert('Valid input!');
  } else {
    alert('Invalid input! Please enter the proper email address');
    return false; // Prevent form submission if invalid
  }
}

function validatePassword() {
  const input = document.getElementById('password').value;

  const regex = /^\d{6}$/;

  if (regex.test(input)) {
    alert('Valid input!');
  } else {
    alert('Invalid input! Please enter at least 6 numeric value.');
    return false; // Prevent form submission if invalid
  }
}
