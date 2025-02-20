<header class="header">
    <button class="sidebar-toggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>
    <div class="">
        {{-- <i class="fas fa-search" style="color: var(--primary-yellow);"></i>
        <input type="text" class="search-input" placeholder="Search..."> --}}
    </div>
    <div class="user-profile" onclick="toggleDropdown()">
        {{-- <div class="notification-badge"><i class="fas fa-bell"></i> 3</div> --}}
        <div class="user-img"><img src="https://robohash.org/placeholder.png" alt="Admin Avatar" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;"></div>
        <span>Admin</span>
        <div class="dropdown-menu">
            <div class="menu-item">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </div>
        </div>
    </div>
</header>
