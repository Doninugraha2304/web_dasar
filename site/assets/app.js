// Dark mode toggle
(function () {
  const saved = localStorage.getItem('theme');
  if (saved) document.documentElement.setAttribute('data-theme', saved);
  else if (window.matchMedia('(prefers-color-scheme: light)').matches)
    document.documentElement.setAttribute('data-theme', 'light');

  document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('themeToggle');
    if (btn) {
      btn.addEventListener('click', () => {
        const cur = document.documentElement.getAttribute('data-theme') === 'light' ? 'dark' : 'light';
        if (cur === 'light') document.documentElement.setAttribute('data-theme', 'light');
        else document.documentElement.removeAttribute('data-theme');
        localStorage.setItem('theme', cur === 'light' ? 'light' : 'dark');
      });
    }
    // copy buttons
    document.querySelectorAll('.code-block').forEach((block) => {
      const btn = document.createElement('button');
      btn.className = 'copy-btn';
      btn.textContent = 'Copy';
      btn.addEventListener('click', async () => {
        const code = block.querySelector('pre')?.innerText || block.innerText;
        try {
          await navigator.clipboard.writeText(code);
          btn.textContent = 'Copied!';
          setTimeout(() => (btn.textContent = 'Copy'), 1500);
        } catch (e) {
          btn.textContent = 'Error';
        }
      });
      block.appendChild(btn);
    });
  });
})();
