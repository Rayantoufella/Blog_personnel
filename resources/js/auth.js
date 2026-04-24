/**
 * ════════════════════════════════════════════════════════════════
 * AUTH JS - Login Page
 * ════════════════════════════════════════════════════════════════
 */

document.addEventListener('DOMContentLoaded', () => {
  console.log('✓ Auth page loaded');

  // Toggle password visibility
  const passwordToggle = document.getElementById('passwordToggle');
  const passwordInput = document.getElementById('password');

  if (passwordToggle && passwordInput) {
    passwordToggle.addEventListener('click', () => {
      const isPassword = passwordInput.type === 'password';
      passwordInput.type = isPassword ? 'text' : 'password';
      passwordToggle.textContent = isPassword ? '🙈' : '👁️';
    });
  }

  // Focus effects
  const inputs = document.querySelectorAll('.form-group input');
  inputs.forEach(input => {
    input.addEventListener('focus', () => {
      input.parentElement.classList.add('focused');
    });
    input.addEventListener('blur', () => {
      input.parentElement.classList.remove('focused');
    });
  });
});
