/* ========================================
   SHOW ARTICLE PAGE JS
   ======================================== */

document.addEventListener('DOMContentLoaded', function() {
    initCursorGlow();
    initRevealAnimation();
    initArticleTracking();
    initSmoothScroll();
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
 * Track article view (optional - for analytics)
 */
function initArticleTracking() {
    const articleContainer = document.querySelector('.article-container');
    if (!articleContainer) return;
    
    // Track scroll progress
    let scrollProgress = 0;
    window.addEventListener('scroll', () => {
        const scrolled = window.scrollY;
        const height = document.documentElement.scrollHeight - window.innerHeight;
        scrollProgress = Math.round((scrolled / height) * 100);
        
        // Could send this to analytics
        console.log(`Article scroll: ${scrollProgress}%`);
    });
}

/**
 * Initialize smooth scroll for internal links
 */
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href === '#') return;
            
            e.preventDefault();
            const target = document.querySelector(href);
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
}

/**
 * Copy article link
 */
function copyArticleLink() {
    const url = window.location.href;
    navigator.clipboard.writeText(url).then(() => {
        console.log('Link copied to clipboard');
    });
}

/**
 * Share article (if supported)
 */
async function shareArticle() {
    const title = document.querySelector('.article-title')?.textContent || 'Check this article';
    const url = window.location.href;
    
    if (navigator.share) {
        try {
            await navigator.share({
                title: title,
                url: url
            });
        } catch (err) {
            console.log('Share cancelled');
        }
    } else {
        copyArticleLink();
    }
}
