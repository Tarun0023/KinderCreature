document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('checkoutForm');
    const inputs = form.querySelectorAll('input, select');

    // Add floating label behavior
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            if (this.value) {
                this.classList.add('has-value');
            } else {
                this.classList.remove('has-value');
            }
        });
    });

    // Form validation
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (validateForm()) {
            // Process checkout
            console.log('Processing checkout...');
            alert('Form submitted successfully!');
        }
    });

    // Back button handler
    document.querySelector('.back-btn').addEventListener('click', () => {
        console.log('Returning to cart...');
        // Add logic to return to cart page
    });

    function validateForm() {
        let isValid = true;
        const email = document.getElementById('email');
        const contactNo = document.getElementById('contactNo');
        const zipcode = document.getElementById('zipcode');

        // Email validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email.value)) {
            showError(email, 'Please enter a valid email address');
            isValid = false;
        }

        // Contact number validation
        const phoneRegex = /^\d{10}$/;
        if (!phoneRegex.test(contactNo.value.replace(/\D/g, ''))) {
            showError(contactNo, 'Please enter a valid 10-digit phone number');
            isValid = false;
        }

        // Zipcode validation
        const zipcodeRegex = /^\d{6}$/;
        if (!zipcodeRegex.test(zipcode.value)) {
            showError(zipcode, 'Please enter a valid 6-digit zipcode');
            isValid = false;
        }

        return isValid;
    }

    function showError(input, message) {
        const formGroup = input.parentElement;
        const error = formGroup.querySelector('.error-message') || document.createElement('div');
        error.className = 'error-message';
        error.textContent = message;
        error.style.color = 'red';
        error.style.fontSize = '0.8rem';
        error.style.marginTop = '0.25rem';
        
        if (!formGroup.querySelector('.error-message')) {
            formGroup.appendChild(error);
        }
        
        input.style.borderColor = 'red';

        input.addEventListener('input', function() {
            input.style.borderColor = '';
            if (error.parentElement) {
                error.remove();
            }
        });
    }
});

