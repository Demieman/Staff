
document.addEventListener("DOMContentLoaded", function() {
    // Get the form and input elements
    const form = document.querySelector("form");
    const scoreInput = document.querySelector('input[name="score"]');
    
    // Add an event listener for form submission
    form.addEventListener("submit", function(event) {
        // Validate score input
        const score = parseFloat(scoreInput.value);
        if (score < 0 || score > 100) {
            alert("Please enter a score between 0 and 100.");
            event.preventDefault(); // Prevent form submission
            return;
        }
    });

    // Optional: Add instant feedback for score input
    scoreInput.addEventListener("input", function() {
        const score = parseFloat(scoreInput.value);
        if (score < 0 || score > 100) {
            scoreInput.style.borderColor = "red";
        } else {
            scoreInput.style.borderColor = "";
        }
    });
});