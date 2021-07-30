// Nav
const navToggle = document.querySelector('#js-nav-toggle');
const nav = document.querySelector('#js-nav');
navToggle.addEventListener('click', () => {
    navToggle.classList.toggle('open');
    nav.classList.toggle('open');
});
