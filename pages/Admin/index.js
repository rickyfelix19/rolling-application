const emailInput = document.getElementById('email');
const passwordInput = document.getElementById('password');

emailInput.addEventListener('input', function (event) {
  const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  if (regex.test(emailInput.value)) {
    event.preventDefault(); // Prevents the form from submitting
    console.log('Valid input!');
  } else {
    alert('Invalid input! Please enter at least 6 numeric value.');
    return false;
  }
});

passwordInput.addEventListener('input', function (event) {
  const regex = /^\d{6}$/;
  if (regex.test(emailInput.value)) {
    event.preventDefault(); // Prevents the form from submitting
    console.log('Valid input!');
  } else {
    alert('Invalid input! Please enter at least 6 numeric value.');
    return false;
  }
});
