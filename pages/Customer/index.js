function validatePINNumber() {
  const input = document.getElementById('pinnumber').value;

  const regex = /^\d{4}$/;

  if (regex.test(input)) {
    alert('Valid input!');
  } else {
    alert('Invalid input! Please enter at least 4 numeric value.');
    return false; // Prevent form submission if invalid
  }
}

function validatePhoneNumber() {
  const input = document.getElementById('phonenumber').value;

  const regex = /^628\d{10,14}$/;
  if (regex.test(input)) {
    alert('Valid input!');
  } else {
    alert('Invalid input! Please enter at least 2 characters.');
    return false; // Prevent form submission if invalid
  }
}
