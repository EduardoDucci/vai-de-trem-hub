<?php
declare(strict_types=1);
session_start();

/* ===== helpers ===== */
function e(string $s): string { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }
function loadMessages(string $file): array {
  if (!is_file($file)) return [];
  $json = file_get_contents($file);
  $data = json_decode($json, true);
  return is_array($data) ? $data : [];
}
function saveMessages(string $file, array $msgs): void {
  $tmp = $file . '.tmp';
  file_put_contents($tmp, json_encode($msgs, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
  rename($tmp, $file); // gravação atômica
}

/* ===== config ===== */
$STORE = __DIR__ . '/messages.json';
$DEFAULT = [
  [
    'name'   => 'Victor polzin',
    'avatar' => '../images/charles.png',
    'text'   => 'Bom dia, equipe! Precisamos de um resumo da situação atual da linha principal. Alguma novidade?',
  ],
  [
    'name'   => 'Ana Julia',
    'avatar' => '../images/ana__julia.png',
    'text'   => 'Bom dia! A linha principal está com fluxo normal no momento. Sem atrasos significativos. O trem de carga A68 deve passar pela estação central em 30 minutos.',
  ],
  [
    'name'   => 'Amir',
    'avatar' => '../images/amir.png',
    'text'   => 'Terminei a inspeção no trecho próximo à ponte do Rio Claro. Tudo em ordem, sem necessidade de reparos imediatos.',
  ],
];

/* ===== bootstrap ===== */
$messages = loadMessages($STORE);
if (!$messages) { $messages = $DEFAULT; saveMessages($STORE, $messages); }

/* ===== CSRF ===== */
if (empty($_SESSION['csrf'])) { $_SESSION['csrf'] = bin2hex(random_bytes(16)); }

/* ===== handle POST (opcional) ===== */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'] ?? '')) {
    http_response_code(400); die('CSRF inválido');
  }
  $name   = trim((string)($_POST['name'] ?? 'Você'));
  $text   = trim((string)($_POST['text'] ?? ''));
  $avatar = trim((string)($_POST['avatar'] ?? '../images/charles.png'));

  if ($text !== '') {
    $messages[] = ['name'=>$name ?: 'Você', 'avatar'=>$avatar ?: '../images/charles.png', 'text'=>$text];
    // mantém só os últimos 200 pra não crescer infinito
    if (count($messages) > 200) { $messages = array_slice($messages, -200); }
    saveMessages($STORE, $messages);
  }
  header('Location: ' . strtok($_SERVER['REQUEST_URI'], '?'));
  exit;
}
?><!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Vai de Trem Hub</title>
  <link rel="stylesheet" href="../style/style.css" />
  <style>
    /* mínimos pra garantir o look caso o CSS externo não carregue */
    :root{--panel:#13365d;--bubble:#28d2ff;--name:#1b6db6}
    body{margin:0;background:#1e4b87;color:#eaf6ff;font-family:system-ui,Segoe UI,Roboto}
    .phone{max-width:420px;margin:10px auto;padding:8px}
    .app{min-height:70vh;display:grid;grid-template-rows:1fr auto;gap:12px}
    .chat{background:var(--panel);border:2px solid #254b7a;padding:16px;border-radius:14px;display:grid;gap:16px}
    .chat__item{display:grid;grid-template-columns:52px 1fr;gap:12px}
    .chat__avatar{width:52px;height:52px;border-radius:12px;object-fit:cover}
    .chat__bubble{position:relative;background:var(--bubble);border:2px solid #7fe7ff;color:#062235;border-radius:12px;padding:10px 14px}
    .chat__name{display:inline-block;background:var(--name);color:#fff;padding:6px 10px;border-radius:8px;margin:0 0 8px;font-weight:700}
    .chat__text{margin:0;color:#ffffff}
    .chat__dot{position:absolute;right:-10px;top:50%;transform:translateY(-50%);width:16px;height:16px;background:#69f0ff;border:3px solid #0aa6c8;border-radius:50%}
    .chat__input{background:var(--panel);border:2px solid #254b7a;border-radius:14px;padding:10px}
    .row{display:flex;gap:8px}
    input[type="text"]{flex:1;border-radius:10px;border:1px solid #2f5f96;padding:12px 14px;font-size:16px}
    button{border:0;border-radius:10px;padding:12px 16px;background:#28d2ff;color:#02314a;font-weight:800;cursor:pointer}
  </style>
</head>
<body id="background__chat">
  <div class="phone">
    <main class="app">
      <section class="chat" aria-label="Mensagens do chat">
        <?php foreach ($messages as $m): ?>
          <article class="chat__item">
            <img class="chat__avatar" src="<?= e($m['avatar']) ?>" alt="Avatar de <?= e($m['name']) ?>" loading="lazy" />
            <div class="chat__bubble">
              <h3 class="chat__name"><?= e($m['name']) ?></h3>
              <p class="chat__text"><?= nl2br(e($m['text'])) ?></p>
              <span class="chat__dot" aria-hidden="true"></span>
            </div>
          </article>
        <?php endforeach; ?>
      </section>

      <!-- input opcional: remove se não quiser envio -->
      <section class="chat__input">
        <form method="post" class="row" autocomplete="off">
          <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">
          <input type="hidden" name="name" value="Você">
          <input type="hidden" name="avatar" value="../images/charles.png">
          <input type="text" name="text" placeholder="Digite algo..." required>
          <button type="submit">Enviar</button>
        </form>
      </section>
    </main>
  </div>
</body>
</html>
