<?php require_once 'conexion.php';?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Iniciar Sesión — Glow</title>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400&family=Syne:wght@600;800&display=swap" rel="stylesheet">
  <style>
    :root {
      --cream: #F5F0E8;
      --warm: #FAF8F4;
      --ink: #1A1714;
      --gold: #C9A96E;
      --mid: #7A6E65;
      --rose: #D4857A;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { background: var(--cream); color: var(--ink); font-family: 'Cormorant Garamond', serif; min-height: 100vh; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 20px; }

    .logo { font-family: 'Syne', sans-serif; font-weight: 800; font-size: 1.8rem; text-decoration: none; color: var(--ink); margin-bottom: 24px; }
    .logo .gold { color: var(--gold); }

    .auth-card { width: 100%; max-width: 440px; background: var(--warm); padding: 36px; border-radius: 16px; box-shadow: 0 10px 40px rgba(0,0,0,0.06); border: 1px solid rgba(0,0,0,0.04); }
    h1 { font-size: 2rem; font-weight: 300; margin-bottom: 8px; text-align: center; }
    p.sub { text-align: center; color: var(--mid); margin-bottom: 24px; font-size: 1rem; }

    form { display: flex; flex-direction: column; gap: 16px; }
    label { font-family: 'Syne', sans-serif; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--mid); }
    input { width: 100%; padding: 12px 14px; border-radius: 8px; border: 1px solid rgba(0,0,0,0.1); font-family: inherit; font-size: 1.05rem; }
    input:focus { outline: 2px solid var(--gold); }

    .hint { font-size: 0.8rem; color: var(--mid); margin-top: -10px; }

    .btn { font-family: 'Syne', sans-serif; padding: 14px; border-radius: 8px; border: none; text-transform: uppercase; letter-spacing: 0.1em; font-weight: 700; cursor: pointer; text-decoration: none; text-align: center; font-size: 0.85rem; }
    .btn-primary { background: var(--ink); color: var(--cream); margin-top: 8px; }
    .btn-primary:disabled { opacity: 0.6; }

    .auth-switch { text-align: center; margin-top: 20px; font-size: 0.95rem; color: var(--mid); }
    .auth-switch a { color: var(--gold); text-decoration: underline; font-weight: 600; }

    .back-home { text-align: center; margin-top: 20px; font-family: 'Syne', sans-serif; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.1em; }
    .back-home a { color: var(--mid); text-decoration: none; }
    
    #loginMsg { text-align: center; font-size: 0.95rem; color: var(--mid); margin-top: 8px; }
  </style>
</head>
<body>

  <a class="logo" href="index.html">GL<span class="gold">O</span>W</a>

  <div class="auth-card">
    <h1>Inicia Sesión</h1>
    <p class="sub">Accede a tus medidas y recomendaciones de talla</p>

    <form id="loginForm" novalidate>
      <div>
        <label for="loginUsername">Nombre de usuario</label>
        <input id="loginUsername" name="username" type="text" placeholder="Ej. lauragomez" required autocomplete="username">
      </div>
      <small class="hint">Sin números en el usuario.</small>

      <div>
        <label for="loginPassword">Contraseña</label>
        <input id="loginPassword" name="password" type="password" placeholder="••••••••" required autocomplete="current-password">
      </div>

      <button class="btn btn-primary" type="submit">Entrar</button>
      <div id="loginMsg"></div>
    </form>

    <p class="auth-switch">¿No tienes cuenta? <a href="register.html">Regístrate aquí</a></p>
  </div>

  <div class="back-home">
    <a href="index.html">← Volver a la página principal</a>
  </div>

  <script>
    const form = document.getElementById('loginForm');
    const usernameInput = document.getElementById('loginUsername');
    const msg = document.getElementById('loginMsg');

    // Bloquea dígitos mientras escribe
    usernameInput.addEventListener('input', () => {
      usernameInput.value = usernameInput.value.replace(/[0-9]/g, '');
    });

    form.addEventListener('submit', (e) => {
      e.preventDefault();
      msg.textContent = '';
      const username = usernameInput.value.trim();
      const password = document.getElementById('loginPassword').value;

      if(!username || !password){
        msg.textContent = 'Por favor completa todos los campos.';
        return;
      }

      msg.textContent = 'Iniciando sesión...';
      form.querySelector('button').disabled = true;

      setTimeout(() => {
        msg.style.color = '#2E7D32';
        msg.textContent = '¡Bienvenida de nuevo, ' + username + '! Redirigiendo...';
        setTimeout(() => { window.location.href = 'index.html'; }, 1200);
      }, 800);
    });
  </script>
</body>
</html>