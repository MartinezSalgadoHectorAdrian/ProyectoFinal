document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    e.preventDefault();

    const target = document.querySelector(this.getAttribute("href"));
    target.scrollIntoView({
      behavior: "smooth",
      block: "start",
    });
  });
});

let slideIndex = 0;

function moveSlide(step) {
  const slides = document.querySelectorAll(".card");
  slideIndex += step;

  if (slideIndex < 0) {
    slideIndex = slides.length - 1;
  } else if (slideIndex >= slides.length) {
    slideIndex = 0;
  }

  const carousel = document.querySelector(".carousel");
  carousel.style.transform = `translateX(-${slideIndex * 100}%)`;
}
