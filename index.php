<?php require_once 'conexion.php'; ?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Glow — tecnología de tallaje inteligente para comprar con confianza y reducir devoluciones.">
  <meta name="theme-color" content="#F5F0E8">
  <meta property="og:title" content="Glow — Tu talla perfecta">
  <meta property="og:description" content="Crea tu perfil corporal y compra con la talla exacta en tiendas asociadas. Menos devoluciones, más confianza.">
  <meta property="og:type" content="website">
  <link rel="icon" href="/favicon.ico">
  <title>Glow — Tu talla perfecta</title>

  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300&family=Syne:wght@600;800&display=swap" rel="stylesheet">

  <style>
    :root {
      --cream: #F5F0E8;
      --warm: #FAF8F4;
      --ink: #1A1714;
      --gold: #C9A96E;
      --gold-200: #E8D5B0;
      --mid: #7A6E65;
      --deep: #2C2420;
      --rose: #D4857A;
      --radius: 12px;
      --glass: rgba(255, 255, 255, 0.06);
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; font-family: sans-serif; }
    body { background: var(--cream); color: var(--ink); font-family: 'Cormorant Garamond', serif; line-height: 1.45; -webkit-font-smoothing: antialiased; }
    img, svg { max-width: 100%; height: auto; display: block; }
    a { color: inherit; }
    button { font-family: 'Syne', sans-serif; cursor: pointer; }

    /* Skip link */
    .skip { position: absolute; left: -999px; top: auto; width: 1px; height: 1px; overflow: hidden; }
    .skip:focus { left: 12px; top: 12px; width: auto; height: auto; padding: 8px 12px; background: #111; color: #fff; border-radius: 6px; z-index: 9999; }

    /* NAV */
    nav { position: fixed; inset: 0 0 auto 0; display: flex; align-items: center; justify-content: space-between; padding: 14px 28px; background: rgba(245, 240, 232, 0.92); backdrop-filter: blur(8px); z-index: 100; border-bottom: 1px solid rgba(0,0,0,0.04); }
    .logo { font-family: 'Syne', sans-serif; font-weight: 800; letter-spacing: .12em; font-size: 1.15rem; text-decoration: none; }
    .logo .gold { color: var(--gold); }
    .nav-links { display: flex; gap: 20px; align-items: center; list-style: none; }
    .nav-links a { font-family: 'Syne', sans-serif; font-size: .78rem; text-transform: uppercase; letter-spacing: .12em; color: var(--ink); text-decoration: none; padding: 8px; }
    .nav-cta { background: var(--ink); color: var(--cream) !important; padding: 10px 16px !important; border-radius: 8px; font-weight: 700; }
    .nav-toggle { display: none; background: transparent; border: 1px solid rgba(0,0,0,.06); padding: 8px; border-radius: 8px; cursor: pointer; }

    /* HERO */
    #hero { min-height: 86vh; display: grid; grid-template-columns: 1fr 1fr; gap: 28px; padding: 120px 48px 80px 48px; align-items: center; }
    .hero-left { max-width: 56ch; }
    .h-tag { font-family: 'Syne', sans-serif; color: var(--gold); letter-spacing: .28em; margin-bottom: 18px; font-size: .78rem; text-transform: uppercase; }
    h1 { font-size: clamp(2.4rem, 5vw, 4.2rem); font-weight: 300; line-height: 1; margin-bottom: 14px; }
    h1 em { color: var(--gold); font-style: italic; }
    .hero-sub { color: var(--mid); font-weight: 300; margin-bottom: 22px; font-size: 1.02rem; }
    .actions { display: flex; gap: 12px; flex-wrap: wrap; }
    .btn { font-family: 'Syne', sans-serif; padding: 12px 20px; border-radius: 10px; text-transform: uppercase; letter-spacing: .12em; border: none; text-decoration: none; display: inline-block; font-size: 0.8rem; text-align: center; }
    .btn-primary { background: var(--ink); color: var(--cream); font-weight: 700; }
    .btn-outline { background: transparent; border: 1px solid rgba(0,0,0,.15); color: var(--ink); }

    .hero-stats { display: flex; gap: 28px; margin-top: 36px; border-top: 1px solid rgba(0,0,0,.06); padding-top: 20px; }
    .stat { font-family: 'Syne', sans-serif; }
    .stat .num { font-size: 1.6rem; font-weight: 300; }
    .stat .label { font-size: .68rem; letter-spacing: .12em; color: var(--mid); text-transform: uppercase; margin-top: 6px; }

    /* HERO RIGHT */
    .hero-right { background: var(--deep); color: var(--cream); display: flex; align-items: center; justify-content: center; padding: 28px; border-radius: 18px; position: relative; overflow: hidden; min-height: 380px; }
    .avatar-svg { width: 230px; filter: drop-shadow(0 28px 60px rgba(0,0,0,.25)); animation: float 4s ease-in-out infinite; }
    @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }
    .tag { position: absolute; background: var(--glass); backdrop-filter: blur(6px); border: 1px solid rgba(201,169,110,0.2); padding: 8px 12px; border-radius: 999px; font-family: 'Syne', sans-serif; display: flex; gap: 8px; align-items: center; color: var(--gold-200); font-size: 0.8rem; }
    .tag .val { color: var(--cream); font-weight: 300; }
    .tag.size { left: 16px; top: 24px; }
    .tag.bust { right: 16px; top: 110px; }
    .tag.waist { right: 16px; top: 190px; }
    .tag.hip { right: 16px; top: 270px; }

    /* MARQUEE */
    .marquee { background: var(--ink); color: var(--gold); padding: 12px 0; overflow: hidden; font-family: 'Syne', sans-serif; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.1em; }
    .marquee .inner { display: inline-flex; gap: 42px; animation: marq 22s linear infinite; white-space: nowrap; }
    @keyframes marq { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }

    /* SECTIONS */
    .section { padding: 72px 48px; }
    .section h2 { font-size: 2.2rem; font-weight: 300; margin-bottom: 24px; }
    .bento { display: grid; grid-template-columns: repeat(12, 1fr); grid-auto-rows: 180px; gap: 14px; margin-top: 18px; }
    .card { padding: 20px; border-radius: 12px; background: var(--warm); box-shadow: 0 8px 30px rgba(0,0,0,.04); display: flex; flex-direction: column; justify-content: flex-end; }
    .card.dark { background: var(--ink); color: var(--cream); }
    .card .metric { font-family: 'Cormorant Garamond', serif; font-size: 2.4rem; font-weight: 300; color: var(--ink); }
    .card.dark .metric { color: var(--cream); }
    .card.small { grid-column: span 4; }
    .card.large { grid-column: span 8; }

    /* TESTIMONIOS */
    .testimonials { display: grid; grid-template-columns: 1fr 320px; gap: 20px; align-items: center; }
    .test-rail { background: var(--warm); padding: 24px; border-radius: 12px; }
    .testimonial p { font-style: italic; color: var(--mid); margin-top: 6px; font-size: 1.1rem; }
    .test-controls { display: flex; gap: 8px; align-items: center; justify-content: flex-start; margin-top: 16px; }
    .test-controls button { background: var(--cream); border: 1px solid rgba(0,0,0,0.1); padding: 6px 12px; border-radius: 6px; }

    /* FAQ */
    .faq { max-width: 900px; margin: 0 auto; }
    .faq-item { border-bottom: 1px solid rgba(0,0,0,.06); }
    .faq-btn { width: 100%; text-align: left; padding: 18px 0; border: 0; background: transparent; display: flex; justify-content: space-between; align-items: center; cursor: pointer; font-family: 'Cormorant Garamond', serif; font-size: 1.3rem; color: var(--ink); }
    .faq-panel { padding-bottom: 18px; display: none; color: var(--mid); font-size: 1.05rem; }

    /* PLANES */
    .plans { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; margin-top: 20px; }
    .plan { padding: 28px; border-radius: 12px; background: var(--warm); border: 1px solid rgba(0,0,0,.04); display: flex; flex-direction: column; gap: 12px; }
    .plan.featured { background: var(--ink); color: var(--cream); border-color: var(--ink); }
    .plan-name { font-family: 'Syne', sans-serif; font-size: 1.1rem; font-weight: 700; }
    .price { font-family: 'Cormorant Garamond', serif; font-size: 2.5rem; font-weight: 300; }

    /* BACK TO TOP */
    .back-to-top { position: fixed; right: 18px; bottom: 18px; background: var(--ink); color: var(--cream); padding: 10px 14px; border-radius: 10px; border: none; display: none; z-index: 120; }

    footer { background: var(--deep); color: rgba(245,240,232,.85); padding: 36px 48px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; border-top: 1px solid rgba(255,255,255,.02); font-family: 'Syne', sans-serif; font-size: 0.85rem; }
    footer .links { display: flex; gap: 18px; list-style: none; }
    footer .links a { text-decoration: none; }

    :focus { outline: 3px solid var(--gold-200); outline-offset: 4px; }
    @media (prefers-reduced-motion: reduce) { * { animation: none !important; transition: none !important; } }

    /* Responsive */
    @media (max-width: 900px) {
      #hero { grid-template-columns: 1fr; padding: 100px 20px 40px 20px; }
      .nav-links { display: none; }
      .nav-toggle { display: inline-flex; }
      .bento { grid-template-columns: 1fr; }
      .card.small, .card.large { grid-column: span 1; }
      .plans { grid-template-columns: 1fr; }
      .testimonials { grid-template-columns: 1fr; }
      .section { padding: 48px 20px; }
    }
  </style>
