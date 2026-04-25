// ── Password toggle
const pwInput  = document.getElementById('password');
const eyeBtn   = document.getElementById('eyeBtn');
const icoEye   = document.getElementById('ico-eye');
const icoSlash = document.getElementById('ico-slash');

eyeBtn.addEventListener('click', () => {
    const show = pwInput.type === 'password';
    pwInput.type     = show ? 'text' : 'password';
    icoEye.style.display   = show ? 'none'  : 'block';
    icoSlash.style.display = show ? 'block' : 'none';
});

// ── Submit loading state
document.getElementById('loginForm').addEventListener('submit', () => {
    document.getElementById('submitBtn').classList.add('loading');
});
