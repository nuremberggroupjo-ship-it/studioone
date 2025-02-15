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
