import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

document.addEventListener('DOMContentLoaded', () => {
  // 1. Hero Animation
  const heroTl = gsap.timeline();
  heroTl
    .from('.hero-title', {
      y: 60,
      opacity: 0,
      duration: 1,
      ease: 'power4.out',
    })
    .from(
      '.hero-subtitle',
      {
        y: 40,
        opacity: 0,
        duration: 0.8,
        ease: 'power3.out',
      },
      '-=0.6',
    )
    .from(
      '.hero-cta',
      {
        scale: 0.8,
        opacity: 0,
        duration: 0.5,
        ease: 'back.out(1.7)',
      },
      '-=0.4',
    );

  // 2. Section Staggered Animations
  gsap.utils.toArray('.doc-section').forEach((section) => {
    // Find elements to animate within the section
    const title = section.querySelector('h2');
    const content = section.querySelectorAll('.animate-on-scroll');
    const cards = section.querySelectorAll('.doc-card');

    const tl = gsap.timeline({
      scrollTrigger: {
        trigger: section,
        start: 'top 80%',
        toggleActions: 'play none none reverse',
      },
    });

    if (title) {
      tl.from(title, {
        opacity: 0,
        x: -30,
        duration: 0.8,
        ease: 'power2.out',
      });
    }

    if (content.length > 0) {
      tl.from(
        content,
        {
          opacity: 0,
          y: 30,
          stagger: 0.2,
          duration: 0.6,
          ease: 'power1.out',
        },
        '-=0.4',
      );
    }

    if (cards.length > 0) {
      tl.from(
        cards,
        {
          opacity: 0,
          scale: 0.9,
          y: 40,
          stagger: 0.1,
          duration: 0.7,
          ease: 'power2.out',
        },
        '-=0.5',
      );
    }
  });

  // 3. Sidebar active states on scroll
  const sections = document.querySelectorAll('section[id]');
  const navLinks = document.querySelectorAll('.sidebar-link');

  window.addEventListener('scroll', () => {
    let current = '';
    sections.forEach((section) => {
      const sectionTop = section.offsetTop;
      const sectionHeight = section.clientHeight;
      if (pageYOffset >= sectionTop - 100) {
        current = section.getAttribute('id');
      }
    });

    navLinks.forEach((link) => {
      link.classList.remove('active');
      if (link.getAttribute('href') === `#${current}`) {
        link.classList.add('active');
      }
    });
  });
});
