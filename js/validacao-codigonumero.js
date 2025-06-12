document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('btnValidar');
    const mensagem = document.getElementById('mensagemErro');
  
    const d1 = document.getElementById('digito-1');
    const d2 = document.getElementById('digito-2');
    const d3 = document.getElementById('digito-3');
    const d4 = document.getElementById('digito-4');
  
    btn.addEventListener('click', function (event) {
      event.preventDefault();
  
      const codigo = d1.value.trim() + d2.value.trim() + d3.value.trim() + d4.value.trim();
  
      if (codigo.length < 4) {
        mensagem.textContent = "⚠️ Você precisa inserir os 4 dígitos do código!";
      } else if (codigo !== "1234") {
        mensagem.textContent = "❌ Código incorreto. Tente novamente.";
      } else {
        mensagem.textContent = "";
        window.location.href = "numero__novo.html";
      }
    });
  
    document.addEventListener('keydown', function (event) {
      if (event.key === 'Enter') {
        event.preventDefault();
        btn.click();
      }
    });

    const inputs = [d1, d2, d3, d4];
    inputs.forEach((input, index) => {
      input.addEventListener('input', () => {
        if (input.value.length === 1 && index < inputs.length - 1) {
          inputs[index + 1].focus();
        }
      });
  
      input.addEventListener('keydown', (event) => {
        if (event.key === 'Backspace' && input.value === '' && index > 0) {
          inputs[index - 1].focus();
        }
      });
    });
  });
  