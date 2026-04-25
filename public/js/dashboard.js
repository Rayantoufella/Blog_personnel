// ── Cursor glow ──
const cg = document.getElementById('cg');
document.addEventListener('mousemove', function(e) {
  cg.style.left = e.clientX + 'px';
  cg.style.top  = e.clientY + 'px';
});

// ── Orb parallax ──
const o1 = document.querySelector('.orb-1'), o2 = document.querySelector('.orb-2');
document.addEventListener('mousemove', function(e) {
  const x = (e.clientX / window.innerWidth  - 0.5) * 32;
  const y = (e.clientY / window.innerHeight - 0.5) * 32;
  o1.style.transform = 'translate(' + x + 'px, ' + y + 'px)';
  o2.style.transform = 'translate(' + (-x * 0.7) + 'px, ' + (-y * 0.7) + 'px)';
});

// ── Scroll reveal (staggered) ──
const obs = new IntersectionObserver(function(entries) {
  entries.forEach(function(e, i) {
    if (e.isIntersecting) setTimeout(function() { e.target.classList.add('visible'); }, i * 55);
  });
}, { threshold: 0.05 });
document.querySelectorAll('.reveal').forEach(function(el) { obs.observe(el); });

// ── Filter by status ──
var currentStatus = 'all';
var currentSearch = '';

function setStatusFilter(chip, status) {
  document.querySelectorAll('.filter-pill').forEach(function(c) { c.classList.remove('active'); });
  chip.classList.add('active');
  currentStatus = status;
  applyFilters();
}

function filterRows(q) {
  currentSearch = q.toLowerCase();
  applyFilters();
}

function applyFilters() {
  var rows = document.querySelectorAll('#tableBody tr');
  var visible = 0;
  rows.forEach(function(row) {
    var sm = currentStatus === 'all' || row.dataset.status === currentStatus;
    var qm = currentSearch === '' || (row.dataset.title && row.dataset.title.includes(currentSearch));
    row.style.display = (sm && qm) ? '' : 'none';
    if (sm && qm) visible++;
  });
  document.getElementById('articleCount').textContent = visible + ' article' + (visible > 1 ? 's' : '');
  document.getElementById('emptyState').style.display = visible === 0 ? 'block' : 'none';
}

// ── Delete modal ──
var pendingDeleteId = null;

function openDeleteModal(name, id) {
  pendingDeleteId = id;
  document.getElementById('modalArticleName').textContent = '« ' + name + ' »';
  var form = document.getElementById('deleteForm');
  form.action = '/articles/' + id + '/delete';
  document.getElementById('deleteModal').classList.add('open');
}

function closeDeleteModal() {
  document.getElementById('deleteModal').classList.remove('open');
}

function closeModalBackdrop(e) {
  if (e.target === document.getElementById('deleteModal')) closeDeleteModal();
}

document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') closeDeleteModal();
});

// ── Tweaks panel ──
window.addEventListener('message', function(e) {
  if (e.data && e.data.type === '__activate_edit_mode')   document.getElementById('tweakPanel').style.display = 'block';
  if (e.data && e.data.type === '__deactivate_edit_mode') document.getElementById('tweakPanel').style.display = 'none';
});
window.parent.postMessage({ type: '__edit_mode_available' }, '*');

function applyTweak(k, v) {
  if (k === 'accentColor') {
    document.documentElement.style.setProperty('--accent', v);
    document.querySelector('.logo-box').style.background = 'linear-gradient(135deg,' + v + ',#EC4899)';
    document.querySelectorAll('.btn-primary').forEach(function(b) { b.style.background = 'linear-gradient(135deg,' + v + ',#EC4899)'; });
    document.querySelectorAll('.filter-pill.active').forEach(function(p) { p.style.background = 'linear-gradient(135deg,' + v + ',#EC4899)'; });
  }
  if (k === 'showTimeline') {
    var bg = document.getElementById('bottomGrid');
    bg.style.gridTemplateColumns = v ? '1fr 340px' : '1fr';
    bg.querySelector(':first-child').style.display = v ? '' : 'none';
  }
  if (k === 'showViews') {
    document.querySelectorAll('.col-views').forEach(function(el) { el.style.display = v ? '' : 'none'; });
  }
  window.parent.postMessage({ type: '__edit_mode_set_keys', edits: { [k]: v } }, '*');
}

// ── Stat counter animation ──
document.querySelectorAll('.stat-value').forEach(function(el) {
  var target = parseFloat(el.textContent.replace(/[^0-9.]/g, ''));
  if (isNaN(target) || target === 0) return;
  var duration = 1200;
  var startTime = null;
  function step(ts) {
    if (!startTime) startTime = ts;
    var progress = Math.min((ts - startTime) / duration, 1);
    var ease = 1 - Math.pow(1 - progress, 3);
    var current = Math.round(ease * target);
    el.textContent = el.textContent.replace(/\d[\d,]*/, current.toLocaleString());
    if (progress < 1) requestAnimationFrame(step);
  }
  setTimeout(function() { requestAnimationFrame(step); }, 300);
});
