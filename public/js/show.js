// Cursor glow
const cg = document.getElementById('cg');
document.addEventListener('mousemove', function(e) {
  cg.style.left = e.clientX + 'px';
  cg.style.top  = e.clientY + 'px';
});

// Scroll reveal
const obs = new IntersectionObserver(function(es) {
  es.forEach(function(e) {
    if (e.isIntersecting) e.target.classList.add('visible');
  });
}, { threshold: 0.05 });
document.querySelectorAll('.reveal').forEach(function(el) { obs.observe(el); });
