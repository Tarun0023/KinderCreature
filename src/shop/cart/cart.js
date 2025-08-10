// DOM Elements
const cartItems = document.querySelectorAll('.cart-item');
const totalItemsElement = document.getElementById('total-items');
const itemsTotalElement = document.getElementById('items-total');
const totalPriceElement = document.getElementById('total-price');
const backButton = document.querySelector('.back-btn');
const checkoutButton = document.querySelector('.checkout-btn');

const SHIPPING_COST = 300;

// Utility functions
function formatPrice(price) {
    return `₹ ${price}`;
}

function getItemPrice(cartItem) {
    const priceText = cartItem.querySelector('.item-price').textContent;
    return parseInt(priceText.replace('₹', '').trim());
}

function updateItemPrice(cartItem) {
    const basePrice = getItemPrice(cartItem) / parseInt(cartItem.querySelector('.quantity').textContent);
    const quantity = parseInt(cartItem.querySelector('.quantity').textContent);
    cartItem.querySelector('.item-price').textContent = formatPrice(basePrice * quantity);
}

function calculateTotals() {
    let totalItems = 0;
    let itemsTotal = 0;

    cartItems.forEach(item => {
        if (item.style.display !== 'none') {
            const quantity = parseInt(item.querySelector('.quantity').textContent);
            totalItems += quantity;
            itemsTotal += getItemPrice(item);
        }
    });

    const totalPrice = itemsTotal + SHIPPING_COST;

    totalItemsElement.textContent = totalItems;
    itemsTotalElement.textContent = formatPrice(itemsTotal);
    totalPriceElement.textContent = formatPrice(totalPrice);
}

// Add event listeners to all cart items
cartItems.forEach(cartItem => {
    const minusBtn = cartItem.querySelector('.minus');
    const plusBtn = cartItem.querySelector('.plus');
    const removeBtn = cartItem.querySelector('.remove-btn');
    const quantitySpan = cartItem.querySelector('.quantity');

    minusBtn.addEventListener('click', () => {
        let quantity = parseInt(quantitySpan.textContent);
        if (quantity > 1) {
            quantitySpan.textContent = quantity - 1;
            updateItemPrice(cartItem);
            calculateTotals();
        }
    });

    plusBtn.addEventListener('click', () => {
        let quantity = parseInt(quantitySpan.textContent);
        quantitySpan.textContent = quantity + 1;
        updateItemPrice(cartItem);
        calculateTotals();
    });

    removeBtn.addEventListener('click', () => {
        cartItem.style.display = 'none';
        calculateTotals();
    });
});

// Event listeners for back and checkout buttons
backButton.addEventListener('click', () => {
    console.log('Back button clicked');
});

checkoutButton.addEventListener('click', () => {
    console.log('Checkout button clicked');
});