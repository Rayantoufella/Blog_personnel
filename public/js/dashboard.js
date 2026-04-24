/* ========================================
   DASHBOARD PAGE JS
   ======================================== */

document.addEventListener('DOMContentLoaded', function() {
    initCursorGlow();
    initRevealAnimation();
    initTableFilters();
    initDeleteModal();
    initSearch();
});

/**
 * Cursor glow effect
 */
function initCursorGlow() {
    const cursorGlow = document.getElementById('cg');
    if (!cursorGlow) return;
    
    document.addEventListener('mousemove', function(e) {
        cursorGlow.style.left = (e.clientX - 15) + 'px';
        cursorGlow.style.top = (e.clientY - 15) + 'px';
        cursorGlow.style.display = 'block';
    });
    
    document.addEventListener('mouseleave', function() {
        cursorGlow.style.display = 'none';
    });
}

/**
 * Reveal animation on scroll
 */
function initRevealAnimation() {
    const reveals = document.querySelectorAll('.reveal');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 50);
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1
    });
    
    reveals.forEach(reveal => {
        observer.observe(reveal);
    });
}

/**
 * Filter table rows by status
 */
function setStatusFilter(pill, status) {
    // Update active pill
    document.querySelectorAll('.filter-pill').forEach(p => {
        p.classList.remove('active');
    });
    pill.classList.add('active');
    
    // Filter rows
    filterRows(document.querySelector('.search-wrap input')?.value || '');
}

/**
 * Filter rows based on search and status
 */
function filterRows(searchValue) {
    const rows = document.querySelectorAll('#tableBody tr');
    const activeStatus = document.querySelector('.filter-pill.active')?.textContent.trim().toLowerCase();
    let visibleCount = 0;
    
    rows.forEach(row => {
        const title = row.dataset.title || '';
        const status = row.dataset.status || '';
        const statusText = status === 'publie' ? 'publiés' : 'brouillons';
        
        const matchesSearch = !searchValue || title.includes(searchValue.toLowerCase());
        const matchesStatus = !activeStatus || activeStatus === 'tous' || statusText.includes(activeStatus);
        
        if (matchesSearch && matchesStatus) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });
    
    // Update article count
    const countEl = document.getElementById('articleCount');
    if (countEl) {
        countEl.textContent = `${visibleCount} article${visibleCount !== 1 ? 's' : ''}`;
    }
}

/**
 * Initialize search
 */
function initSearch() {
    const searchInput = document.querySelector('.search-wrap input');
    if (searchInput) {
        searchInput.addEventListener('input', (e) => filterRows(e.target.value));
    }
}

/**
 * Initialize table filters
 */
function initTableFilters() {
    // Already initialized in setStatusFilter
}

/**
 * Initialize delete modal
 */
function initDeleteModal() {
    const modal = document.getElementById('deleteModal');
    if (!modal) return;
    
    window.openDeleteModal = function(title, id) {
        const articleName = document.getElementById('modalArticleName');
        const deleteForm = document.getElementById('deleteForm');
        
        if (articleName) {
            articleName.textContent = `"${title}"`;
        }
        
        if (deleteForm) {
            deleteForm.action = `/articles/${id}`;
        }
        
        modal.classList.add('show');
    };
    
    window.closeDeleteModal = function() {
        modal.classList.remove('show');
    };
    
    window.closeModalBackdrop = function(event) {
        if (event.target === modal) {
            closeDeleteModal();
        }
    };
}
