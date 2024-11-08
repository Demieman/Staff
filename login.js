
    // Hardcoded credentials for demonstration
    const validUsername = 'user123';
    const validPassword = 'pass123';

    document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;
        const errorMessage = document.getElementById('errorMessage');

        errorMessage.textContent = ''; // Clear previous error messages

        // Check credentials
        if (username === validUsername && password === validPassword) {
            alert('Login successful!');
            // Redirect to another page or perform further actions
            window.location.href = 'Evaluate.php';
        } else {
            errorMessage.textContent = 'Invalid username or password.';
        }
    });
