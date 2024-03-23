<header id="main-header">


    <a href="/"> <img id="logo" src="/icon/TdA_LOGO/TeacherDigitalAgency_LOGO_black.png" alt="TdA_LOGO"></a>

    <button id="mobileNavToggle" onclick="toggleMobileNav()">
        <img src="/icon/custom/menu_black.svg" class="mobileNav" alt="Mobile-nav-toggle">
    </button>

    <nav>
        <div>
            <a class="nav-link" href="/">Domů</a>
            <a class="nav-link" href="/aktivity">Lektoři</a>
            <!--<a class="nav-link" href="/o-nas">O nás</a>-->

            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != null): ?>
                <a class="small button" href="/logout">Odhlásit</a>
            <?php endif; ?>
        </div>

        <button class="dark-mode-toggle" onclick="toggleDarkMode()" id="toggleDarkMode">
            <img id="darkModeIcon" src="/icon/custom/dark-mode.svg" alt="Dark Mode Toggle">
        </button>

        <button onclick="toggleMobileNav()">
            <img src="/icon/custom/menu_black.svg" class="mobileNav" alt="Mobile-nav-toggle">
        </button>


    </nav>
</header>
