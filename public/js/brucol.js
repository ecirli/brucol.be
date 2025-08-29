document.addEventListener('DOMContentLoaded', function() {
    const isCoursesPage = window.location.pathname.includes('courses') || window.location.pathname.includes('courses.php');
    const isHomePage = window.location.pathname === '/' || window.location.pathname.includes('home');
    
    // Portfolio filter functionality
    function initPortfolioFilters() {
        const container = document.querySelector('.portfolio-filter');
        if (!container) return;

        const handleFilterEvent = (e) => {
            const link = e.target.closest('a[data-filter]');
            if (!link) return;
            e.preventDefault();
            e.stopPropagation();

            // Remove active class from all tabs
            container.querySelectorAll('li.nav').forEach(li => li.classList.remove('active'));
            
            // Add active class to clicked tab
            const parentLi = link.closest('li.nav');
            if (parentLi) parentLi.classList.add('active');

            const filterValue = link.getAttribute('data-filter') || '*';
            applyFilter(filterValue);
        };

        // Add event listeners for both desktop and mobile
        container.addEventListener('click', handleFilterEvent, { passive: false });
        container.addEventListener('pointerup', handleFilterEvent, { passive: false });
    }

    // Apply filter to portfolio items
    function applyFilter(filterValue) {
        // Try Isotope first if available
        if (typeof $ !== 'undefined' && $.fn.isotope) {
            $('.portfolio-wrapper').isotope({
                filter: filterValue === '*' ? '*' : filterValue
            });
            return;
        }

        // Fallback manual filtering
        const items = document.querySelectorAll('.portfolio-wrapper .grid-item');
        const targetClass = filterValue === '*' ? null : filterValue.substring(1);
        
        items.forEach(item => {
            const shouldShow = filterValue === '*' || item.classList.contains(targetClass);
            item.style.display = shouldShow ? 'block' : 'none';
            item.style.opacity = shouldShow ? '1' : '0';
        });

        // Trigger layout recalculation
        setTimeout(() => {
            window.dispatchEvent(new Event('resize'));
        }, 50);
    }

    // Initialize Isotope if available
    function initIsotope() {
        if (typeof $ !== 'undefined' && $.fn.isotope) {
            const $grid = $('.portfolio-wrapper');
            if (!$grid.data('isotope')) {
                $grid.isotope({
                    itemSelector: '.grid-item',
                    layoutMode: 'fitRows',
                    percentPosition: true
                });
            }
        }
    }

    // Handle courses page URL filtering
    if (isCoursesPage) {
        initIsotope();
        initPortfolioFilters();
        
        // Check for URL filter parameter
        const urlParams = new URLSearchParams(window.location.search);
        const filterParam = urlParams.get('filter');
        
        if (filterParam) {
            const filterMap = {
                'foundation': '.foundation',
                'undergraduate': '.undergraduate', 
                'graduate': '.graduate',
                'all': '*'
            };
            
            const dataFilter = filterMap[filterParam.toLowerCase()];
            
            if (dataFilter) {
                // Set active tab
                const selectedTab = document.querySelector(`.portfolio-filter a[data-filter="${dataFilter}"]`);
                if (selectedTab) {
                    document.querySelectorAll('.portfolio-filter .nav').forEach(nav => {
                        nav.classList.remove('active');
                    });
                    selectedTab.parentElement.classList.add('active');
                }
                
                // Apply filter
                applyFilter(dataFilter);
                
                // Scroll to tabs section
                setTimeout(() => {
                    const tabsSection = document.querySelector('.portfolio-filter');
                    if (tabsSection) {
                        tabsSection.scrollIntoView({ 
                            behavior: 'smooth', 
                            block: 'start' 
                        });
                    }
                }, 100);
            }
        }
    }

    // Handle home page
    if (isHomePage) {
        initIsotope();
        initPortfolioFilters();
        
        // Show all items by default
        setTimeout(() => {
            applyFilter('*');
        }, 100);
    }

    // Additional utility functions that might be used by other scripts
    
    // Smooth scroll functionality (if needed by header menu)
    function initSmoothScroll() {
        const scrollLinks = document.querySelectorAll('a[href^="#"]');
        scrollLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    e.preventDefault();
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    }

    // Initialize smooth scroll
    initSmoothScroll();

    // Mobile menu toggle (if needed)
    function initMobileMenu() {
        const mobileToggle = document.querySelector('.navbar-toggler');
        const mobileMenu = document.querySelector('.navbar-collapse');
        
        if (mobileToggle && mobileMenu) {
            // Close menu when clicking on menu items
            const menuItems = mobileMenu.querySelectorAll('a');
            menuItems.forEach(item => {
                item.addEventListener('click', () => {
                    if (mobileMenu.classList.contains('show')) {
                        mobileToggle.click();
                    }
                });
            });
        }
    }

    // Initialize mobile menu
    initMobileMenu();

    // Window resize handler for responsive adjustments
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            // Refresh isotope layout if available
            if (typeof $ !== 'undefined' && $.fn.isotope) {
                $('.portfolio-wrapper').isotope('layout');
            }
        }, 250);
    });
});