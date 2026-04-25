/* ========================================
   WELCOME PAGE JS - Home/Landing Page
   ======================================== */

document.addEventListener('DOMContentLoaded', function() {
    initCursorGlow();
    initRevealAnimation();
    initNewsletterForm();
    initFilterChips();
    initParallax();
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
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });
    
    reveals.forEach(reveal => {
        observer.observe(reveal);
    });
}

/**
 * Filter articles by category
 */
function setFilter(button, category) {
    // Update active button
    document.querySelectorAll('.chip').forEach(chip => {
        chip.classList.remove('active');
    });
    button.classList.add('active');
    
    // Filter cards
    const cards = document.querySelectorAll('[data-cat]');
    cards.forEach(card => {
        if (category === 'all' || card.dataset.cat === category) {
            card.style.display = '';
            card.style.opacity = '0';
            setTimeout(() => {
                card.style.opacity = '1';
            }, 10);
        } else {
            card.style.opacity = '0';
            setTimeout(() => {
                card.style.display = 'none';
            }, 300);
        }
    });
}

/**
 * Newsletter form submission
 */
function nlSubmit(e) {
    e.preventDefault();
    
    const form = e.target;
    const input = form.querySelector('.nl-input');
    const email = input.value;
    const successMsg = document.getElementById('nl-success');
    
    // Validate email
    if (!email || !isValidEmail(email)) {
        showNotification('Please enter a valid email', 'error');
        return;
    }
    
    // Simulate submission
    console.log('Newsletter subscription:', email);
    
    // Show success message
    successMsg.classList.add('show');
    input.value = '';
    
    // Hide after 5 seconds
    setTimeout(() => {
        successMsg.classList.remove('show');
    }, 5000);
}

/**
 * Validate email format
 */
function isValidEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

/**
 * Show notification
 */
function showNotification(message, type = 'info') {
    console.log(`[${type.toUpperCase()}] ${message}`);
}

/**
 * Parallax effect on scroll
 */
function initParallax() {
    const orbs = document.querySelectorAll('.orb');
    
    window.addEventListener('scroll', () => {
        orbs.forEach((orb, index) => {
            const offset = window.scrollY * (0.3 + index * 0.1);
            orb.style.transform = `translateY(${offset}px)`;
        });
    });
}

