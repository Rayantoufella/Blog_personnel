/**
 * ════════════════════════════════════════════════════════════════
 * GLOBAL JS - Blog Personnel
 * ════════════════════════════════════════════════════════════════
 */

console.log('✨ Blog Personnel - App initialized');

/**
 * Utilitaires globales
 */
const AppUtils = {
  /**
   * Afficher une notification
   */
  notify(message, type = 'success') {
    console.log(`[${type.toUpperCase()}] ${message}`);
  },

  /**
   * Confirmer une action
   */
  confirm(message) {
    return confirm(message);
  },

  /**
   * Copier au presse-papiers
   */
  copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
      this.notify('Copié !', 'success');
    });
  },

  /**
   * Format date
   */
  formatDate(date) {
    return new Intl.DateTimeFormat('fr-FR', {
      year: 'numeric',
      month: 'long',
      day: 'numeric'
    }).format(new Date(date));
  }
};

/**
 * Initialisation au chargement du DOM
 */
document.addEventListener('DOMContentLoaded', () => {
  console.log('✓ DOM loaded');
});
