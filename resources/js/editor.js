/**
 * ════════════════════════════════════════════════════════════════
 * ARTICLES JS - Create / Edit Pages
 * ════════════════════════════════════════════════════════════════
 */

document.addEventListener('DOMContentLoaded', () => {
  console.log('✓ Article editor page loaded');

  const contentTextarea = document.getElementById('contenu');
  const wordCount = document.getElementById('wordCount');
  const charCount = document.getElementById('charCount');
  const readTime = document.getElementById('readTime');

  /**
   * Mettre à jour les stats
   */
  function updateStats() {
    if (!contentTextarea) return;

    const text = contentTextarea.value;
    const words = text.trim().split(/\s+/).filter(w => w.length > 0).length;
    const chars = text.length;
    const minutes = Math.ceil(words / 200); // 200 words per minute average

    if (wordCount) wordCount.textContent = words;
    if (charCount) charCount.textContent = chars;
    if (readTime) readTime.textContent = `${minutes} min`;
  }

  if (contentTextarea) {
    contentTextarea.addEventListener('input', updateStats);
    contentTextarea.addEventListener('keyup', () => {
      // Auto-resize textarea
      contentTextarea.style.height = 'auto';
      contentTextarea.style.height = Math.max(300, contentTextarea.scrollHeight) + 'px';
      updateStats();
    });

    // Initial stats
    updateStats();
  }

  /**
   * Toolbar buttons
   */
  const toolbarButtons = document.querySelectorAll('.toolbar button');
  toolbarButtons.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const action = btn.dataset.action;

      if (!contentTextarea) return;

      const start = contentTextarea.selectionStart;
      const end = contentTextarea.selectionEnd;
      const selected = contentTextarea.value.substring(start, end);
      let insert = '';

      switch (action) {
        case 'bold':
          insert = `**${selected}**`;
          break;
        case 'italic':
          insert = `*${selected}*`;
          break;
        case 'underline':
          insert = `__${selected}__`;
          break;
        case 'link':
          insert = `[${selected}](url)`;
          break;
        case 'code':
          insert = `` `${selected}` ``;
          break;
        case 'list':
          insert = `- ${selected}`;
          break;
        case 'quote':
          insert = `> ${selected}`;
          break;
        case 'heading':
          insert = `## ${selected}`;
          break;
      }

      if (insert) {
        contentTextarea.value =
          contentTextarea.value.substring(0, start) +
          insert +
          contentTextarea.value.substring(end);
        updateStats();
      }
    });
  });

  /**
   * Handle unsaved changes warning
   */
  let hasChanges = false;

  if (contentTextarea) {
    contentTextarea.addEventListener('change', () => {
      hasChanges = true;
    });
  }

  const form = document.querySelector('form');
  if (form) {
    form.addEventListener('submit', () => {
      hasChanges = false;
    });
  }

  window.addEventListener('beforeunload', (e) => {
    if (hasChanges) {
      e.preventDefault();
      e.returnValue = '';
    }
  });
});
