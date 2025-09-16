<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Avisos</title>
</head>
<body>
<?php
// avisos.php
$avisos = [
  [
    'tipo'  => 'alerta',
    'icone' => 'user',
    'titulo'=> 'Alerta de Segurança Ferroviária',
    'texto' => 'Uma falha grave ocorreu em um trem devido à fuga de ar no sistema de freios pneumáticos. A perda de pressão comprometeu a capacidade de frenagem, colocando passageiros e tripulação em risco. O trem irá parar na próxima estação para manutenção.'
  ],
  [
    'tipo'  => 'alerta',
    'icone' => 'shield',
    'titulo'=> 'Alerta de Segurança Ferroviária',
    'texto' => 'Um incidente preocupante ocorreu devido a uma falha nos rolamentos das rodas de um trem. O superaquecimento desses componentes elevou o risco de desgaste excessivo e possível descarrilamento.'
  ],
  [
    'tipo'  => 'info',
    'icone' => 'megaphone',
    'titulo'=> 'Comunicado Operacional de Gestão',
    'texto' => 'Informamos que não haverá expediente no dia 1º de abril, devido ao feriado comemorativo do Dia da Mentira. Recomendamos que todos aproveitem a data com responsabilidade.'
  ],
];
?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Avisos</title>
  <!-- Se já tiver um style.css, pode mantê-lo. Este CSS deixa a página pronta sozinha. -->
  <style>
    :root{
      --bg:#0a0f1f;
      --surface:#0c2f66;
      --surf-2:#0e4ea1;
      --text:#e6f1ff;
      --muted:#bcd8ff;
      --accent:#39c7ff;
      --accent-2:#7ee0ff;
      --card:#0b3e8a;
      --card-alpha:rgba(25,125,255,.10);
      --border:rgba(82,220,255,.45);
      --glow:0 0 0 1px rgba(80,220,255,.35), 0 0 14px rgba(0,180,255,.35);
    }
    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0; background:radial-gradient(1200px 700px at 50% -200px,#0b3a7a 0%, #072043 55%, var(--bg) 100%);
      color:var(--text); font:500 15px/1.4 system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, "Helvetica Neue", Arial, "Noto Sans", "Apple Color Emoji","Segoe UI Emoji";
      display:grid; place-items:center; padding:18px;
    }

    /* Moldura “telefone” */
    .phone{
      width:360px; max-width:92vw; background:linear-gradient(180deg, #0f4ba0 0%, #0a2f6b 100%);
      border-radius:32px; padding:18px; position:relative; box-shadow:0 25px 60px rgba(0,0,0,.55), inset 0 0 0 1px rgba(255,255,255,.05);
    }
    .phone:before{
      content:""; position:absolute; inset:8px; border-radius:26px; pointer-events:none;
      box-shadow:inset 0 0 0 1px rgba(255,255,255,.06), inset 0 0 24px rgba(0,0,0,.25);
    }
    .notch{
      position:absolute; left:50%; top:7px; transform:translateX(-50%);
      width:160px; height:22px; background:#0b1833; border-radius:0 0 14px 14px;
      box-shadow:0 2px 8px rgba(0,0,0,.5);
    }

    /* App */
    .app{
      position:relative; z-index:1; background:linear-gradient(180deg, rgba(255,255,255,.06), rgba(255,255,255,.02));
      border-radius:20px; padding:16px; border:1px solid rgba(255,255,255,.06);
      box-shadow:inset 0 0 0 1px rgba(255,255,255,.02);
    }

    /* Cabeçalho */
    .header{
      display:flex; align-items:center; gap:12px;
      background:linear-gradient(180deg, rgba(10,65,150,.75), rgba(10,65,150,.35));
      padding:14px 16px; border-radius:12px; border:1px solid var(--border);
      box-shadow:var(--glow); letter-spacing:.02em; margin-bottom:14px;
    }
    .header h1{
      font-weight:800; font-size:28px; margin:0; text-shadow:0 1px 8px rgba(0,0,0,.35);
    }
    .header svg{width:28px; height:28px; flex:0 0 auto; filter:drop-shadow(0 0 10px rgba(50,220,255,.35))}
    
    /* Cards */
    .lista{display:flex; flex-direction:column; gap:12px;}
    .card{
      display:grid; grid-template-columns:48px 1fr; gap:12px;
      background:linear-gradient(180deg, var(--card-alpha), rgba(0,0,0,.12));
      border:1px solid var(--border); border-radius:12px; padding:12px 12px;
      box-shadow:var(--glow);
    }
    .icone{
      display:grid; place-items:center; align-self:start;
      width:48px; height:48px; border-radius:999px;
      background:linear-gradient(180deg, rgba(90,200,255,.25), rgba(90,200,255,.1));
      border:1px solid var(--border);
    }
    .icone svg{width:22px; height:22px}
    .card h3{
      margin:0 0 6px 0; font-size:16px; line-height:1.2; font-weight:800; color:#bfe6ff;
      text-shadow:0 0 8px rgba(90,200,255,.25);
    }
    .card p{
      margin:0; color:var(--muted); font-size:12.5px; line-height:1.35;
    }
    .card.alerta{border-color:rgba(255,190,90,.35); box-shadow:0 0 0 1px rgba(255,190,90,.15), 0 0 14px rgba(255,200,120,.15)}
    .card.info{border-color:var(--border)}

    /* Pequenos toques */
    .badge{
      display:inline-block; padding:.25rem .5rem; font-size:.675rem; border-radius:6px; margin-left:6px;
      border:1px solid var(--border); color:var(--accent-2); background:rgba(0,155,255,.08);
    }

    @media (max-width:380px){ .header h1{font-size:24px} }
  </style>
</head>
<body>
  <main class="phone" role="main" aria-label="Aplicativo de avisos">
    <div class="notch" aria-hidden="true"></div>
    <section class="app">
      <header class="header">
        <!-- Sininho -->
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
          <path d="M12 3c-3.314 0-6 2.686-6 6v2.17c0 .53-.211 1.039-.586 1.414L4 14h16l-1.414-1.414A2 2 0 0 1 18 11.17V9c0-3.314-2.686-6-6-6Z" stroke="url(#g1)" stroke-width="1.6"/>
          <path d="M9.5 18a2.5 2.5 0 0 0 5 0" stroke="url(#g1)" stroke-width="1.6" stroke-linecap="round"/>
          <defs><linearGradient id="g1" x1="0" x2="24" y1="0" y2="24"><stop stop-color="#7ee0ff"/><stop offset="1" stop-color="#39c7ff"/></linearGradient></defs>
        </svg>
        <h1>AVISOS</h1>
        <span class="badge">Atualizado</span>
      </header>

      <div class="lista">
        <?php foreach($avisos as $a): ?>
          <article class="card <?= htmlspecialchars($a['tipo']) ?>">
            <div class="icone" aria-hidden="true">
              <?php if($a['icone']==='user'): ?>
                <svg viewBox="0 0 24 24" fill="none"><path d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5Z" stroke="#9be8ff" stroke-width="1.6"/><path d="M4 20a8 8 0 0 1 16 0" stroke="#9be8ff" stroke-width="1.6" stroke-linecap="round"/></svg>
              <?php elseif($a['icone']==='shield'): ?>
                <svg viewBox="0 0 24 24" fill="none"><path d="M12 3 5 6v6a9 9 0 0 0 7 8 9 9 0 0 0 7-8V6l-7-3Z" stroke="#9be8ff" stroke-width="1.6"/></svg>
              <?php else: /* megaphone */ ?>
                <svg viewBox="0 0 24 24" fill="none"><path d="M3 10v4l10-2V8L3 10Z" stroke="#9be8ff" stroke-width="1.6"/><path d="M13 8c4 0 8-2 8-2v12s-4-2-8-2" stroke="#9be8ff" stroke-width="1.6"/><path d="M7 14v4" stroke="#9be8ff" stroke-width="1.6" stroke-linecap="round"/></svg>
              <?php endif; ?>
            </div>
            <div>
              <h3><?= htmlspecialchars($a['titulo']) ?></h3>
              <p><?= htmlspecialchars($a['texto']) ?></p>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    </section>
  </main>
