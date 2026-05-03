const hamburger = document.querySelector('#toggle');

hamburger.addEventListener('click', function() {
    document.querySelector('aside').classList.toggle('expand');
    document.querySelector('header').classList.toggle('expand');
    document.querySelector('main').classList.toggle('expand');
    document.querySelector('footer').classList.toggle('expand');
});