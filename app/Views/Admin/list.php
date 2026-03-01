<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>List User - Admin Chip</title>
    <link rel="icon" type="image/x-icon" href="<?= $this->ASSETS_URL ?>img/favicon.png" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --bg-dark: #0f0f12;
            --bg-card: #18181d;
            --accent: #f59e0b;
            --text: #f4f4f5;
            --text-muted: #a1a1aa;
            --radius: 12px;
        }
        body { font-family: "Segoe UI", system-ui, sans-serif; background: var(--bg-dark); color: var(--text); padding: 2rem; }
        .container { max-width: 700px; margin: 0 auto; }
        .card { background: var(--bg-card); border: 1px solid rgba(255,255,255,0.06); border-radius: var(--radius); padding: 1.5rem; margin-bottom: 1rem; }
        .nav { margin-bottom: 1rem; }
        .nav a { color: var(--text-muted); font-size: 0.9rem; }
        .nav a:hover { color: var(--accent); }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 0.75rem; text-align: left; border-bottom: 1px solid rgba(255,255,255,0.06); }
        th { color: var(--accent); font-size: 0.85rem; }
        .empty { color: var(--text-muted); padding: 2rem; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="nav"><a href="<?= $this->BASE_URL ?>Admin/menu">← Kembali ke Menu</a></div>
        <div class="card">
            <h2 style="margin-bottom: 1rem; color: var(--accent);">Daftar User</h2>
            <?php if (empty($data)) { ?>
                <div class="empty">Belum ada user.</div>
            <?php } else { ?>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Chip Awal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $i => $row) { ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= htmlspecialchars($row['user'] ?? '') ?></td>
                            <td><?= htmlspecialchars($row['chip'] ?? '') ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } ?>
        </div>
    </div>
</body>
