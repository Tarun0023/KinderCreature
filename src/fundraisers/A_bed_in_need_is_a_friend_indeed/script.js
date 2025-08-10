const campaignCards = document.getElementById('campaign-cards');
const slideLeft = document.getElementById('slide-left');
const slideRight = document.getElementById('slide-right');

slideRight.addEventListener('click', () => {
    campaignCards.scrollBy({ left: 320, behavior: 'smooth' });
});

slideLeft.addEventListener('click', () => {
    campaignCards.scrollBy({ left: -320, behavior: 'smooth' });
});
