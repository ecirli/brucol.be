// Only run on courses page
if (window.location.pathname.includes('courses') || window.location.pathname.includes('courses.php')) {
    document.addEventListener('DOMContentLoaded', function() {
        // Get URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        const filterParam = urlParams.get('filter');
        
        // If any filter is requested
        if (filterParam) {
            // Map filter parameters to data-filter attributes
            const filterMap = {
                'foundation': '.foundation',
                'undergraduate': '.undergraduate',
                'graduate': '.graduate'
            };
            
            const dataFilter = filterMap[filterParam];
            
            if (dataFilter) {
                // Remove active class from all nav items
                document.querySelectorAll('.portfolio-filter .nav').forEach(nav => {
                    nav.classList.remove('active');
                });
                
                // Add active class to selected tab
                const selectedTab = document.querySelector(`.portfolio-filter a[data-filter="${dataFilter}"]`);
                if (selectedTab) {
                    selectedTab.parentElement.classList.add('active');
                    
                    // Filter the grid items
                    const items = document.querySelectorAll('.portfolio-wrapper .grid-item');
                    items.forEach(item => {
                        if (dataFilter === '*' || item.classList.contains(dataFilter.substring(1))) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                    
                    // Scroll to the tabs section
                    setTimeout(function() {
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
    });
}

// Only run on home page
if (window.location.pathname === '/' || window.location.pathname.includes('home') || document.querySelector('#programmesAccordion')) {
    document.addEventListener('DOMContentLoaded', function() {
        const programmesAccordion = document.getElementById('programmesContent');
        const programmesIntro = document.getElementById('programmesIntro');
        const chevronIcon = document.querySelector('#programmesHeading i.fa-chevron-down');
        
        if (programmesAccordion && chevronIcon) {
            // Hide intro when accordion opens
            programmesAccordion.addEventListener('show.bs.collapse', function () {
                if (programmesIntro) programmesIntro.style.display = 'none';
                chevronIcon.style.transform = 'rotate(180deg)';
            });
            
            // Show intro when accordion closes
            programmesAccordion.addEventListener('hide.bs.collapse', function () {
                if (programmesIntro) programmesIntro.style.display = 'block';
                chevronIcon.style.transform = 'rotate(0deg)';
            });
            
            // Fix portfolio grid after accordion opens
            programmesAccordion.addEventListener('shown.bs.collapse', function () {
                setTimeout(function() {
                    // Show all portfolio items first
                    const allItems = document.querySelectorAll('.grid-item');
                    allItems.forEach(function(item) {
                        item.style.display = 'block';
                        item.style.opacity = '1';
                    });
                    
                    // Trigger layout recalculation
                    window.dispatchEvent(new Event('resize'));
                    
                    // If using Isotope, refresh it
                    if (typeof $ !== 'undefined' && $.fn.isotope) {
                        $('.portfolio-wrapper').isotope('layout');
                    }
                }, 150);
            });
        }
        
        // Fix portfolio filter functionality on home page
        const portfolioFilters = document.querySelectorAll('.portfolio-filter a');
        if (portfolioFilters.length > 0) {
            portfolioFilters.forEach(function(filter) {
                filter.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Remove active class from all filters
                    portfolioFilters.forEach(f => f.parentElement.classList.remove('active'));
                    
                    // Add active class to clicked filter
                    this.parentElement.classList.add('active');
                    
                    const filterValue = this.getAttribute('data-filter');
                    
                    // Apply filter
                    if (typeof $ !== 'undefined' && $.fn.isotope) {
                        $('.portfolio-wrapper').isotope({
                            filter: filterValue === '*' ? '*' : filterValue
                        });
                    } else {
                        // Fallback manual filtering
                        const items = document.querySelectorAll('.portfolio-wrapper .grid-item');
                        items.forEach(item => {
                            if (filterValue === '*' || item.classList.contains(filterValue.substring(1))) {
                                item.style.display = 'block';
                                item.style.opacity = '1';
                            } else {
                                item.style.display = 'none';
                                item.style.opacity = '0';
                            }
                        });
                    }
                });
            });
        }
    });
}