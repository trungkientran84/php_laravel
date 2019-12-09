/**
 * Following function is use for positioning the slide bar and top navigation bar menu
 */
(function(){
    var appContainer = document.querySelector('.app-container'),
        sidebar = appContainer.querySelector('.side-menu'),
        navbar = appContainer.querySelector('nav.navbar.navbar-top'),
        loader = document.getElementById('voyager-loader'),
        hamburgerMenu = document.querySelector('.hamburger'),
        sidebarTransition = sidebar.style.transition,
        navbarTransition = navbar.style.transition,
        containerTransition = appContainer.style.transition;

    sidebar.style.WebkitTransition = sidebar.style.MozTransition = sidebar.style.transition =
        appContainer.style.WebkitTransition = appContainer.style.MozTransition = appContainer.style.transition =
            navbar.style.WebkitTransition = navbar.style.MozTransition = navbar.style.transition = 'none';

    if (window.innerWidth > 768 && window.localStorage && window.localStorage['voyager.stickySidebar'] == 'true') {
        appContainer.className += ' expanded no-animation';
        loader.style.left = (sidebar.clientWidth/2)+'px';
        hamburgerMenu.className += ' is-active no-animation';
    }

    navbar.style.WebkitTransition = navbar.style.MozTransition = navbar.style.transition = navbarTransition;
    sidebar.style.WebkitTransition = sidebar.style.MozTransition = sidebar.style.transition = sidebarTransition;
    appContainer.style.WebkitTransition = appContainer.style.MozTransition = appContainer.style.transition = containerTransition;
})();
