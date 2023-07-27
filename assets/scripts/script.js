function openPopup() {
    var popup = document.createElement("div");
    popup.className = "popup";
    popup.innerHTML = "Este es el contenido de la ventana emergente.";
    document.body.appendChild(popup);
  }
  
  const myButtons = document.querySelectorAll('.windowPop-up');
  const popup = document.querySelector('.popup');
  
  for (let i = 0; i < myButtons.length; i++) {
    myButtons[i].addEventListener('click', function() {
      popup.style.display = 'block';
    });
  }

//////////////////////////////////////////////////////////////////////////////////////////
  
const buttonsCerrar = document.querySelectorAll('.closeWindows');
buttonsCerrar.forEach(button => {
  button.addEventListener('click', cerrarPopup);
});

function cerrarPopup() {
  const popup = document.querySelector('.popup');
  popup.style.display = 'none';
}  