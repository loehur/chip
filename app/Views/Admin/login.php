<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin - Chip</title>
    <link rel="icon" type="image/x-icon" href="<?= $this->ASSETS_URL ?>img/favicon.png" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --bg-dark: #0f0f12;
            --bg-card: #18181d;
            --bg-input: #222228;
            --accent: #f59e0b;
            --accent-hover: #fbbf24;
            --text: #f4f4f5;
            --text-muted: #a1a1aa;
            --danger: #ef4444;
            --danger-bg: rgba(239, 68, 68, 0.15);
            --radius: 12px;
            --radius-lg: 20px;
        }
        body {
            min-height: 100vh;
            font-family: "Segoe UI", system-ui, sans-serif;
            background: var(--bg-dark);
            color: var(--text);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background-image: radial-gradient(ellipse 80% 50% at 50% -20%, rgba(245, 158, 11, 0.15), transparent);
        }
        .card {
            background: var(--bg-card);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: var(--radius-lg);
            padding: 2rem;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.4);
        }
        .alert { padding: 1rem; border-radius: var(--radius); margin-bottom: 1rem; text-align: center; color: var(--danger); background: var(--danger-bg); }
        .form-label { display: block; font-size: 0.85rem; font-weight: 600; color: var(--accent); margin-bottom: 0.5rem; }
        .form-input {
            width: 100%; height: 48px; padding: 0 1rem;
            font-size: 1rem; background: var(--bg-input);
            border: 2px solid rgba(255, 255, 255, 0.08);
            border-radius: var(--radius); color: var(--text);
        }
        .form-input:focus { outline: none; border-color: var(--accent); }
        .form-group { margin-bottom: 1.5rem; }
        .btn {
            width: 100%; height: 48px; font-size: 1rem; font-weight: 600;
            color: var(--bg-dark); background: linear-gradient(135deg, var(--accent) 0%, #d97706 100%);
            border: none; border-radius: var(--radius); cursor: pointer;
        }
        .btn:hover { background: linear-gradient(135deg, var(--accent-hover) 0%, var(--accent) 100%); }
        h1 { text-align: center; margin-bottom: 1.5rem; font-size: 1.5rem; color: var(--accent); }
        .back-link { display: block; text-align: center; margin-top: 1rem; color: var(--text-muted); font-size: 0.9rem; }
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
