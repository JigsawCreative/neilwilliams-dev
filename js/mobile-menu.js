/**
 * Mobile Menu Script
 */
const mobileMenu = () => {

    const menuBtn = document.querySelector('.menu-button');
    const menuEls = document.querySelectorAll('.menu-span, .logo');

    // GSAP timeline animation
    const tl = gsap.timeline({ paused: true });

    // Menu panel animation
    tl.fromTo(
        "#header .menu-main-container",
        { x: "-100%" },
        { x: "0%", duration: 0.5, ease: "power2.out" }
    );

    const menuLinks = document.querySelectorAll(".menu > li > a");
    const menuItems = document.querySelectorAll("#header .menu-main-container .menu > li");

    menuBtn.addEventListener("click", () => {
        const isOpen = menuEls[0]?.classList.contains('open');

        if (isOpen) {
            tl.reverse();
            menuEls.forEach(el => el.classList.remove('open'));
        } else {
            menuEls.forEach(el => el.classList.add('open'));

            // Animate menu items separately so stagger only happens on open
            gsap.fromTo(
                menuItems,
                { x: -40, opacity: 0 },
                {
                    x: 0,
                    opacity: 1,
                    duration: 0.3,
                    stagger: 0.12,
                    ease: "power2.out"
                }
            );

            tl.play();
        }
    });

    menuLinks.forEach(link => link.addEventListener("click", (event) => {

        const pageName = event.target.innerText.toLowerCase().split(" ").join("-");

        const body = document.body;
        body.className = "";
        body.classList.add(pageName);

        menuEls.forEach(el => el.classList.remove('open'));

        tl.reverse();

    }));

};

window.addEventListener("DOMContentLoaded", () => {

    // Only trigger mobile menu function on mobile screens
    if (window.innerWidth <= 1024) {
        mobileMenu();
    }

});