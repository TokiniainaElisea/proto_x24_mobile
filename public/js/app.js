(function () {
    function scrollFocusedIntoView(el) {
        if (!el) return;

        // Attendre l'animation du clavier (Android ~250–400ms)
        setTimeout(() => {
            el.scrollIntoView({
                behavior: 'smooth',
                block: 'center',
                inline: 'nearest'
            });

            // Second passage si le clavier a encore bougé le layout
            setTimeout(() => {
                el.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center',
                    inline: 'nearest'
                });
            }, 150);
        }, 350);
    }

    document.addEventListener('focusin', function (e) {
        const t = e.target;
        if (!t) return;

        const tag = t.tagName;
        if (tag === 'INPUT' || tag === 'TEXTAREA' || tag === 'SELECT') {
            // ignore types non texte
            if (t.type === 'checkbox' || t.type === 'radio' || t.type === 'file' || t.type === 'button' || t.type === 'submit') {
                return;
            }
            scrollFocusedIntoView(t);
        }
    }, true);

    // Android : le viewport change quand le clavier s'ouvre
    if (window.visualViewport) {
        window.visualViewport.addEventListener('resize', function () {
            const el = document.activeElement;
            if (el && (el.tagName === 'INPUT' || el.tagName === 'TEXTAREA' || el.tagName === 'SELECT')) {
                scrollFocusedIntoView(el);
            }
        });
    }
})();

