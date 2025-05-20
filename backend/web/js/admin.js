// Toggle sidebar on mobile
document.getElementById('sidebarToggle')?.addEventListener('click', function() {
    document.getElementById('sidebar').classList.toggle('active');
});

// Close sidebar when clicking outside on mobile
document.addEventListener('click', function(event) {
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');

    if (window.innerWidth < 992 &&
        !sidebar.contains(event.target) &&
        event.target !== sidebarToggle &&
        !sidebarToggle.contains(event.target)) {
        sidebar.classList.remove('active');
    }
});

// Initialize tooltips
document.addEventListener('DOMContentLoaded', function() {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Initialize popovers
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });
});

// Confirm actions
document.addEventListener('click', function(e) {
    if (e.target && e.target.matches('[data-confirm]')) {
        e.preventDefault();
        const message = e.target.getAttribute('data-confirm');
        if (confirm(message)) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = e.target.href;
            document.body.appendChild(form);
            form.submit();
        }
    }
});

// Toggle sidebar collapse
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const sidebarCollapse = document.getElementById('sidebarCollapse');
    const sidebarToggle = document.getElementById('sidebarToggle');

    // Check localStorage for collapsed state
    const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
    if (isCollapsed) {
        sidebar.classList.add('sidebar-collapsed');
    }

    // Toggle sidebar collapse
    if (sidebarCollapse) {
        sidebarCollapse.addEventListener('click', function(e) {
            e.preventDefault();
            sidebar.classList.toggle('sidebar-collapsed');

            // Save state to localStorage
            const isNowCollapsed = sidebar.classList.contains('sidebar-collapsed');
            localStorage.setItem('sidebarCollapsed', isNowCollapsed);

            // Dispatch custom event if needed
            const event = new Event('sidebarCollapseChanged');
            document.dispatchEvent(event);
        });
    }

    // Mobile sidebar toggle
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
        });
    }

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(event) {
        if (window.innerWidth < 992 &&
            !sidebar.contains(event.target) &&
            event.target !== sidebarToggle &&
            !sidebarToggle.contains(event.target)) {
            sidebar.classList.remove('active');
        }
    });

    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 992) {
            sidebar.classList.remove('active');
        }
    });
});