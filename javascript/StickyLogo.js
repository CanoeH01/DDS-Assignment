    document.addEventListener("DOMContentLoaded", function () {
        const navbar = document.getElementById("mainNavbar");
        const logo = document.querySelector(".logo-container");

        const stickyPoint = logo.offsetTop + logo.offsetHeight;

    window.addEventListener("scroll", function () {
        if (window.scrollY >= stickyPoint) {
            navbar.classList.add("sticky-navbar");
        } else {
            navbar.classList.remove("sticky-navbar");
        }
    });

    });