</head>
<body>
  <a class="skip" href="#main">Saltar al contenido</a>

  <nav aria-label="Navegación principal">
    <a class="logo" href="#hero">GL<span class="gold">O</span>W</a>

    <button class="nav-toggle" aria-controls="site-nav" aria-expanded="false" aria-label="Abrir menú">
      ☰
    </button>

    <ul class="nav-links" id="site-nav">
      <li><a href="#benef">Beneficios</a></li>
      <li><a href="#testimonios">Testimonios</a></li>
      <li><a href="#faq">FAQ</a></li>
      <li><a href="#planes">Planes</a></li>
      <li><a href="login.html">Mi cuenta</a></li>
      <li><a href="login.html" class="nav-cta">Empieza gratis</a></li>
    </ul>
  </nav>

  <main id="main">
    <!-- HERO -->
    <section id="hero" aria-labelledby="hero-title">
      <div class="hero-left">
        <div class="h-tag">Tecnología de tallaje inteligente</div>
        <h1 id="hero-title">Encuentra tu <em>talla exacta</em>, en segundos</h1>
        <p class="hero-sub">Crea tu perfil una sola vez y compra con confianza en tiendas asociadas. Menos devoluciones, más aciertos.</p>

        <div class="actions">
          <a class="btn btn-primary" href="register.html">Crear mi perfil</a>
          <a class="btn btn-outline" href="#benef">Ver cómo funciona ▸</a>
        </div>

        <div class="hero-stats">
          <div class="stat"><div class="num">92<span style="color:var(--gold)">%</span></div><div class="label">Menos devoluciones</div></div>
          <div class="stat"><div class="num">40<span style="color:var(--gold)">K+</span></div><div class="label">Perfiles creados</div></div>
          <div class="stat"><div class="num">180<span style="color:var(--gold)">+</span></div><div class="label">Tiendas conectadas</div></div>
        </div>
      </div>

      <div class="hero-right" aria-hidden="true">
        <svg class="avatar-svg" viewBox="0 0 200 380" xmlns="http://www.w3.org/2000/svg">
          <circle cx="100" cy="45" r="34" fill="none" stroke="#C9A96E" stroke-width="1.6"/>
          <path d="M60 100 C60 85,140 85,140 100 L150 190 C150 210,130 215,100 215 C70 215,50 210,50 190 Z" fill="none" stroke="#C9A96E" stroke-width="1.6"/>
          <line x1="50" y1="140" x2="150" y2="140" stroke="#D4857A" stroke-width="1" stroke-dasharray="3 4"/>
        </svg>

        <div class="tag size"><strong class="t">Talla</strong><span class="val">M</span></div>
        <div class="tag bust"><span class="t">Busto</span><span class="val">92 cm</span></div>
        <div class="tag waist"><span class="t">Cintura</span><span class="val">74 cm</span></div>
        <div class="tag hip"><span class="t">Cadera</span><span class="val">98 cm</span></div>
      </div>
    </section>

    <!-- MARQUEE -->
    <div class="marquee" aria-hidden="true">
      <div class="inner">
        <span>Talla perfecta •</span><span>Sin devoluciones •</span><span>Medidas precisas •</span><span>Compra con confianza •</span>
        <span>Talla perfecta •</span><span>Sin devoluciones •</span><span>Medidas precisas •</span><span>Compra con confianza •</span>
      </div>
    </div>

    <!-- BENEFICIOS -->
    <section id="benef" class="section" aria-labelledby="benef-title">
      <h2 id="benef-title">Beneficios</h2>
      <div class="bento">
        <div class="card large dark">
          <div class="metric">98<span style="color:var(--gold)">%</span></div>
          <strong>Precisión comprobada</strong>
          <p style="opacity:.95">Modelos entrenados con tallajes reales y datos de marcas.</p>
        </div>

        <div class="card small">
          <strong>Privacidad</strong>
          <p>Medidas cifradas de extremo a extremo; tus fotos nunca se comparten.</p>
        </div>

        <div class="card small">
          <strong>Rápido</strong>
          <p>Perfil en segundos y recomendaciones instantáneas por tienda.</p>
        </div>

        <div class="card small">
          <strong>Multi-categoría</strong>
          <p>Funciona para vestidos, jeans, abrigos y ropa deportiva.</p>
        </div>

        <div class="card small">
          <strong>Comparación entre marcas</strong>
          <p>Recomendaciones adaptadas a la tabla de cada marca.</p>
        </div>

        <div class="card small">
          <strong>Perfiles familiares</strong>
          <p>Crea varios perfiles desde una sola cuenta.</p>
        </div>
      </div>
    </section>

    <!-- TESTIMONIOS -->
    <section id="testimonios" class="section" aria-labelledby="testi-title">
      <h2 id="testi-title">Testimonios</h2>
      <div class="testimonials">
        <div class="test-rail">
          <div id="testList">
            <div class="testimonial" data-index="0"><strong>Ana R.</strong><p>"Me ahorró horas de devoluciones. ¡Siempre compro seguro!"</p></div>
            <div class="testimonial" data-index="1" hidden><strong>María P.</strong><p>"El ajuste fue perfecto en mi vestido de boda."</p></div>
            <div class="testimonial" data-index="2" hidden><strong>Laura S.</strong><p>"Fácil, rápido y confiable. Lo uso para toda la familia."</p></div>
          </div>

          <div class="test-controls">
            <button id="prevTest" aria-label="Testimonio anterior">◀</button>
            <button id="nextTest" aria-label="Siguiente testimonio">▶</button>
            <span style="margin-left:12px;color:var(--mid);font-size:0.9rem">Opiniones reales de usuarias</span>
          </div>
        </div>

        <aside style="padding:24px;border-radius:12px;background:var(--warm);display:flex;flex-direction:column;gap:12px;justify-content:center">
          <strong>¿Listo para probar?</strong>
          <p style="color:var(--mid)">Crea tu perfil gratis y obtén recomendaciones personalizadas.</p>
          <a class="btn btn-primary" href="register.html">Crear perfil gratis</a>
        </aside>
      </div>
    </section>

    <!-- FAQ -->
    <section id="faq" class="section" aria-labelledby="faq-title">
      <h2 id="faq-title">Preguntas frecuentes</h2>
      <div class="faq">
        <div class="faq-item">
          <button class="faq-btn" aria-expanded="false" aria-controls="faq1" id="faq1-btn">¿Cómo se calculan las medidas? <span>▾</span></button>
          <div id="faq1" class="faq-panel">Nuestra IA combina tus entradas con tablas reales de marcas y modelos 3D anónimos para generar tu perfil.</div>
        </div>

        <div class="faq-item">
          <button class="faq-btn" aria-expanded="false" aria-controls="faq2" id="faq2-btn">¿Se comparte mi foto? <span>▾</span></button>
          <div id="faq2" class="faq-panel">No — las fotos se procesan localmente y las medidas se cifran. Nunca compartimos imágenes con terceros.</div>
        </div>

        <div class="faq-item">
          <button class="faq-btn" aria-expanded="false" aria-controls="faq3" id="faq3-btn">¿Puedo actualizar mi perfil? <span>▾</span></button>
          <div id="faq3" class="faq-panel">Sí, puedes actualizarlo cuando quieras y las recomendaciones se ajustarán al instante.</div>
        </div>
      </div>
    </section>

    <!-- PLANES -->
    <section id="planes" class="section" aria-labelledby="planes-title">
      <h2 id="planes-title">Planes</h2>
      <div class="plans">
        <div class="plan">
          <div class="plan-name">Básico</div>
          <div class="price">$0</div>
          <p>1 perfil • Recomendaciones en tiendas</p>
          <a class="btn btn-outline" href="register.html?plan=Basico">Empezar</a>
        </div>

        <div class="plan featured">
          <div class="plan-name">Pro</div>
          <div class="price">$9<small style="font-size:1rem">/mes</small></div>
          <p>Hasta 5 perfiles • Comparación entre marcas</p>
          <a class="btn btn-primary" href="register.html?plan=Pro">Elegir Pro</a>
        </div>

        <div class="plan">
          <div class="plan-name">Tiendas</div>
          <div class="price">Personalizado</div>
          <p>Widget de talla • Análisis de devoluciones</p>
          <a class="btn btn-outline" href="register.html?plan=Tiendas">Hablar con ventas</a>
        </div>
      </div>
    </section>
  </main>

  <button class="back-to-top" id="backTop" aria-label="Volver arriba">↑</button>

  <footer>
    <div style="display:flex;flex-direction:column;gap:8px">
      <a class="logo" href="#hero" style="color:var(--cream)">GL<span class="gold">O</span>W</a>
      <div style="color:rgba(245,240,232,.75)">Reduce devoluciones • Mejora satisfacción</div>
    </div>

    <ul class="links">
      <li><a href="#benef">Beneficios</a></li>
      <li><a href="#planes">Planes</a></li>
      <li><a href="login.html">Mi cuenta</a></li>
    </ul>

    <div>© 2026 Glow</div>
  </footer>

  <script>
    (function(){
      /* NAV TOGGLE */
      const toggle = document.querySelector('.nav-toggle');
      const navLinks = document.querySelector('.nav-links');
      toggle && toggle.addEventListener('click', () => {
        const expanded = toggle.getAttribute('aria-expanded') === 'true';
        toggle.setAttribute('aria-expanded', String(!expanded));
        if(!expanded){
          navLinks.style.display = 'flex';
          navLinks.style.flexDirection = 'column';
          navLinks.style.position = 'absolute';
          navLinks.style.right = '16px';
          navLinks.style.top = '64px';
          navLinks.style.background = '#FAF8F4';
          navLinks.style.padding = '16px';
          navLinks.style.borderRadius = '12px';
          navLinks.style.boxShadow = '0 12px 40px rgba(0,0,0,.15)';
        } else {
          navLinks.style.display = '';
        }
      });

      /* TESTIMONIOS */
      const tests = Array.from(document.querySelectorAll('.testimonial'));
      let curTest = 0;
      const showTest = (i) => {
        tests.forEach((t, idx) => { t.hidden = idx !== i; });
      };
      document.getElementById('prevTest')?.addEventListener('click', () => {
        curTest = (curTest - 1 + tests.length) % tests.length;
        showTest(curTest);
      });
      document.getElementById('nextTest')?.addEventListener('click', () => {
        curTest = (curTest + 1) % tests.length;
        showTest(curTest);
      });

      /* FAQ ACCORDION */
      document.querySelectorAll('.faq-btn').forEach(btn => {
        btn.addEventListener('click', () => {
          const expanded = btn.getAttribute('aria-expanded') === 'true';
          btn.setAttribute('aria-expanded', String(!expanded));
          const panel = document.getElementById(btn.getAttribute('aria-controls'));
          if(panel) panel.style.display = expanded ? 'none' : 'block';
        });
      });

      /* BACK TO TOP */
      const back = document.getElementById('backTop');
      window.addEventListener('scroll', () => {
        if(window.scrollY > 400) back.style.display = 'block'; else back.style.display = 'none';
      });
      back.addEventListener('click', () => window.scrollTo({top:0,behavior:'smooth'}));
    })();
  </script>
</body>
</html>
