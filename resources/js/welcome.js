/**
 * ════════════════════════════════════════════════════════════════
 * WELCOME JS - Home Page
 * ════════════════════════════════════════════════════════════════
 */

document.addEventListener('DOMContentLoaded', () => {
  console.log('✓ Welcome page loaded');

  /**
   * Filter articles by category
   */
  const filterBtns = document.querySelectorAll('.filter-btn');
  const articleCards = document.querySelectorAll('.article-card');

  filterBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const selectedCategory = btn.dataset.category;

      // Update active button
      filterBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      // Filter articles
      articleCards.forEach(card => {
        const cardCategory = card.dataset.category;
        if (selectedCategory === 'all' || cardCategory === selectedCategory) {
          card.style.display = '';
          setTimeout(() => {
            card.style.opacity = '1';
          }, 10);
        } else {
          card.style.display = 'none';
        }
      });
    });
  });

  /**
   * Cursor glow effect
   */
  const orbs = document.querySelectorAll('.orb-cursor');
  if (orbs.length > 0) {
    document.addEventListener('mousemove', (e) => {
      orbs.forEach(orb => {
        orb.style.left = e.clientX + 'px';
        orb.style.top = e.clientY + 'px';
      });
    });
  }

  /**
   * Newsletter form
   */
  const newsletterForm = document.querySelector('.newsletter-form');
  if (newsletterForm) {
    newsletterForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const email = newsletterForm.querySelector('input[type="email"]').value;
      console.log('Newsletter signup:', email);
      alert('Merci ! Vous êtes abonné à la newsletter.');
      newsletterForm.reset();
    });
  }
});
