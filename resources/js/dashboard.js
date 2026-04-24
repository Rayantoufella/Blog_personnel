/**
 * ════════════════════════════════════════════════════════════════
 * DASHBOARD JS
 * ════════════════════════════════════════════════════════════════
 */

document.addEventListener('DOMContentLoaded', () => {
  console.log('✓ Dashboard page loaded');

  // Search functionality
  const searchInput = document.getElementById('searchArticles');
  const articleRows = document.querySelectorAll('.article-row');

  if (searchInput) {
    searchInput.addEventListener('keyup', (e) => {
      const searchTerm = e.target.value.toLowerCase();
      articleRows.forEach(row => {
        const title = row.querySelector('.article-title').textContent.toLowerCase();
        const category = row.querySelector('.article-category').textContent.toLowerCase();
        const isVisible = title.includes(searchTerm) || category.includes(searchTerm);
        row.style.display = isVisible ? '' : 'none';
      });
    });
  }

  // Delete modal
  const deleteButtons = document.querySelectorAll('.btn-delete');
  const modal = document.getElementById('deleteModal');
  const modalCancel = document.getElementById('modalCancel');
  const modalConfirm = document.getElementById('modalConfirm');
  let deleteForm = null;

  deleteButtons.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      deleteForm = btn.closest('form');
      modal.classList.add('active');
    });
  });

  if (modalCancel) {
    modalCancel.addEventListener('click', () => {
      modal.classList.remove('active');
    });
  }

  if (modalConfirm) {
    modalConfirm.addEventListener('click', () => {
      if (deleteForm) {
        deleteForm.submit();
      }
    });
  }

  // Close modal when clicking outside
  if (modal) {
    modal.addEventListener('click', (e) => {
      if (e.target === modal) {
        modal.classList.remove('active');
      }
    });
  }
});
