// Archivo JS principal: comportamientos mínimos
document.addEventListener('DOMContentLoaded', function() {
  // Confirmaciones simples con data-confirm
  document.querySelectorAll('[data-confirm]').forEach(function(el){
    el.addEventListener('click', function(e){
      var msg = el.getAttribute('data-confirm') || '¿Estás seguro?';
      if(!confirm(msg)) e.preventDefault();
    });
  });
});