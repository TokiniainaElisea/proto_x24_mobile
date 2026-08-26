document.querySelectorAll('.modal input, .modal textarea, .modal select').forEach(element => {
    element.addEventListener('focus', function() {
        setTimeout(() => {
            this.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }, 300); // Léger délai pour attendre que le clavier soit totalement affiché, on sait jamais
    });
});
