document.addEventListener('DOMContentLoaded', function () {

    const welcomeCard = document.querySelector('.dashboard-welcome');

    if (welcomeCard) {
        welcomeCard.style.opacity = '0';
        welcomeCard.style.transform = 'translateY(10px)';

        setTimeout(function () {
            welcomeCard.style.transition = 'all .5s ease';
            welcomeCard.style.opacity = '1';
            welcomeCard.style.transform = 'translateY(0)';
        }, 100);
    }

    const featureCards = document.querySelectorAll('.feature-card');

    featureCards.forEach(function (card, index) {
        card.style.opacity = '0';
        card.style.transform = 'translateY(15px)';

        setTimeout(function () {
            card.style.transition = 'all .4s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, 150 + (index * 100));
    });

    const infoItems = document.querySelectorAll('.info-item');

    infoItems.forEach(function (item, index) {
        item.style.opacity = '0';
        item.style.transform = 'translateY(10px)';

        setTimeout(function () {
            item.style.transition = 'all .4s ease';
            item.style.opacity = '1';
            item.style.transform = 'translateY(0)';
        }, 500 + (index * 100));
    });

});