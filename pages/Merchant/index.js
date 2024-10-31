const storeInput = document.getElementById('storename');
const passwordInput = document.getElementById('password');

storeInput.addEventListener('input', function (event) {
  const regex = /^.{2,}$/;
  if (regex.test(storeInput)) {
    event.preventDefault(); // Prevents the form from submitting
    console.log('Valid input!');
  } else {
    alert('Invalid input! Please enter at least 2 characters.');
    return false; // Prevent form submission if invalid
  }
});

passwordInput.addEventListener('input', function (event) {
  const regex = /^\d{6}$/;

  if (regex.test(passwordInput)) {
    event.preventDefault(); // Prevents the form from submitting
    console.log('Valid input!');
  } else {
    alert('Invalid input! Please enter at least 6 numeric value.');
    return false; // Prevent form submission if invalid
  }
});
