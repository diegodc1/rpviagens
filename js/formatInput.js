function formatar(mascara, documento){
  var i = documento.value.length;
  var saida = mascara.substring(0,1);
  var texto = mascara.substring(i)
  
  if (texto.substring(0,1) != saida){
            documento.value += texto.substring(0,1);
  }
}

function converter(valor) {
  var numero = parseFloat(valor).toLocaleString('pt-BR', {
    style: 'currency',
    currency: 'BRL'
  });
  document.getElementById('valor').value = numero;
}