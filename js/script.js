document.addEventListener("DOMContentLoaded", function () {
  // Menú hamburguesa
  const toggle = document.querySelector(".menu-toggle");
  const nav = document.querySelector("nav ul");

  toggle.addEventListener("click", () => {
    nav.classList.toggle("active");
  });
});

// Preloader + animaciones
window.addEventListener("load", () => {
  document.getElementById("preloader").style.display = "none";
  document.querySelector("header").classList.add("slide-in");
  document.querySelector("footer").classList.add("slide-up");
});

//principios
 const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
      }
    });
  }, {
    threshold: 0.1
  });

  document.querySelectorAll('.caida').forEach(el => observer.observe(el));

  const scrollBtn = document.getElementById('scrollTopBtn');
  window.addEventListener('scroll', () => {
    if (window.pageYOffset > 300) {
      scrollBtn.classList.add('show');
    } else {
      scrollBtn.classList.remove('show');
    }
  });

  if (scrollBtn) {
    scrollBtn.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }
