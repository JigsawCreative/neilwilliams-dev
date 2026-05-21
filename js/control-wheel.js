// =========================
// WHEEL BUILD
// =========================

const buildWheel = (tech) => {

  const wheel = document.querySelector('.radial');
  if (!wheel) return;

  wheel.innerHTML = '';

  tech.forEach((item, index) => {

    const el = document.createElement('div');
    el.className = 'tool-wrap';

    el.dataset.id = item.id;
    el.dataset.index = index;

    el.innerHTML = `
      <div class="tool">
        ${item.logo}
      </div>
    `;

    wheel.appendChild(el);

  });

  bindWheelEvents();

};


// =========================
// EVENT BINDING (single source)
// =========================

const bindWheelEvents = () => {

  const tools = gsap.utils.toArray(".tool-wrap");

  tools.forEach((tool, i) => {

    tool.addEventListener("click", () => {

      const id = tool.dataset.id;
      const item = window.TechAPI.cache.find(t => t.id == id);

      openTool(item, i, tools.length, tool);

    });

  });

};


// =========================
// MAIN CONTROLLER
// =========================

const openTool = (item, index, total, el) => {

  const angle = (360 / total) * index;

  // run BOTH immediately, not chained
  gsap.to(".radial", {
    rotate: -angle,
    duration: 0.8,
    ease: "power4.out"
  });

  revealFrom(el); // 👈 fire instantly (no timeline delay)

  setActive(el);

  renderReveal(item);

};


// =========================
// ACTIVE STATE
// =========================

const setActive = (tool) => {

  gsap.to(".tool-wrap", {
    scale: 1,
    duration: 0.3
  });

  gsap.to(tool, {
    scale: 1.2,
    duration: 0.4,
    ease: "power2.out"
  });

};


// =========================
// ROTATION ANIMATION
// =========================

const animateControlWheel = () => {

  const wheel = document.querySelector('.radial');
  if (!wheel) return;

  gsap.registerPlugin(ScrollTrigger);

  gsap.set(wheel, { rotation: 0 });

  gsap.to(wheel, {
    rotation: 360,
    ease: "none",
    scrollTrigger: {
      trigger: wheel,
      start: "top bottom",
      end: "bottom top",
      scrub: 1.5,
      invalidateOnRefresh: true
    }
  });

};

// =========================
// REVEAL ANIMATION
// =========================

// const revealFrom = (el) => {

//   const rect = el.getBoundingClientRect();
//   const layer = document.querySelector(".reveal-layer").getBoundingClientRect();

//   const x = rect.left + rect.width / 2 - layer.left;
//   const y = rect.top + rect.height / 2 - layer.top;

//   gsap.timeline()

//     .to(el, {
//       scale: 1.6,
//       transformOrigin: "50% 50%",
//       zIndex: 10,
//       duration: 0.4,
//       ease: "power2.out"
//     }, 0)

//     .fromTo(".reveal-layer",
//       {
//         clipPath: `circle(0px at ${x}px ${y}px)`
//       },
//       {
//         clipPath: `circle(150% at ${x}px ${y}px)`,
//         duration: 1,
//         ease: "power3.out"
//       },
//       0
//     )

//     .to(el, {
//       scale: 1,
//       duration: 0.2,
//       ease: "power2.in"
//     }, 0.6);

// };

let revealTl = null;

const revealFrom = (el) => {

  const rect = el.getBoundingClientRect();
  const layer = document.querySelector(".reveal-layer").getBoundingClientRect();

  const x = rect.left + rect.width / 2 - layer.left;
  const y = rect.top + rect.height / 2 - layer.top;

  // kill previous timeline if exists
  if (revealTl) revealTl.kill();

  revealTl = gsap.timeline({ paused: true })

    .to(el, {
      scale: 1.6,
      transformOrigin: "50% 50%",
      zIndex: 10,
      duration: 0.4,
      ease: "power2.out"
    }, 0)

    .fromTo(".reveal-layer",
      {
        clipPath: `circle(0px at ${x}px ${y}px)`
      },
      {
        clipPath: `circle(150% at ${x}px ${y}px)`,
        duration: 1.1,
        ease: "power2.out"
      },
      0
    );

  revealTl.play();

};

// =========================
// CONTENT RENDER
// =========================

const renderReveal = (item) => {

  const el = document.querySelector(".reveal-content");
  if (!el) return;

  el.innerHTML = `
    <button class="reveal-close" type="button">Close</button>
    <div class="reveal-inner">
      ${item.content}
    </div>
  `;

  bindRevealClose(); 

};

const bindRevealClose = () => {

  const btn = document.querySelector(".reveal-close");
  if (!btn) return;

  btn.addEventListener("click", closeReveal);

};

const closeReveal = () => {

  if (!revealTl) return;

  // reverse immediately
  revealTl.timeScale(1.2).reverse();

  // clear ONLY when we're actually back at start
  revealTl.eventCallback("onReverseComplete", () => {

    gsap.set(".tool-wrap", {
      scale: 1,
      zIndex: 1
    });

    gsap.set(".reveal-layer", {
      clearProps: "clipPath"
    });

    const el = document.querySelector(".reveal-content");
    if (el) el.innerHTML = "";

  });

};

// const closeReveal = () => {

//   gsap.to(".reveal-layer", {
//     clipPath: "circle(0px at 50% 50%)",
//     duration: 0.6,
//     ease: "power3.inOut",
//     onComplete: () => {
//       document.querySelector(".reveal-content").innerHTML = "";
//     }
//   });

// };