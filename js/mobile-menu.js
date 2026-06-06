/**
 * Mobile Menu Script
 */
const mobileMenu = () => {

    const menuBtn = document.querySelector('.menu-button');
    const menuEls = document.querySelectorAll('.menu-span, .logo');

    menuBtn.addEventListener("click", () => {
        const isOpen = menuEls[0]?.classList.contains('open');

        if (isOpen) {
            tl.reverse(); // Reverse the animation
            menuEls.forEach(el => el.classList.remove('open'));
        } else {
            tl.play(); // Play the animation
            menuEls.forEach(el => el.classList.add('open'));
        }

    });

    // GSAP timeline animation
    const tl = gsap.timeline({ paused: true });

    // Animate .menu-main-container from off-screen (translateX -100%) to its final position (translateX 0%)
    tl.fromTo(
        "#header .menu-main-container", // Target menu container
        { x: "-100%" },         // Starting state: translateX(-100%)
        { x: "0%", duration: 0.5, ease: "power2.out" } // Ending state: translateX(0%)
    )
    // Animate each menu item with a stagger
    .fromTo(
        "#header .menu-main-container .menu > li", // Target menu items
        { x: -40, opacity: 0 },
        { x: 0, opacity: 1, duration: 0.3, stagger: 0.12, ease: "power2.out" },
        "<" // Start at the same time as previous animation
    );

    const menuLinks = document.querySelectorAll(".menu > li > a");

    menuLinks.forEach(link => link.addEventListener("click", (event) => {

        // convert menu link to camelcase to match pageColour object keys
        const pageName = event.target.innerText.toLowerCase().split(" ").join("-");

        // Update body class based on page
        const body = document.body;

        body.className = "";

        body.classList.add(pageName);

        menuEls.forEach(el => el.classList.remove('open'));
        
        // Run timeline animation forwards
        tl.reverse();

    }));

}

window.addEventListener("DOMContentLoaded", () => {

    // Only trigger mobile menu function on mobile screens
    if(window.innerWidth <= 1024) {
        mobileMenu();
    }

});