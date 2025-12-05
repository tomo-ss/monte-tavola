import './bootstrap';
document.addEventListener("DOMContentLoaded", () => {
    const targets = document.querySelectorAll(".fade-up");

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("show");
            }
        });
    }, {
        threshold: 0.2
    });

    targets.forEach(el => observer.observe(el));
});
