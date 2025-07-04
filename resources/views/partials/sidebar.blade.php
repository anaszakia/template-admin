<!-- Toggle Button for Mobile -->
<button id="sidebar-toggle" class="lg:hidden fixed top-4 left-4 z-50 p-2 bg-white rounded-md shadow-md">
    <i class="fas fa-bars"></i>
</button>

<!-- Sidebar Overlay for Mobile -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-20 lg:hidden hidden"></div>

<!-- Sidebar -->
<div id="sidebar" class="fixed inset-y-0 left-0 z-30 w-64 bg-white shadow-lg transform -translate-x-full transition-all duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0 flex flex-col">
    <!-- Sidebar Header with Toggle and Close Button -->
    <div class="flex items-center justify-between h-16 px-4 border-b border-gray-200">
        <div class="flex items-center space-x-2">
            <div class="w-8 h-8 bg-gray-900 rounded-full flex items-center justify-center">
                <i class="fas fa-flask text-white text-sm"></i>
            </div>
            <span class="text-xl font-semibold text-gray-900 sidebar-text">Logo</span>
        </div>
        <div class="flex items-center space-x-2">
            <!-- Desktop Toggle Button -->
            <button id="desktop-toggle" class="hidden lg:block p-1 text-gray-500 hover:text-gray-700 transition-colors">
                <i class="fas fa-bars"></i>
            </button>
            <!-- Mobile Close Button -->
            <button id="sidebar-close" class="lg:hidden p-1 text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    
    <!-- Navigation -->
    <nav class="flex-1 px-4 py-6 overflow-y-auto scrollbar-hide">
        <ul class="space-y-2">
            <li>
                <a href="#" class="flex items-center px-3 py-2 text-sm font-medium text-gray-900 rounded-lg hover:bg-gray-100 transition-colors">
                    <i class="fas fa-home w-5 h-5 mr-3 text-gray-500"></i>
                    <span class="sidebar-text">Home</span>
                </a>
            </li>
            
            <li>
                <a href="#" class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                    <i class="fas fa-calendar-alt w-5 h-5 mr-3 text-gray-500"></i>
                    <span class="sidebar-text">Events</span>
                </a>
            </li>
            
            <li>
                <a href="#" class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                    <i class="fas fa-shopping-cart w-5 h-5 mr-3 text-gray-500"></i>
                    <span class="sidebar-text">Orders</span>
                </a>
            </li>
            
            <!-- Dropdown Menu -->
            <li class="relative">
                <button onclick="toggleDropdown()" class="flex items-center justify-between w-full px-3 py-2 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                    <div class="flex items-center">
                        <i class="fas fa-layer-group w-5 h-5 mr-3 text-gray-500"></i>
                        <span class="sidebar-text">Management</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs text-gray-500 transition-transform duration-200 sidebar-arrow" id="dropdown-arrow"></i>
                </button>
                
                <!-- Dropdown Content -->
                <div id="dropdown-content" class="hidden mt-2 ml-8 space-y-1 dropdown-content">
                    <a href="#" class="block px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 transition-colors">
                        Users
                    </a>
                    <a href="#" class="block px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 transition-colors">
                        Roles
                    </a>
                    <a href="#" class="block px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 transition-colors">
                        Permissions
                    </a>
                </div>
            </li>
            
            <li>
                <a href="#" class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                    <i class="fas fa-cog w-5 h-5 mr-3 text-gray-500"></i>
                    <span class="sidebar-text">Settings</span>
                </a>
            </li>
        </ul>
    </nav>
    
    <!-- User Profile Section -->
    <div class="border-t border-gray-200 p-4">
        <div class="flex items-center space-x-3 cursor-pointer hover:bg-gray-50 rounded-lg p-2 transition-colors" onclick="toggleUserDropdown()">
            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center flex-shrink-0">
                <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?w=40&h=40&fit=crop&crop=face" 
                     alt="User Avatar" 
                     class="w-full h-full rounded-full object-cover">
            </div>
            <div class="flex-1 min-w-0 sidebar-text">
                <p class="text-sm font-medium text-gray-900 truncate">Erica</p>
                <p class="text-xs text-gray-500 truncate">erica@example.com</p>
            </div>
            <i class="fas fa-chevron-up text-xs text-gray-400 transition-transform duration-200 sidebar-arrow" id="user-dropdown-arrow"></i>
        </div>
        
        <!-- User Dropdown Menu -->
        <div id="user-dropdown-content" class="hidden mt-2 py-2 bg-white border border-gray-200 rounded-lg shadow-lg">
            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                <i class="fas fa-user w-4 h-4 mr-3 text-gray-500"></i>
                <span class="sidebar-text">Profile</span>
            </a>
            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                <i class="fas fa-cog w-4 h-4 mr-3 text-gray-500"></i>
                <span class="sidebar-text">Account Settings</span>
            </a>
            <hr class="my-1">
            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                <i class="fas fa-sign-out-alt w-4 h-4 mr-3 text-gray-500"></i>
                <span class="sidebar-text">Sign Out</span>
            </a>
        </div>
    </div>
