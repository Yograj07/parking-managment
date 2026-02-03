const sidebar = document.getElementById('sidebar');
const toggleBtn = document.getElementById('menuToggle');
const overlay = document.getElementById('overlay');

if (toggleBtn) {
  toggleBtn.addEventListener('click', () => {
    sidebar.classList.toggle('open');
    toggleBtn.classList.toggle('active');
    overlay.classList.toggle('show');
    document.body.classList.toggle('no-scroll');
  });
}

if (overlay) {
  overlay.addEventListener('click', closeSidebar);
}

function closeSidebar() {
  sidebar.classList.remove('open');
  toggleBtn.classList.remove('active');
  overlay.classList.remove('show');
  document.body.classList.remove('no-scroll');
}

const pageLoader = document.getElementById('pageLoader');
if (pageLoader) {
  window.addEventListener('load', () => {
    pageLoader.classList.add('hide');
    setTimeout(() => pageLoader.remove(), 400);
  });
}
