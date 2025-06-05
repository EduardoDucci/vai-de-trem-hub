document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('btnValidar').addEventListener('click', function (event) {
      event.preventDefault();
  
      const d1 = document.getElementById('digito-1').value.trim();
      const d2 = document.getElementById('digito-2').value.trim();
      const d3 = document.getElementById('digito-3').value.trim();
      const d4 = document.getElementById('digito-4').value.trim();
      const codigo = d1 + d2 + d3 + d4;
  
      const mensagem = document.getElementById('mensagemErro');
  
      if (codigo.length < 4) {
        mensagem.textContent = "⚠️ Você precisa inserir os 4 dígitos do código!";
      } else if (codigo !== "1234") {
        mensagem.textContent = "❌ Código incorreto. Tente novamente.";
      } else {
        mensagem.textContent = "";
        window.location.href = "numero__novo.html";
      }
    });
  });
  