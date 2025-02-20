document.getElementById("toggleSidebar").addEventListener("click", function () {
    document.getElementById("sidebar").classList.toggle("collapsed");
    document.getElementById("content").classList.toggle("expanded");
});

document.getElementById("logout").addEventListener("click", function () {
    document.getElementById("logout-form").submit();
});