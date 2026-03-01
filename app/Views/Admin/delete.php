<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Delete User - Admin Chip</title>
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
        body { font-family: 'DM Sans', -apple-system, sans-serif; background: var(--bg); color: var(--text); padding: 2rem; -webkit-font-smoothing: antialiased; }
        .container { max-width: 480px; margin: 0 auto; }
        .card { background: var(--card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 1.75rem; margin-bottom: 1rem; }
        .nav { margin-bottom: 1.25rem; }
        .nav a { font-size: 0.8125rem; color: var(--muted); text-decoration: none; }
        .nav a:hover { color: var(--accent); }
        h2 { font-size: 1.25rem; font-weight: 600; margin-bottom: 1.25rem; color: var(--text); }
        .form-label { display: block; font-size: 0.8125rem; color: var(--muted); margin-bottom: 0.5rem; }
        .form-input { width: 100%; padding: 0.75rem 1rem; font-size: 0.9375rem; font-family: inherit; background: var(--input); border: 1px solid var(--border); border-radius: var(--radius); color: var(--text); margin-bottom: 1rem; }
        .form-input:focus { outline: none; border-color: rgba(255,255,255,0.12); }
        .btn { padding: 0.75rem 1.5rem; font-size: 0.9375rem; font-weight: 500; font-family: inherit; background: var(--danger-soft); color: var(--danger); border: 1px solid rgba(220,38,38,0.3); border-radius: var(--radius); cursor: pointer; transition: all 0.2s; }
        .btn:hover { background: var(--danger); color: white; border-color: var(--danger); }
        .result { background: var(--danger-soft); border: 1px solid rgba(220,38,38,0.25); border-radius: var(--radius); padding: 1rem; margin-top: 1.25rem; font-size: 0.8125rem; }
        .result pre { white-space: pre-wrap; margin: 0; font-family: 'SF Mono', Consolas, monospace; }
    </style>
</head>
<body>
    <div class="container">
        <div class="nav"><a href="<?= $this->BASE_URL ?>Admin/menu">← Kembali ke Menu</a></div>
        <div class="card">
            <h2>Delete User</h2>
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
