// Copy code buttons
document.addEventListener('DOMContentLoaded', () => {
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
