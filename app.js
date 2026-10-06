document.querySelectorAll('.toggle-pass').forEach(function (btn) {
  btn.addEventListener('click', function () {
    var input = document.getElementById(btn.dataset.target);
    var visible = input.type === 'text';
    input.type = visible ? 'password' : 'text';
    btn.textContent = visible ? 'Mostrar' : 'Ocultar';
  });
});
