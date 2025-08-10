const donationInput = document.getElementById('donation');
const amountDisplay = document.getElementById('amountDisplay');

// Update the displayed amount on input
donationInput.addEventListener('input', () => {
    const value = donationInput.value;
    amountDisplay.textContent = `Entered Amount: ₹${value || 0}`; // Default to ₹0
});