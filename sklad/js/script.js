//  кнопка прокрутки наверх
const scrollToTopBtn = document.getElementById("scrollToTop");

// отображение кнопки после 100px
window.addEventListener("scroll", () => {
    if (window.scrollY > 100) {
        scrollToTopBtn.style.display = "block";
    } else {
        scrollToTopBtn.style.display = "none";
    }
});

// Прокрутка наверх
scrollToTopBtn.addEventListener("click", () => {
    window.scrollTo({
        top: 0,
        behavior: "smooth",
    });
});

// функция для перелистывания фотографии
document.addEventListener('DOMContentLoaded', function() {
    let slides = document.querySelectorAll('.photo-slide');
    let currentIndex = 0;

    function showSlide(index) {
        slides[currentIndex].classList.remove('active');
        currentIndex = (index + slides.length) % slides.length;
        slides[currentIndex].classList.add('active');
    }

    document.querySelector('.photo-slider-btn.next').addEventListener('click', function() {
        showSlide(currentIndex + 1);
    });

    document.querySelector('.photo-slider-btn.prev').addEventListener('click', function() {
        showSlide(currentIndex - 1);
    });
});