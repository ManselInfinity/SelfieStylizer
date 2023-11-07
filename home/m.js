const showMenu = document.getElementById('show-menu');
const navMenu = document.getElementById('nav-menu');

showMenu.addEventListener('click', function() {
    navMenu.classList.toggle('active');
});