<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>List User - Admin Chip</title>
    <link rel="icon" type="image/x-icon" href="<?= $this->ASSETS_URL ?>img/favicon.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --bg: #0a0a0b; --card: #111113;
            --border: rgba(255,255,255,0.04); --text: #fafafa;
            --muted: #71717a; --accent: #a1a1aa; --radius: 10px; --radius-lg: 16px;
        }
        body { font-family: 'DM Sans', -apple-system, sans-serif; background: var(--bg); color: var(--text); padding: 2rem; -webkit-font-smoothing: antialiased; }
        .container { max-width: 560px; margin: 0 auto; }
        .card { background: var(--card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 1.75rem; margin-bottom: 1rem; }
        .nav { margin-bottom: 1.25rem; }
        .nav a { font-size: 0.8125rem; color: var(--muted); text-decoration: none; }
        .nav a:hover { color: var(--accent); }
        h2 { font-size: 1.25rem; font-weight: 600; margin-bottom: 1.25rem; color: var(--text); }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 0.75rem 1rem; text-align: left; border-bottom: 1px solid var(--border); font-size: 0.9375rem; }
        th { font-weight: 500; color: var(--muted); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; }
        tr:last-child td { border-bottom: none; }
        .empty { color: var(--muted); padding: 2.5rem; text-align: center; font-size: 0.9375rem; }
    </style>
</head>
<body>
    <div class="container">
        <div class="nav"><a href="<?= $this->BASE_URL ?>Admin/menu">← Kembali ke Menu</a></div>
        <div class="card">
            <h2>Daftar User</h2>
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
