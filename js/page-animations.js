/**
 * animations.js
 * Dedicated file for reusable animation functions (GSAP, etc.)
 * All site-wide animation utilities live here.
 */

const triggerPageAnimations = (container = document) => {
  
  // Animate logo
  animateLogo();

  // Animate in page title
  if (container.querySelector('.page-title')) animatePageTitle();
  if (container.querySelector('.post-meta-data')) animatePostTitle();
  if (container.querySelector('.dot')) animateTitleDot();
  if (container.querySelector('.page-body')) animateBodyText();

  // Animate copyright text
  animateCopyright();

  // Image reveal animations
  if (container.querySelector('.travel-images')) animateTravelImages(container);

  // Animate blog listings on writing page
  if(container.querySelector('.blog-listing')) animateBlogListings(container);

  // Animate tech icons on home page
  if(container.querySelector('.tech-icons')) animateTechIcons(container);
};


/**
 * Animate logo (GLOBAL - NOT Barba container scoped)
 * This runs on every page transition and resets stroke state before animating.
 */
const animateLogo = () => {

  const logo = document.querySelector('.logo');

  if (!logo) return;

  const paths = logo.querySelectorAll('path');

  // Kill existing tweens to avoid stacking in SPA transitions
  gsap.killTweensOf(paths);

  paths.forEach((path) => {

    const length = path.getTotalLength ? path.getTotalLength() : 500;

    // Reset stroke state before animation
    gsap.set(path, {
      strokeDasharray: length,
      strokeDashoffset: length,
      opacity: 1
    });

  });

  // Animate stroke draw
  gsap.to(paths, {
    strokeDashoffset: 0,
    duration: 0.8,
    ease: "power2.out",
    stagger: {
      each: 0.1,
      from: "start"
    }
  });

};

// const rotateLogoOnScroll = () => {

//   gsap.registerPlugin(ScrollTrigger);

//   const centerX = 288;
//   const centerY = 280.5;

//   const rings = [
//     { el: ".ring-outer", speed: 0.3 },
//     { el: ".ring-mid-outer", speed: 0.5 },
//     { el: ".ring-mid-inner", speed: 0.8 },
//     { el: ".ring-inner", speed: 1.2 }
//   ];

//   rings.forEach(ring => {

//     const el = document.querySelector(ring.el);

//     if (!el) return;

//     gsap.set(el, {
//       transformBox: "fill-box",
//       transformOrigin: "center center"
//     });

//     gsap.to(el, {
//       rotation: 360,
//       ease: "none",
//       scrollTrigger: {
//         trigger: document.body,
//         start: "top top",
//         end: "bottom bottom",
//         scrub: ring.speed
//       }
//     });

//   });

// };

/**
 * Animate page title in from hidden state
 */
const animatePageTitle = () => {
  gsap.to('.page-title', {
    y: '0%',
    opacity: 1,
    visibility: 'visible',
    duration: 0.8,
    ease: 'power2.out'
  });
};

/**
 * Animate post title in from hidden state
 */
const animatePostTitle = () => {
  gsap.to('.post-meta-data', {
    y: '0%',
    opacity: 1,
    visibility: 'visible',
    duration: 0.8,
    ease: 'power2.out'
  });
};


/**
 * Animate title dot element
 */
const animateTitleDot = () => {
  gsap.to('.dot', {
    x: '0%',
    opacity: 1,
    visibility: 'visible',
    duration: 0.8,
    ease: "elastic.out(1, 0.7)",
    delay: 0.3,
  });
};


/**
 * Animate body text reveal
 */
const animateBodyText = () => {
  gsap.to('.page-body', {
    y: '0%',
    opacity: 1,
    visibility: 'visible',
    duration: 0.8,
    ease: 'power2.out',
    delay: 0.4,
  });
};


const animateBlogListings = () => {
  gsap.set('.blog-listing', {opacity: 0, y: 40});
  gsap.to('.blog-listing', {
      opacity: 1,
      y: 0,
      duration: 0.7,
      ease: 'power2.out',
      stagger: 0.12
  });
};

/**
 * Animate copyright text
 * (persistent global element outside Barba container)
 */
const animateCopyright = () => {

  if (!gsap.isTweening('#copyright')) {
    gsap.set('#copyright', {
      y: 60,
      opacity: 0,
      visibility: 'visible'
    });
  }

  gsap.to('#copyright', {
    y: 0,
    opacity: 1,
    duration: 1,
    ease: 'power2.out',
    delay: 0.8
  });

};

/**
 * Animate image reveal on scroll
 * @param {HTMLElement} container 
 */
// const imageReveal = (container = document) => {

//   gsap.registerPlugin(ScrollTrigger);

//   gsap.utils.toArray('.image-wrapper', container).forEach((wrapper, i) => {

//     const mask = wrapper.querySelector('.mask');
//     const img = wrapper.querySelector('img');

//     gsap.set(mask, { yPercent: 0, opacity: 1 });

//     gsap.to(mask, {
//       yPercent: 100,
//       opacity: 1,
//       duration: 0.6,
//       ease: 'power2.out',
//       scrollTrigger: {
//         trigger: img,
//         start: "top 100%",
//         end: "top 60%",
//         toggleActions: 'play none none none',
//         markers: true,
//         once: true
//       }
//     });
//   });
// };

/**
 * Animate travel images on scroll
 * @param {HTMLElement} container 
 */
const animateTravelImages = (container = document) => {

  // Register ScrollTrigger plugin
  gsap.registerPlugin(ScrollTrigger);

  // Set initial state of images based on data attributes
  requestAnimationFrame(() => {

    // Select all images within the travel section and set their initial state
    const images = gsap.utils.toArray(
      container.querySelectorAll(".travel-image")
    );

    // Reset any existing tweens on these images to prevent stacking in SPA transitions
    gsap.set(images, {
      x: 0,
      y: 0,
      rotation: 0,
      scale: 0.9
    });

    // Animate images based on their data attributes as the user scrolls
    gsap.to(images, {
      x: (i, el) => parseFloat(el.dataset.x),
      y: (i, el) => parseFloat(el.dataset.y),
      rotation: (i, el) => parseFloat(el.dataset.r),
      scale: 1,
      ease: "none",
      stagger: 0.05,

      // Configure ScrollTrigger for each image
      scrollTrigger: {
        trigger: container.querySelector(".travel-section"),
        start: "top 100%",
        end: "top 60%",
        scrub: 0.7,
        markers: true
      }
    });

    // Refresh ScrollTrigger to ensure it calculates positions based on the new page content
    ScrollTrigger.refresh(true);

  });
};

const animateTechIcons = (container = document) => {

  // Register ScrollTrigger plugin
  gsap.registerPlugin(ScrollTrigger);

  // Set initial state of images based on data attributes
  requestAnimationFrame(() => {

    // Select all tech icons and set their initial state
    gsap.set('.tech-icons img', {opacity: 0, y: 40});

    // Animate icons as the user scrolls
    gsap.to('.tech-icons img', {
      opacity: 1,
      y: 0,
      duration: 0.7,
      ease: 'power2.out',
      stagger: 0.2,

      // Configure ScrollTrigger tech icons section
      scrollTrigger: {
        trigger: container.querySelector(".tech-icons"),
        start: "top 100%",
        end: "top 60%",
        scrub: 0.7,
        markers: true
      }
    });

    // Refresh ScrollTrigger to ensure it calculates positions based on the new page content
    ScrollTrigger.refresh(true);

  });
};