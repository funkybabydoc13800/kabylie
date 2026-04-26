// script.js

// Récupère les éléments
const burgerIcon = document.getElementById('burger-icon');
const menu = document.getElementById('menu');

// Ajoute un écouteur d'événement au clic
burgerIcon.addEventListener('click', () => {
    // Basculer la classe "active" pour afficher ou masquer le menu
    menu.classList.toggle('active');
});

// Styles pour afficher le menu lorsque la classe "active" est présente