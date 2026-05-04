document.addEventListener('DOMContentLoaded', function () {
    var menus = document.querySelectorAll('[data-account-menu]');

    if (!menus.length) {
        return;
    }

    // ferme tous les menus et remet l'accessibilite a jour
    var closeAllMenus = function () {
        menus.forEach(function (menu) {
            var trigger = menu.querySelector('[data-account-trigger]');
            menu.classList.remove('is-open');
            if (trigger) {
                trigger.setAttribute('aria-expanded', 'false');
            }
        });
    };

    menus.forEach(function (menu) {
        var trigger = menu.querySelector('[data-account-trigger]');

        if (!trigger) {
            return;
        }

        // toggle du menu du compte
        trigger.addEventListener('click', function (event) {
            event.preventDefault();
            var wasOpen = menu.classList.contains('is-open');

            closeAllMenus();

            if (!wasOpen) {
                menu.classList.add('is-open');
                trigger.setAttribute('aria-expanded', 'true');
            }
        });
    });

    // clic hors menu: fermeture
    document.addEventListener('click', function (event) {
        var clickedInsideMenu = false;

        menus.forEach(function (menu) {
            if (menu.contains(event.target)) {
                clickedInsideMenu = true;
            }
        });

        if (!clickedInsideMenu) {
            closeAllMenus();
        }
    });

    // echap: fermeture rapide
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeAllMenus();
        }
    });
});
