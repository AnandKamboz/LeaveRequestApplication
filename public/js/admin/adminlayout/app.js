document.getElementById("toggleSidebar").addEventListener("click", function () {
    document.getElementById("sidebar").classList.toggle("collapsed");
    document.getElementById("content").classList.toggle("expanded");
});

document.addEventListener("DOMContentLoaded", () => {
    let links = document.querySelectorAll(".nav-link"),
        currentPage = sessionStorage.getItem("activePage") || links[0].textContent.trim();

    links.forEach(link => {
        link.classList.toggle("active", link.textContent.trim() === currentPage);
        link.addEventListener("click", e => {
            e.preventDefault();
            sessionStorage.setItem("activePage", link.textContent.trim());
            links.forEach(l => l.classList.remove("active"));
            link.classList.add("active");
        });
    });
});