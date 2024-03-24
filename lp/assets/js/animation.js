
//animar el formulario de registro 
const tl = gsap.timeline();

tl.from('#register-container', { duration: 1, opacity: 0 })
  .from('#titulo', { duration: 1, y: -50, opacity: 0 })
  .from('#subtitulo', { duration: 1, y: -50, opacity: 0 })
  .from('#register-form', { duration: 1, y: -50, opacity: 0 })
  .from('#input-group1', { duration: 1, x: -50, opacity: 0 }, '-=.5')
  .from('#doc_type', { duration: 1, x: -50, opacity: 0 }, '-=.5')
  .from('#input-group3', { duration: 1, x: -50, opacity: 0 }, '-=.5')
  .from('#check2', { duration: 1, x: -50, opacity: 0 }, '-=.5')
  .from('#col-btn', { duration: 1, y: 50, opacity: 0 }, '-=.5');

$(document).ready(function() {
  tl.play();
});

