// Start Banner Slider
const bannerSwiper = document.querySelector('.banner-swiper');

if (bannerSwiper) {
    const swiper = new Swiper('.banner-swiper', {
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        autoplay: {
            delay: 5000,
        },
    });
}
// End Banner Slider
// Start Projects Slider
if (document.querySelector('.projects-swiper')) {
    const swiper = new Swiper('.projects-swiper', {
      effect: "coverflow",
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: "auto",
      coverflowEffect: {
        rotate: 50, // Rotation of slides
        stretch: 0, // Space between slides
        depth: 200, // Perspective depth
        modifier: 1, // Effect multiplier
        slideShadows: true, // Enable slide shadows
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
    });
  }
  
// End Projects Slider

let lastScrollTop = 0;
const header = document.querySelector("header");

window.addEventListener("scroll", () => {
  const currentScroll = window.pageYOffset || document.documentElement.scrollTop;

  if (currentScroll > lastScrollTop) {
    // Scrolling down
    header.classList.add("hidden");
  } else {
    // Scrolling up
    header.classList.remove("hidden");
  }

  // Add "scrolled" class if not at the top
  if (currentScroll > 0) {
    header.classList.add("scrolled");
  } else {
    header.classList.remove("scrolled");
  }

  lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // Avoid negative values
});

// hamburger
let humburgers = document.querySelector(".humburger");
let sideHeader = document.querySelector("header nav");

humburgers.onclick = function () {
  sideHeader.classList.toggle("activee");
};
  humburgers.addEventListener("click", () => {
  humburgers.classList.toggle("change");
});
// Start Customer Logos Slider
var customerLogosSwiper = document.querySelector('.customer-logos-slider');
if (customerLogosSwiper) {
const swiper = new Swiper('.customer-logos-slider', {
  slidesPerView: 3,
  spaceBetween: 30,
  loop: true,
  pagination: {
      el: '.swiper-pagination',
      clickable: true,
  },
  breakpoints: {
      640: {
          slidesPerView: 3,
          spaceBetween: 20,
      },
      768: {
          slidesPerView: 5,
          spaceBetween: 30,
      },
      1024: {
          slidesPerView: 7,
          spaceBetween: 40,
      },
  }
    });
}
// End Customer Logos Slider
// Start Projects
document.addEventListener("DOMContentLoaded", () => {
  const categories = document.querySelectorAll(".portfolio .categories span");
  const portfolioItems = document.querySelectorAll(".portfolio-item");
  let timeoutId; // For managing animations to avoid overlaps

  function fadeIn(element, duration = 500) {
      element.style.opacity = "0";
      element.style.transform = "translateY(20px)";
      element.style.visibility = "visible";
      element.style.position = "relative";
      element.style.transition = `opacity ${duration}ms ease, transform ${duration}ms ease`;

      requestAnimationFrame(() => {
          element.style.opacity = "1";
          element.style.transform = "translateY(0)";
      });
  }

  function fadeOut(element, duration = 500) {
      element.style.transition = `opacity ${duration}ms ease, transform ${duration}ms ease`;
      element.style.opacity = "0";
      element.style.transform = "translateY(20px)";
      setTimeout(() => {
          element.style.visibility = "hidden";
          element.style.position = "absolute";
      }, duration);
  }

  // Show all items by default on page load
  portfolioItems.forEach((item) => fadeIn(item, 500));

  // Mark the "All" category as active on page load
  const allCategory = document.querySelector(".portfolio .categories span:first-child");
  if (allCategory) {
      allCategory.classList.add("active");
  }

  categories.forEach((category) => {
      category.addEventListener("click", () => {
          categories.forEach((cat) => cat.classList.remove("active"));
          category.classList.add("active");

          const filter = category.textContent;

          // Apply fade-out first to all items
          portfolioItems.forEach((item) => fadeOut(item, 300));

          clearTimeout(timeoutId); // Clear previous animation timeouts

          timeoutId = setTimeout(() => {
              portfolioItems.forEach((item) => {
                  if (filter === "All" || item.classList.contains(filter)) {
                      fadeIn(item, 500); // Apply fade-in animation with delay
                  }
              });
          }, 300); // Add slight delay for smoother transition
      });
  });
});
// End Projects

