// These variables must be global so Barba transitions can share state between lifecycle hooks (leave/enter).
// If they are local to a function, the value will not persist between transitions and Barba may break or reload the page.
let destinationPageColour = '#000'; // Used if no colour is found
let nextBodyClass = ''; // Will be e.g. 'pixel-web-design'

// Initialise Barba.js page transitions
const barbaInit = () => {

  barba.init({

    transitions: [

      {

        // On initial page load, refesh or if url is directly updated in nav bar
        async once(data) {

          // Get the relevant colour and body class
          destinationPageColour = getColourForUrl(window.location.href);

          // Apply mask colour
          setMaskColour(destinationPageColour);

          // Set destination colour CSS variable values after mask has run
          updatePageColours(destinationPageColour);

          // Set mask offscreen left before animation
          gsap.set('.transition-mask', { x: '-100%' });

          // Animate mask in to cover the page (x: 0%)
          await gsap.to('.transition-mask', {
            x: '0%',
            duration: 0.5,
            ease: 'power2.inOut',
          });

          // Reveal body content
          document.body.classList.remove('is-loading');

          // Animate mask offscreen to the right (x: 100%)
          await gsap.to('.transition-mask', {
            x: '100%',
            duration: 1.5,
            ease: 'power2.inOut',
          });

          // Animate in page title
          triggerPageAnimations(data.next?.container || document);

          // Reset mask position offscreen left for future transitions
          gsap.set('.transition-mask', { x: '-100%' });

        },

        // Cover old page with mask and hide content
        async leave(data) {

          // Get the clicked link that triggered the transition
          const clickedLink = data.trigger;

          // Get the relevant colour and body class
          destinationPageColour = getColourForUrl(window.location.href);

          // Set the mask to the new colour
          setMaskColour(destinationPageColour);

          // Slide mask in from left to fully cover screen
          await gsap.to('.transition-mask', {
            x: '0%',
            duration: 0.5,
            ease: 'power2.inOut',
          });

          // Set destination colour CSS variable values while the mask is covering the page
          updatePageColours(destinationPageColour);

          // Hide copyright after mask covers the page
          gsap.set('#copyright', { opacity: 0, y: 60 });

          // Reset logo while hidden (prevents flicker)
          resetLogo();

          // Remove old ScrollTriggers to prevent conflicts with new page's triggers
          ScrollTrigger.getAll().forEach(trigger => {
              trigger.kill();
          });

          // Safely remove old page container
          data.current.container.remove();
          
        },

        // Move the mask offscreen to reveal new content
        async enter(data) {

            // Scroll to top on new page load (after mask has covered the page)
            window.scrollTo(0, 0);

            // Update navigation highlight for new page immediately
            updateNavHighlight();

            // Slide mask offscreen to the right, revealing new content
            await gsap.to('.transition-mask', {
              x: '100%',
              duration: 0.5,
              ease: 'power2.inOut',
            });
            
            // Animate in page title
            triggerPageAnimations(data.next?.container);

            // Refresh ScrollTrigger after new content is revealed to ensure triggers are correctly positioned
            requestAnimationFrame(() => {
              ScrollTrigger.refresh(true);
            });
            
            // Reset mask to starting position (offscreen left)
            gsap.set('.transition-mask', { x: '-100%' });

        }
      }
    ],
  });

  // Prevent transition if clicking on the current page link
  preventSamePageTransition();

  // Initial highlight on page load
  updateNavHighlight();

};

// Get the colour for a given URL from the localized PHP data
const getColourForUrl = (url) => {

  // Ensure only the path part is used
  let path = (new URL(url, window.location.origin)).pathname.replace(/\/$/, '');

  // Handle root/home path as special case
  if (path === '') path = '/';

  return PageColours.colours[path] || '#000';
};

/**
 * Update CSS variables for page colours based on the destination page's colour.
 * @param {string} destinationPageColour 
 */
const updatePageColours = (destinationPageColour) => {

  // Convert the hex colour to HSL
  const hsl = hexToHSL(destinationPageColour);

  // Update CSS variables for hue, saturation, and lightness
  document.documentElement.style.setProperty('--base-hue', hsl.h);
  document.documentElement.style.setProperty('--base-saturation', hsl.s + '%');
  document.documentElement.style.setProperty('--base-lightness', hsl.l + '%');

}

