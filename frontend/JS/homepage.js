const footer = document.querySelector('.footer-custom');
const btn = document.getElementById('footer-scroll-btn');

const observer = new IntersectionObserver(entries => {
    if (entries[0].isIntersecting) {
        btn.classList.add('visible');
    } else {
        btn.classList.remove('visible');
    }
});

observer.observe(footer);

btn.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});
document.addEventListener("DOMContentLoaded", () => {
    const options = {
        root: null,
        threshold: 0.5
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("visible");
            }
        });
    }, options);


    document.querySelectorAll(".reveal").forEach(el => observer.observe(el));
});