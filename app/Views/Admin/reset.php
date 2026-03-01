<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reset Database - Admin Chip</title>
    <link rel="icon" type="image/x-icon" href="<?= $this->ASSETS_URL ?>img/favicon.png" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --bg-dark: #0f0f12;
            --bg-card: #18181d;
            --danger: #ef4444;
            --text: #f4f4f5;
            --text-muted: #a1a1aa;
            --radius: 12px;
        }
        body { font-family: "Segoe UI", system-ui, sans-serif; background: var(--bg-dark); color: var(--text); padding: 2rem; }
        .container { max-width: 500px; margin: 0 auto; }
        .card { background: var(--bg-card); border: 1px solid rgba(255,255,255,0.06); border-radius: var(--radius); padding: 1.5rem; margin-bottom: 1rem; }
        .btn { padding: 0.75rem 1.5rem; background: var(--danger); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; margin-top: 1rem; }
        .btn:hover { opacity: 0.9; }
        .nav { margin-bottom: 1rem; }
        .nav a { color: var(--text-muted); font-size: 0.9rem; }
        .nav a:hover { color: var(--accent); }
        .warning { background: rgba(239,68,68,0.15); border: 1px solid rgba(239,68,68,0.3); border-radius: var(--radius); padding: 1rem; margin-bottom: 1rem; color: var(--danger); }
        .result { background: rgba(34,197,94,0.15); border: 1px solid rgba(34,197,94,0.3); border-radius: var(--radius); padding: 1rem; margin-top: 1rem; font-size: 0.85rem; }
        .result pre { white-space: pre-wrap; margin: 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="nav"><a href="<?= $this->BASE_URL ?>Admin/menu">← Kembali ke Menu</a></div>
        <div class="card">
            <h2 style="margin-bottom: 1rem; color: var(--danger);">Reset Database</h2>
            <div class="warning">
                <strong>Peringatan!</strong> Aksi ini akan menghapus SEMUA user dan SEMUA data mutasi. Tidak dapat dibatalkan.
            </div>
            <form method="post" onsubmit="return confirm('Yakin hapus semua data?');">
                <input type="hidden" name="confirm" value="yes">
                <button type="submit" class="btn">Reset Semua Data</button>
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
