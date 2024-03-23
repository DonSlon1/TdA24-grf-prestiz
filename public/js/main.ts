window.addEventListener('scroll', function () {
    const header = document.getElementById('main-header');
    const p = document.querySelector('p');
    const darkModeIcon = document.getElementById('logo') as HTMLImageElement; // Přidáno pro ikonu dark mode
    const isEnabled = getCookie('theme') !== 'enabled';
    const scrollPos = window.scrollY;

    if (header == null || p == null || darkModeIcon == null) {
        return;
    }
    // Header shrink
    if (scrollPos > 50) {
        header.classList.add('shrink');

        if (isEnabled) {
            darkModeIcon.src = '/icon/TdA_sipka/png/TdA_sipka_bila.png';
        } else {
            darkModeIcon.src = '/icon/TdA_sipka/png/TdA_sipka_cerna.png';
        }
    } else {
        header.classList.remove('shrink');

        if (isEnabled) {
            darkModeIcon.src = '/icon/TdA_LOGO/TeacherDigitalAgency_LOGO_white.png';
        } else {
            darkModeIcon.src = '/icon/TdA_LOGO/TeacherDigitalAgency_LOGO_black.png';
        }
    }
});

// Dark mode function
function toggleDarkMode(isAuto = false) {
    const body = document.body;
    let isEnabled = getCookie('theme') === 'enabled';

    if (!isAuto) {
        setTheme(isEnabled ? 'disabled' : 'enabled');
    } else {
        isEnabled = !isEnabled;
    }

    body.classList.toggle('dark-mode', isEnabled);

    const darkModeIcon = document.getElementById('darkModeIcon') as HTMLImageElement;
    if (darkModeIcon) {
        darkModeIcon.src = isEnabled ? '/icon/custom/light-mode.svg' : '/icon/custom/dark-mode.svg';
    }

    const logo = document.querySelector('header img') as HTMLImageElement | null;
    const scrollPos = window.scrollY;

    if (logo) {
        if (isEnabled) {
            logo.src = scrollPos > 50 ? '/icon/TdA_sipka/png/TdA_sipka_bila.png' : '/icon/TdA_LOGO/TeacherDigitalAgency_LOGO_white.png';
        } else {
            logo.src = scrollPos > 50 ? '/icon/TdA_sipka/png/TdA_sipka_cerna.png' : '/icon/TdA_LOGO/TeacherDigitalAgency_LOGO_black.png';
        }
    }

    const imagesToUpdate = [
        ...document.getElementsByClassName("map"),
        ...document.getElementsByClassName('money'),
        document.getElementById('phone'),
        document.getElementById('email'),
        document.getElementById('submit-search'),
        document.getElementById('filter'),
        ...document.getElementsByClassName('mobileNav'),
        ...document.getElementsByClassName('arrow'),
        ...document.getElementsByClassName('github'),
        ...document.getElementsByClassName('linkedin'),
        ...document.getElementsByClassName('clock'),
    ];

    imagesToUpdate.forEach((element: Element | null) => {
        if (element instanceof HTMLImageElement) {
            element.src = isEnabled ? element.src.replace('_black.svg', '_white.svg') : element.src.replace('_white.svg', '_black.svg');
        }
    });
}


function setTheme(theme: string | null) {
    document.cookie = `theme=${theme};path=/`; // Uloží cookie na 1 rok
}

getUserPreference();
toggleDarkMode(true);

function getUserPreference() {
    if (getCookie('theme') !== undefined) return;
    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        // Uživatel má preferenci pro tmavý režim
        setTheme('disabled');
    } else {
        // Uživatel má preferenci pro světlý režim
        setTheme('enabled');
    }
    // Není zjištěna žádná preferovaná hodnota, můžete vrátit výchozí režim
}


function getCookie(name: string) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) {
        return parts.pop()?.split(';').shift();
    }
}
function toggleMobileNav() {
    const nav = document.querySelector('nav');
    if (nav == null) {
        return;
    }

    if (nav.classList.contains('active')) {
        nav.classList.remove('active');
    } else {
        nav.classList.add('active');
    }
}