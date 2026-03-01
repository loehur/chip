<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Delete User - Admin Chip</title>
    <link rel="icon" type="image/x-icon" href="<?= $this->ASSETS_URL ?>img/favicon.png" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --bg-dark: #0f0f12;
            --bg-card: #18181d;
            --bg-input: #222228;
            --accent: #f59e0b;
            --danger: #ef4444;
            --text: #f4f4f5;
            --text-muted: #a1a1aa;
            --radius: 12px;
        }
        body { font-family: "Segoe UI", system-ui, sans-serif; background: var(--bg-dark); color: var(--text); padding: 2rem; }
        .container { max-width: 500px; margin: 0 auto; }
        .card { background: var(--bg-card); border: 1px solid rgba(255,255,255,0.06); border-radius: var(--radius); padding: 1.5rem; margin-bottom: 1rem; }
        .form-label { display: block; font-size: 0.85rem; color: var(--accent); margin-bottom: 0.5rem; }
        .form-input { width: 100%; padding: 0.75rem; background: var(--bg-input); border: 2px solid rgba(255,255,255,0.08); border-radius: 8px; color: var(--text); margin-bottom: 1rem; }
        .btn { padding: 0.75rem 1.5rem; background: var(--danger); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; }
        .btn:hover { opacity: 0.9; }
        .nav { margin-bottom: 1rem; }
        .nav a { color: var(--text-muted); font-size: 0.9rem; }
        .nav a:hover { color: var(--accent); }
        .result { background: rgba(239,68,68,0.15); border: 1px solid rgba(239,68,68,0.3); border-radius: var(--radius); padding: 1rem; margin-top: 1rem; font-size: 0.85rem; }
        .result pre { white-space: pre-wrap; margin: 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="nav"><a href="<?= $this->BASE_URL ?>Admin/menu">← Kembali ke Menu</a></div>
        <div class="card">
            <h2 style="margin-bottom: 1rem; color: var(--accent);">Delete User</h2>
            <form method="post">
                <label class="form-label">Username yang akan dihapus</label>
                <input type="text" class="form-input" name="user" placeholder="username" required>
                <button type="submit" class="btn">Delete</button>
            </form>
            <?php if ($data !== null) { ?>
                <div class="result">
                    <strong>Hasil:</strong>
                    <pre><?php print_r($data); ?></pre>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
