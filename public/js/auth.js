/* ========================================
   AUTH PAGE JS - Login Form
   ======================================== */

document.addEventListener('DOMContentLoaded', function() {
    initPasswordToggle();
});

/**
 * Toggle password visibility
 */
function initPasswordToggle() {
    const toggle = document.getElementById('passwordToggle');
    const input = document.getElementById('password');
    
    if (!toggle || !input) return;
    
    toggle.addEventListener('click', function(e) {
        e.preventDefault();
        
        const isPassword = input.type === 'password';
        input.type = isPassword ? 'text' : 'password';
        this.textContent = isPassword ? '🙈' : '👁️';
    });
}

/**
 * Optional: Handle form submission with validation
 */
function validateForm(form) {
    const email = form.querySelector('#email');
    const password = form.querySelector('#password');
    
    if (!email.value) {
        showError('Email is required');
        return false;
    }
    
    if (!password.value) {
        showError('Password is required');
        return false;
    }
    
    return true;
}

/**
 * Show error message
 */
function showError(message) {
    console.error(message);
}
