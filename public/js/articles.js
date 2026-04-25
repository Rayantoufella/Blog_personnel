/* ========================================
   ARTICLES CREATE PAGE JS
   ======================================== */

document.addEventListener('DOMContentLoaded', function() {
    initOrbs();
    initFormValidation();
});

/**
 * Initialize orbs animation
 */
function initOrbs() {
    const orbs = document.querySelectorAll('.orb');
    
    window.addEventListener('scroll', () => {
        orbs.forEach((orb, index) => {
            const offset = window.scrollY * (0.3 + index * 0.1);
            orb.style.transform = `translateY(${offset}px)`;
        });
    });
}

/**
 * Initialize form validation
 */
function initFormValidation() {
    const form = document.querySelector('form');
    if (!form) return;
    
    form.addEventListener('submit', function(e) {
        return validateForm(this);
    });
}

/**
 * Validate form before submission
 */
function validateForm(form) {
    const titre = form.querySelector('#titre');
    const category = form.querySelector('#category_id');
    const contenu = form.querySelector('#contenu');
    
    if (!titre?.value.trim()) {
        showError('Title is required');
        return false;
    }
    
    if (!category?.value) {
        showError('Category is required');
        return false;
    }
    
    if (!contenu?.value.trim()) {
        showError('Content is required');
        return false;
    }
    
    return true;
}

/**
 * Show error message
 */
function showError(message) {
    console.error(message);
    alert(message);
}

/**
 * Character counter for textarea
 */
function initCharCounter() {
    const textarea = document.querySelector('#contenu');
    if (!textarea) return;
    
    textarea.addEventListener('input', function() {
        const count = this.value.length;
        console.log(`Characters: ${count}`);
    });
}

// Initialize character counter
initCharCounter();