</div>

<style>
.scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
.scrollbar-hide::-webkit-scrollbar {
    display: none;
}
.sidebar-collapsed {
    width: 4rem !important;
}
.sidebar-collapsed .sidebar-text {
    display: none;
}
.sidebar-collapsed .sidebar-arrow {
    display: none;
}
.sidebar-collapsed .dropdown-content {
    display: none !important;
}
.sidebar-collapsed #user-dropdown-content {
    display: none !important;
}
</style>

<script>
// Toggle dropdown function
function toggleDropdown() {
    const dropdown = document.getElementById('dropdown-content');
    const arrow = document.getElementById('dropdown-arrow');
    
    dropdown.classList.toggle('hidden');
    arrow.classList.toggle('rotate-180');
}

// Toggle user dropdown function
function toggleUserDropdown() {
    const sidebar = document.getElementById('sidebar');
    if (sidebar.classList.contains('sidebar-collapsed')) {
        return; // Don't open dropdown when sidebar is collapsed
    }
    
    const dropdown = document.getElementById('user-dropdown-content');
    const arrow = document.getElementById('user-dropdown-arrow');
    
    dropdown.classList.toggle('hidden');
    arrow.classList.toggle('rotate-180');
}

// Sidebar toggle functionality
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const sidebarClose = document.getElementById('sidebar-close');
    const sidebarOverlay = document.getElementById('sidebar-overlay');
    const desktopToggle = document.getElementById('desktop-toggle');
    
    // Mobile toggle sidebar
    sidebarToggle.addEventListener('click', function() {
        sidebar.classList.remove('-translate-x-full');
        sidebarOverlay.classList.remove('hidden');
    });
    
    // Desktop toggle sidebar (collapse/expand)
    desktopToggle.addEventListener('click', function() {
        sidebar.classList.toggle('sidebar-collapsed');
        
        // Close any open dropdowns when collapsing
        if (sidebar.classList.contains('sidebar-collapsed')) {
            document.getElementById('dropdown-content').classList.add('hidden');
            document.getElementById('user-dropdown-content').classList.add('hidden');
            document.getElementById('dropdown-arrow').classList.remove('rotate-180');
            document.getElementById('user-dropdown-arrow').classList.remove('rotate-180');
        }
    });
    
    // Close sidebar function for mobile
    function closeSidebar() {
        sidebar.classList.add('-translate-x-full');
        sidebarOverlay.classList.add('hidden');
    }
    
    sidebarClose.addEventListener('click', closeSidebar);
    sidebarOverlay.addEventListener('click', closeSidebar);
    
    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(event) {
        const isLargeScreen = window.innerWidth >= 1024;
        
        if (!isLargeScreen && !sidebar.contains(event.target) && 
            event.target !== sidebarToggle && !sidebarToggle.contains(event.target)) {
            closeSidebar();
        }
    });
    
    // Close dropdowns when clicking outside
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('dropdown-content');
        const userDropdown = document.getElementById('user-dropdown-content');
        
        if (!event.target.closest('.relative') && !dropdown.classList.contains('hidden')) {
            dropdown.classList.add('hidden');
            document.getElementById('dropdown-arrow').classList.remove('rotate-180');
        }
        
        if (!event.target.closest('.border-t') && !userDropdown.classList.contains('hidden')) {
            userDropdown.classList.add('hidden');
            document.getElementById('user-dropdown-arrow').classList.remove('rotate-180');
        }
    });
    
    // Initialize desktop toggle button position
    desktopToggle.style.left = '16rem';
});
</script>