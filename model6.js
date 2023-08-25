const wrapper = document.querySelector('.wrapper');
const loginLink = document.querySelector('.login-link'); // Corrected variable name
const registerLink = document.querySelector('.register-link'); // Corrected variable name
const btnPopup = document.querySelector('.btnlogin-popup');
const iconClose = document.querySelector('.icon-close');

registerLink.addEventListener('click', () => { // Corrected variable name
    wrapper.classList.add('active');
});

loginLink.addEventListener('click', () => { // Corrected variable name
    wrapper.classList.remove('active'); // Corrected class name
});

btnPopup.addEventListener('click', () => {
    wrapper.classList.add('active-popup'); // Removed the dot before 'active-popup'
});

iconClose.addEventListener('click', () => {
    wrapper.classList.remove('active-popup'); // Removed the dot before 'active-popup'
});
