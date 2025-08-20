// Tabs
document.querySelectorAll('[data-tabs]').forEach((wrap) => {
  const btns = wrap.querySelectorAll('[role="tab"]');
  const panels = wrap.querySelectorAll('.lh-demo__panel');

  btns.forEach((b) => b.addEventListener('click', () => {
    btns.forEach(x => { x.classList.remove('is-active'); x.setAttribute('aria-selected','false'); });
    panels.forEach(p => p.classList.remove('is-active'));
    b.classList.add('is-active');
    b.setAttribute('aria-selected','true');
    const panel = wrap.querySelector('#' + b.getAttribute('aria-controls'));
    panel.classList.add('is-active');
  }));
});

// Before/After slider
document.querySelectorAll('[data-beforeafter]').forEach((el) => {
  const [imgBefore, imgAfter] = el.querySelectorAll('img');
  const handle = el.querySelector('.ba-handle');

  function setSplit(x){
    const rect = el.getBoundingClientRect();
    const pct = Math.min(0.98, Math.max(0.02, (x - rect.left) / rect.width));
    imgBefore.style.clipPath = `inset(0 ${(1-pct)*100}% 0 0)`;
    handle.style.left = `${pct*100}%`;
    el.style.setProperty('--split', pct);
  }
  function pointer(e){ return e.touches ? e.touches[0].clientX : e.clientX; }

  let dragging = false;
  const start = (e) => { dragging = true; setSplit(pointer(e)); };
  const move  = (e) => { if (dragging) setSplit(pointer(e)); };
  const end   = () => { dragging = false; };

  el.addEventListener('mousedown', start);
  el.addEventListener('touchstart', start, {passive:true});
  window.addEventListener('mousemove', move);
  window.addEventListener('touchmove', move, {passive:true});
  window.addEventListener('mouseup', end);
  window.addEventListener('touchend', end);
});
