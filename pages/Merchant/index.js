function validateStorename() {
  const input = document.getElementById('storename').value;

  const regex = /^.{2,}$/;
  if (regex.test(input)) {
    alert('Valid input!');
  } else {
    alert('Invalid input! Please enter at least 2 characters.');
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
