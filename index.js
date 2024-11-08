document.getElementById('registrationForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    const errorMessage = document.getElementById('errorMessage');

    errorMessage.textContent = ''; // Clear previous error messages

    // Check if passwords match
    if (password !== confirmPassword) {
        errorMessage.textContent = 'Passwords do not match.';
        return;
    }

    // Check if username is already taken
    const existingUser = localStorage.getItem(username);
    if (existingUser) {
        errorMessage.textContent = 'Username already taken.';
        return;
    }

    // Save user data to local storage
    const userData = { email, password };
    localStorage.setItem(username, JSON.stringify(userData));

    alert('Registration successful!');
    // Redirect to login page or another action
    window.location.href = 'Evaluate.php';
});