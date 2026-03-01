<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reset Coin - Admin Chip</title>
    <link rel="icon" type="image/x-icon" href="<?= $this->ASSETS_URL ?>img/favicon.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --bg: #0a0a0b; --card: #111113;
            --border: rgba(255,255,255,0.04); --text: #fafafa;
            --muted: #71717a; --accent: #a1a1aa; --danger: #dc2626;
            --danger-soft: rgba(220,38,38,0.12); --success-soft: rgba(34,197,94,0.12);
            --radius: 10px; --radius-lg: 16px;
        }
        body { font-family: 'DM Sans', -apple-system, sans-serif; background: var(--bg); color: var(--text); padding: 2rem; -webkit-font-smoothing: antialiased; }
        .container { max-width: 480px; margin: 0 auto; }
        .card { background: var(--card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 1.75rem; margin-bottom: 1rem; }
        .nav { margin-bottom: 1.25rem; }
        .nav a { font-size: 0.8125rem; color: var(--muted); text-decoration: none; }
        .nav a:hover { color: var(--accent); }
        h2 { font-size: 1.25rem; font-weight: 600; margin-bottom: 1.25rem; color: var(--danger); }
        .warning { background: var(--danger-soft); border: 1px solid rgba(220,38,38,0.25); border-radius: var(--radius); padding: 1rem; margin-bottom: 1.25rem; font-size: 0.875rem; color: var(--danger); }
        .btn { padding: 0.75rem 1.5rem; font-size: 0.9375rem; font-weight: 500; font-family: inherit; background: var(--danger-soft); color: var(--danger); border: 1px solid rgba(220,38,38,0.3); border-radius: var(--radius); cursor: pointer; margin-top: 0.5rem; transition: all 0.2s; }
        .btn:hover { background: var(--danger); color: white; border-color: var(--danger); }
        .result { background: var(--success-soft); border: 1px solid rgba(34,197,94,0.25); border-radius: var(--radius); padding: 1rem; margin-top: 1.25rem; font-size: 0.8125rem; }
        .result pre { white-space: pre-wrap; margin: 0; font-family: 'SF Mono', Consolas, monospace; }
    </style>
</head>
<body>
    <div class="container">
        <div class="nav"><a href="<?= $this->BASE_URL ?>Admin/menu">← Kembali ke Menu</a></div>
        <div class="card">
            <h2>Reset Coin</h2>
            <div class="warning">
                <strong>Peringatan!</strong> Aksi ini akan menghapus semua data mutasi (transfer). Saldo semua user akan kembali ke chip awal.
            </div>
            <form method="post" onsubmit="return confirm('Yakin reset coin?');">
                <input type="hidden" name="confirm" value="yes">
                <button type="submit" class="btn">Reset Coin</button>
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
