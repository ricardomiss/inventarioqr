const form = document.getElementById('login-form');

form.addEventListener('submit', function(event) {
  event.preventDefault();

  const usernameInput = document.getElementById('username');
  const passwordInput = document.getElementById('password');
  const username = usernameInput.value.trim();
  const password = passwordInput.value.trim();

  if (!username || !password) {
    alert('Please enter your username and password');
    return;
  }

  // Simulated login validation - replace with your own logic
  if (username !== 'jesusperezhidalgo50@gmail.com' || password !== '1234567890') {
    alert('Correo electronico o contraseña no válida');
    return;
  }

  // Successful login
  window.location.replace('../QRHerramientas.html');
});