// Set the background colour of the transition mask
const setMaskColour = (colour) => {

  // Select the mask element and set its background colour
  const mask = document.querySelector('.transition-mask');

  // Apply the colour if the mask exists
  if (mask) mask.style.backgroundColor = colour;

};

// Remove old pixel-* class from <body> and add the new one
const updateBodyClass = (newClass) => {

  // Remove any existing pixel-* classes
  document.body.classList.forEach(cls => {
    if (cls.startsWith('pixel-')) document.body.classList.remove(cls);
  });

  // Add the new class if it exists
  if (newClass) document.body.classList.add(newClass);

};

// Function to update aria-current attribute on nav links
const updateNavHighlight = () => {

  // Select all nav links
  const links = document.querySelectorAll('nav a');

  // Get the current URL path without trailing slash
  const currentUrl = window.location.pathname.replace(/\/$/, '');

  // Loop through each link to update aria-current
  links.forEach(link => {

    // Always remove aria-current from all links
    link.removeAttribute('aria-current');

    // Skip logo link
    if (link.classList.contains('logo') || link.querySelector('.logo')) return;

    // Add aria-current to the link matching the current URL
    if (link.pathname.replace(/\/$/, '') === currentUrl) {
      link.setAttribute('aria-current', 'page');
    }

  });

}

// Prevent Barba transition when clicking on the current page link
const preventSamePageTransition = () => {

  // Select all anchor links and add click event listeners
  document.querySelectorAll("a").forEach((link) => {

    link.addEventListener("click", (e) => {

      // On click, check if the link's href matches the current URL
      if (link.href === window.location.href) {

        // Stops Barba transition
        e.preventDefault(); 

      }

    });

  });

};

const resetLogo = () => {

  const logo = document.querySelector('.logo');
  if (!logo) return;

  const paths = logo.querySelectorAll('path');

  paths.forEach(path => {

    const length = path.getTotalLength ? path.getTotalLength() : 500;

    gsap.set(path, {
      strokeDasharray: length,
      strokeDashoffset: length
    });

  });

};

// Start Barba on DOM ready
document.addEventListener("DOMContentLoaded", async() => {

  // Initialise Tech API and cache results before starting Barba
  await window.TechAPI.init();

  // Build the wheel if we're on the front page (where the .radial element exists)
  if (document.querySelector('.radial')) {
    buildWheel(window.TechAPI.cache);
  }

  // Init barba.js page transitions
  barbaInit();

});

window.addEventListener('load', () => {
  ScrollTrigger.refresh();
});

// Simple helper: Convert hex to HSL (returns {h, s, l} as numbers)
function hexToHSL(hex) {
  hex = hex.replace('#', '');
  if (hex.length === 3) {
    hex = hex.split('').map(x => x + x).join('');
  }
  const r = parseInt(hex.substring(0,2), 16) / 255;
  const g = parseInt(hex.substring(2,4), 16) / 255;
  const b = parseInt(hex.substring(4,6), 16) / 255;
  const max = Math.max(r, g, b), min = Math.min(r, g, b);
  let h, s, l = (max + min) / 2;
  if (max === min) {
    h = s = 0;
  } else {
    const d = max - min;
    s = l > 0.5 ? d / (2 - max - min) : d / (max + min);
    switch (max) {
      case r: h = (g - b) / d + (g < b ? 6 : 0); break;
      case g: h = (b - r) / d + 2; break;
      case b: h = (r - g) / d + 4; break;
    }
    h /= 6;
  }
  return {
    h: Math.round(h * 360),
    s: Math.round(s * 100),
    l: Math.round(l * 100)
  };
}

// Usage example:
// const hsl = hexToHSL('#aabbcc');
// document.documentElement.style.setProperty('--base-hue', hsl.h);
// document.documentElement.style.setProperty('--base-saturation', hsl.s + '%');
// document.documentElement.style.setProperty('--base-lightness', hsl.l + '%');