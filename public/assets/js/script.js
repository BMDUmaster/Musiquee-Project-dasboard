document.querySelectorAll(".menu-item").forEach((item) => {
    item.addEventListener("click", function () {
        document.querySelector(".menu-item.active").classList.remove("active");
        this.classList.add("active");
    });
});
function toggleSidebar() {
    const sidebar = document.querySelector(".sidebar");
    sidebar.classList.toggle("active");
}
document.addEventListener("click", (event) => {
    const sidebar = document.querySelector(".sidebar");
    const sidebarToggle = document.querySelector(".sidebar-toggle");
    if (
        window.innerWidth <= 768 &&
        !sidebar.contains(event.target) &&
        !sidebarToggle.contains(event.target)
    ) {
        sidebar.classList.remove("active");
    }
});

function toggleDropdown() {
    const dropdownMenu = document.querySelector('.dropdown-menu');
    dropdownMenu.classList.toggle('active');
}

document.addEventListener('click', (event) => {
    const dropdownMenu = document.querySelector('.dropdown-menu');
    const userProfile = document.querySelector('.user-profile');
    if (!userProfile.contains(event.target)) {
        dropdownMenu.classList.remove('active');
    }
});
