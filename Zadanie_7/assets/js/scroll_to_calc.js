window.addEventListener('load', () => {
  const target = document.getElementById('one');
  if (target) {
    target.scrollIntoView({ behavior: 'instant' });
  }
});