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
  if (container.querySelector('.image-gallery, .travel-images')) animateTravelImages(container);

  // Animate blog listings on writing page
  if(container.querySelector('.blog-listing')) animateBlogListings(container);

  // Animate tech icons on home page
  if (container.querySelector('.technologies, .technolgies, .tech-icons')) animateTechIcons(container);
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
 * Animate travel images on scroll
 * @param {HTMLElement} container 
 */
const animateTravelImages = (container = document) => {

  // Register ScrollTrigger plugin
  gsap.registerPlugin(ScrollTrigger);

  requestAnimationFrame(() => {
    const galleries = gsap.utils.toArray(
      container.querySelectorAll('.image-gallery, .travel-images')
    );

    galleries.forEach((gallery) => {
      const images = gallery.querySelectorAll('img');

      if (!images.length) return;

      // Reset any existing tweens on these images to prevent stacking in SPA transitions.
      gsap.killTweensOf(images);
      gsap.set(images, {
        y: 28,
        opacity: 0,
        scale: 0.985
      });

      // Stagger in images with a subtle upward reveal as the section enters view.
      gsap.to(images, {
        y: 0,
        opacity: 1,
        scale: 1,
        duration: 0.75,
        ease: 'power2.out',
        stagger: 0.14,

        // Configure ScrollTrigger for each gallery row.
        scrollTrigger: {
          trigger: gallery,
          start: 'top 90%',
          toggleActions: 'play none none none',
          markers: false
        }
      });
    });

    // Refresh ScrollTrigger to ensure it calculates positions based on the new page content
    ScrollTrigger.refresh(true);

  });
};

const animateTechIcons = (container = document) => {

  // Register ScrollTrigger plugin
  gsap.registerPlugin(ScrollTrigger);

  requestAnimationFrame(() => {
    const iconGroups = gsap.utils.toArray(
      container.querySelectorAll('.technologies')
    );

    iconGroups.forEach((group) => {
      const icons = group.querySelectorAll('img');

      if (!icons.length) return;

      // Reset state so repeated SPA transitions don't stack animations.
      gsap.killTweensOf(icons);
      gsap.set(icons, { opacity: 0, y: 30 });

      gsap.to(icons, {
        opacity: 1,
        y: 0,
        duration: 0.75,
        ease: 'back.out(1.3)',
        stagger: 0.12,
        scrollTrigger: {
          trigger: group,
          start: 'top 90%',
          toggleActions: 'play none none none',
          markers: true
        }
      });
    });

    // Refresh ScrollTrigger to ensure it calculates positions based on the new page content
    ScrollTrigger.refresh(true);

  });
};