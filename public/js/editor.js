/* ========================================
   EDITOR PAGE JS - Edit Article
   ======================================== */

let isDirty = false;
let originalData = {};

document.addEventListener('DOMContentLoaded', function() {
    initCursorGlow();
    initRevealAnimation();
    initEditor();
    initCategorySelection();
    initStatusSelection();
    initDeleteModal();
    initFormTracking();
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
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    
    reveals.forEach(reveal => observer.observe(reveal));
}

/**
 * Initialize editor
 */
function initEditor() {
    const titleInput = document.getElementById('titleInput');
    const contentInput = document.getElementById('contentInput');
    
    if (titleInput) {
        titleInput.addEventListener('input', onContentChange);
        titleInput.addEventListener('keydown', handleTitleKey);
    }
    
    if (contentInput) {
        contentInput.addEventListener('input', function() {
            onContentChange();
            updateStats();
        });
    }
    
    // Auto-resize title textarea
    if (titleInput) {
        autoResize(titleInput);
    }
}

/**
 * Auto-resize textarea
 */
window.autoResize = function(textarea) {
    textarea.style.height = 'auto';
    textarea.style.height = (textarea.scrollHeight) + 'px';
};

/**
 * Handle title key events
 */
window.handleTitleKey = function(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        document.getElementById('contentInput').focus();
    }
};

/**
 * Sync topbar title
 */
window.syncTopbarTitle = function(value) {
    const topbarTitle = document.getElementById('topbarTitle');
    if (topbarTitle) {
        topbarTitle.textContent = value.substring(0, 40) + (value.length > 40 ? '...' : '');
    }
};

/**
 * Track content changes
 */
window.onContentChange = function() {
    isDirty = true;
    updateSaveStatus(false);
};

/**
 * Update save status indicator
 */
function updateSaveStatus(isSaved) {
    const saveDot1 = document.getElementById('saveDot');
    const saveLabel1 = document.getElementById('saveLabel');
    const saveDot2 = document.getElementById('saveDot2');
    const saveLabel2 = document.getElementById('saveLabel2');
    
    if (isSaved) {
        if (saveDot1) {
            saveDot1.classList.add('saved');
            saveLabel1.textContent = 'Tout est à jour';
            saveLabel1.style.color = 'var(--green)';
        }
        if (saveDot2) {
            saveDot2.classList.add('saved');
            saveLabel2.textContent = 'Tout est à jour';
            saveLabel2.style.color = 'var(--green)';
        }
        isDirty = false;
    } else {
        if (saveDot1) {
            saveDot1.classList.remove('saved');
            saveLabel1.textContent = 'Non sauvegardé';
            saveLabel1.style.color = 'var(--text-3)';
        }
        if (saveDot2) {
            saveDot2.classList.remove('saved');
            saveLabel2.textContent = 'Non sauvegardé';
            saveLabel2.style.color = 'var(--text-3)';
        }
    }
}

/**
 * Update word/character count
 */
window.updateStats = function() {
    const content = document.getElementById('contentInput')?.value || '';
    const words = content.trim().split(/\s+/).filter(w => w).length;
    const chars = content.length;
    const readTime = Math.max(1, Math.ceil(words / 200));
    
    const wordCountEl = document.getElementById('wordCount');
    const readTimeEl = document.getElementById('readTime');
    const charCountEl = document.getElementById('charCountSide');
    
    if (wordCountEl) wordCountEl.textContent = words;
    if (readTimeEl) readTimeEl.textContent = readTime + ' min';
    if (charCountEl) charCountEl.textContent = chars;
};

/**
 * Initialize category selection
 */
function initCategorySelection() {
    window.selectCat = function(element, catId) {
        document.querySelectorAll('.cat-option').forEach(opt => {
            opt.classList.remove('selected');
        });
        element.classList.add('selected');
        document.getElementById('catInput').value = catId;
        onContentChange();
    };
}

/**
 * Initialize status selection
 */
function initStatusSelection() {
    window.selectStatus = function(status) {
        document.querySelectorAll('.status-option').forEach(opt => {
            opt.classList.remove('selected');
        });
        
        if (status === 'brouillon') {
            document.getElementById('statusDraft').classList.add('selected');
        } else {
            document.getElementById('statusPublished').classList.add('selected');
        }
        
        document.getElementById('statutInput').value = status;
        onContentChange();
    };
}

/**
 * Set statut and submit
 */
window.setStatutAndSubmit = function(statut) {
    document.getElementById('statutInput').value = statut;
};

/**
 * Initialize delete modal
 */
function initDeleteModal() {
    const modal = document.getElementById('deleteModal');
    const confirmInput = document.getElementById('confirmInput');
    const deleteBtn = document.getElementById('deleteConfirmBtn');
    
    window.openDeleteModal = function() {
        modal.classList.add('show');
        confirmInput.focus();
    };
    
    window.closeDeleteModal = function() {
        modal.classList.remove('show');
        confirmInput.value = '';
        deleteBtn.disabled = true;
    };
    
    window.overlayClose = function(event) {
        if (event.target === modal) {
            closeDeleteModal();
        }
    };
    
    window.checkConfirm = function(value) {
        deleteBtn.disabled = value.toUpperCase() !== 'SUPPRIMER';
    };
    
    window.confirmDelete = function() {
        document.getElementById('deleteForm').submit();
    };
}

/**
 * Track form changes
 */
function initFormTracking() {
    const mainForm = document.getElementById('mainForm');
    if (!mainForm) return;
    
    mainForm.addEventListener('submit', function(e) {
        updateSaveStatus(true);
    });
}
