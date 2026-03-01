<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin - Chip</title>
    <link rel="icon" type="image/x-icon" href="<?= $this->ASSETS_URL ?>img/favicon.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --bg: #0a0a0b; --card: #111113; --input: #1c1c1f;
            --border: rgba(255,255,255,0.04); --text: #fafafa;
            --muted: #71717a; --accent: #a1a1aa; --danger: #dc2626;
            --danger-soft: rgba(220,38,38,0.12); --radius: 10px; --radius-lg: 16px;
        }
        body {
            min-height: 100vh;
            font-family: 'DM Sans', -apple-system, sans-serif;
            background: var(--bg); color: var(--text);
            display: flex; align-items: center; justify-content: center;
            padding: 2rem; -webkit-font-smoothing: antialiased;
        }
        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 2rem;
            width: 100%; max-width: 380px;
        }
        h1 { font-size: 1.375rem; font-weight: 600; letter-spacing: -0.02em; margin-bottom: 1.5rem; color: var(--text); }
        .alert { padding: 1rem; border-radius: var(--radius); margin-bottom: 1rem; font-size: 0.875rem; background: var(--danger-soft); color: var(--danger); border: 1px solid rgba(220,38,38,0.25); }
        .form-label { display: block; font-size: 0.8125rem; font-weight: 500; color: var(--muted); margin-bottom: 0.5rem; }
        .form-input {
            width: 100%; height: 48px; padding: 0 1rem;
            font-size: 0.9375rem; font-family: inherit;
            background: var(--input); border: 1px solid var(--border);
            border-radius: var(--radius); color: var(--text);
        }
        .form-input:focus { outline: none; border-color: rgba(255,255,255,0.12); }
        .form-group { margin-bottom: 1.5rem; }
        .btn {
            width: 100%; height: 48px; font-size: 0.9375rem; font-weight: 500; font-family: inherit;
            color: var(--bg); background: var(--text);
            border: 1px solid var(--text); border-radius: var(--radius);
            cursor: pointer; transition: all 0.2s;
        }
        .btn:hover { background: var(--accent); border-color: var(--accent); color: var(--bg); }
        .back-link { display: block; text-align: center; margin-top: 1.25rem; font-size: 0.8125rem; color: var(--muted); text-decoration: none; }
        .back-link:hover { color: var(--accent); }
    </style>
</head>
<body>
    <div class="card">
        <h1>Admin Chip</h1>
        <?php if (strlen($data) > 0) { ?><div class="alert"><?= htmlspecialchars($data) ?></div><?php } ?>
        <form method="post">
            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input type="password" class="form-input" id="password" name="password" placeholder="Masukkan password" required autofocus>
            </div>
            <button type="submit" class="btn">Masuk</button>
        </form>
        <a href="<?= $this->BASE_URL ?>" class="back-link">← Kembali ke Login</a>
    </div>
</body>
