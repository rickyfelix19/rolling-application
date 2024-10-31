const pinInput = document.getElementById('pinnumber');
const phoneInput = document.getElementById('phonenumber');

pinInput.addEventListener('input', function (event) {
  const regex = /^\d{4}$/;
  if (regex.test(pinInput.value)) {
    event.preventDefault(); // Prevents the form from submitting
    console.log('Valid input!');
  } else {
    alert('Invalid input! Please enter at least 4 numeric value.');
    return false; // Prevent form submission if invalid
  }
});

phoneInput.addEventListener('input', function (event) {
  const regex = /^628\d{10,14}$/;
  if (regex.test(phoneInput)) {
    event.preventDefault(); // Prevents the form from submitting
    console.log('Valid input!');
  } else {
    alert('Invalid input! Please enter at least 2 characters.');
    return false; // Prevent form submission if invalid
  }
});
