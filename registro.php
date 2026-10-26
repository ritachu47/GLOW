<?php 
// Requerimos la conexión a la base de datos
require_once 'conexion.php'; 

$mensaje = ''; // Variable para mostrar errores o éxitos

// Comprobamos si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if (empty($username) || empty($email) || empty($password) || empty($confirm)) {
        $mensaje = "<div style='color: var(--rose);'>Por favor completa todos los campos.</div>";
    } elseif (strlen($password) < 6) {
        $mensaje = "<div style='color: var(--rose);'>La contraseña debe tener al menos 6 caracteres.</div>";
    } elseif ($password !== $confirm) {
        $mensaje = "<div style='color: var(--rose);'>Las contraseñas no coinciden.</div>";
    } else {
        // Encriptar la contraseña por seguridad (obligatorio en bases de datos)
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        try {
            // Insertar datos usando PDO
            $sql = "INSERT INTO usuarios (username, email, password) VALUES (:username, :email, :password)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':username' => $username,
                ':email' => $email,
                ':password' => $passwordHash
            ]);
            
            $mensaje = "<div style='color: #2E7D32;'>¡Cuenta creada con éxito! <a href='login.php'>Inicia sesión aquí</a></div>";
        } catch (\PDOException $e) {
            // Si el usuario o correo ya existen
            $mensaje = "<div style='color: var(--rose);'>Error: El usuario o correo ya están registrados.</div>";
        }
    }
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Crear Cuenta — Glow</title>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400&family=Syne:wght@600;800&display=swap" rel="stylesheet">
  <style>
    /* ... Conserva aquí exactamente todo tu código CSS original (Fuente 2) ... */
    :root { --cream: #F5F0E8; --warm: #FAF8F4; --ink: #1A1714; --gold: #C9A96E; --mid: #7A6E65; --rose: #D4857A; }
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { background: var(--cream); color: var(--ink); font-family: 'Cormorant Garamond', serif; min-height: 100vh; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 20px; }
    .logo { font-family: 'Syne', sans-serif; font-weight: 800; font-size: 1.8rem; text-decoration: none; color: var(--ink); margin-bottom: 24px; }
    .logo .gold { color: var(--gold); }
    .auth-card { width: 100%; max-width: 480px; background: var(--warm); padding: 36px; border-radius: 16px; box-shadow: 0 10px 40px rgba(0,0,0,0.06); border: 1px solid rgba(0,0,0,0.04); }
    h1 { font-size: 2rem; font-weight: 300; margin-bottom: 8px; text-align: center; }
    p.sub { text-align: center; color: var(--mid); margin-bottom: 24px; font-size: 1rem; }
    form { display: flex; flex-direction: column; gap: 14px; }
    label { font-family: 'Syne', sans-serif; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--mid); }
    input { width: 100%; padding: 12px 14px; border-radius: 8px; border: 1px solid rgba(0,0,0,0.1); font-family: inherit; font-size: 1.05rem; }
    input:focus { outline: 2px solid var(--gold); }
    .hint { font-size: 0.8rem; color: var(--mid); margin-top: -8px; }
    .btn { font-family: 'Syne', sans-serif; padding: 14px; border-radius: 8px; border: none; text-transform: uppercase; letter-spacing: 0.1em; font-weight: 700; cursor: pointer; text-decoration: none; text-align: center; font-size: 0.85rem; }
    .btn-primary { background: var(--ink); color: var(--cream); margin-top: 8px; }
    .auth-switch { text-align: center; margin-top: 20px; font-size: 0.95rem; color: var(--mid); }
    .auth-switch a { color: var(--gold); text-decoration: underline; font-weight: 600; }
    .back-home { text-align: center; margin-top: 20px; font-family: 'Syne', sans-serif; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.1em; }
    .back-home a { color: var(--mid); text-decoration: none; }
    #registerMsg { text-align: center; font-size: 0.95rem; margin-top: 8px; }
  </style>
</head>
<body>

  <a class="logo" href="index.html">GL<span class="gold">O</span>W</a>

  <div class="auth-card">
    <h1>Crea tu cuenta</h1>
    <p class="sub">Guarda tu perfil corporativo y compra con tu talla exacta</p>

    <!-- ¡IMPORTANTE! Agregamos method="POST" para enviar los datos a PHP -->
    <form id="registerForm" method="POST" action="">
      <div>
        <label for="regUsername">Nombre de usuario</label>
        <!-- name="username" es el que captura PHP con $_POST['username'] -->
        <input id="regUsername" name="username" type="text" placeholder="Solo letras, sin números" required autocomplete="username">
      </div>
      <small class="hint">No se permiten números.</small>

      <div>
        <label for="regEmail">Correo electrónico</label>
        <input id="regEmail" name="email" type="email" placeholder="correo@ejemplo.com" required autocomplete="email">
      </div>

      <div>
        <label for="regPassword">Contraseña</label>
        <input id="regPassword" name="password" type="password" placeholder="Mínimo 6 caracteres" required autocomplete="new-password">
      </div>

      <div>
        <label for="regConfirm">Confirmar contraseña</label>
        <input id="regConfirm" name="confirm" type="password" placeholder="Repite tu contraseña" required autocomplete="new-password">
      </div>

      <button class="btn btn-primary" type="submit">Crear cuenta</button>
      
      <!-- Aquí se imprimirá el mensaje de PHP -->
      <div id="registerMsg">
        <?php echo $mensaje; ?>
      </div>
    </form>

    <p class="auth-switch">¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a></p>
  </div>

  <div class="back-home">
    <a href="index.html">← Volver a la página principal</a>
  </div>

  <script>
    // Solo dejamos la validación visual de no escribir números
    const regUsername = document.getElementById('regUsername');
    regUsername.addEventListener('input', () => {
      regUsername.value = regUsername.value.replace(/[0-9]/g, '');
    });
    // Hemos eliminado la simulación del botón submit para que el formulario se envíe a PHP
  </script>
</body>
</html>