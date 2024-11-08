
    // Function to load evaluations from localStorage
    function loadEvaluations() {
        const evaluationsContainer = document.getElementById('evaluations');
        evaluationsContainer.innerHTML = ''; // Clear existing content
        const evaluations = JSON.parse(localStorage.getItem('evaluations')) || [];

        if (evaluations.length === 0) {
            evaluationsContainer.innerHTML = '<p>No evaluations submitted yet.</p>';
            return;
        }

        evaluations.forEach(eval => {
            const evalItem = document.createElement('div');
            evalItem.classList.add('evaluation-item');
            evalItem.innerHTML = `
                <strong>Name:</strong> ${eval.staffName}<br>
                <strong>Position:</strong> ${eval.position}<br>
                <strong>Rating:</strong> ${eval.performanceRating}<br>
                <strong>Comments:</strong> ${eval.comments}
            `;
            evaluationsContainer.appendChild(evalItem);
        });
    }

    // Load evaluations on page load
    window.onload = loadEvaluations;

    // Handle form submission
    document.getElementById('evaluationForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const staffName = document.getElementById('staffName').value;
        const position = document.getElementById('position').value;
        const performanceRating = document.getElementById('performanceRating').value;
        const comments = document.getElementById('comments').value;
        const successMessage = document.getElementById('successMessage');

        // Create evaluation object
        const evaluation = {
            staffName,
            position,
            performanceRating,
            comments
        };

        // Save evaluation to localStorage
        const evaluations = JSON.parse(localStorage.getItem('evaluations')) || [];
        evaluations.push(evaluation);
        localStorage.setItem('evaluations', JSON.stringify(evaluations));

        successMessage.textContent = 'Evaluation submitted successfully for ' + staffName + '!';
        successMessage.style.color = 'green';

        // Reset the form
        this.reset();

        // Load updated evaluations
        loadEvaluations();
    });
