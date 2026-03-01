<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Menu - Chip</title>
    <link rel="icon" type="image/x-icon" href="<?= $this->ASSETS_URL ?>img/favicon.png" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --bg-dark: #0f0f12;
            --bg-card: #18181d;
            --accent: #f59e0b;
            --accent-hover: #fbbf24;
            --text: #f4f4f5;
            --text-muted: #a1a1aa;
            --radius: 12px;
            --radius-lg: 20px;
        }
        body {
            min-height: 100vh;
            font-family: "Segoe UI", system-ui, sans-serif;
            background: var(--bg-dark);
            color: var(--text);
            padding: 2rem;
            background-image: radial-gradient(ellipse 80% 50% at 50% -20%, rgba(245, 158, 11, 0.15), transparent);
        }
        .container { max-width: 600px; margin: 0 auto; }
        h1 { margin-bottom: 1.5rem; font-size: 1.75rem; color: var(--accent); }
        .menu-grid { display: grid; gap: 0.75rem; }
        .menu-item {
            display: block;
            padding: 1rem 1.25rem;
            background: var(--bg-card);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: var(--radius);
            color: var(--text);
            text-decoration: none;
            font-weight: 500;
            transition: border-color 0.2s, background 0.2s;
        }
        .menu-item:hover {
            border-color: var(--accent);
            background: rgba(245, 158, 11, 0.08);
        }
        .menu-item.danger:hover { border-color: #ef4444; background: rgba(239, 68, 68, 0.08); }
        .menu-desc { font-size: 0.8rem; color: var(--text-muted); margin-top: 0.25rem; }
        .logout { margin-top: 2rem; text-align: center; }
        .logout a { color: var(--text-muted); font-size: 0.9rem; }
        .logout a:hover { color: var(--accent); }
    </style>
</head>
<body>
    <div class="container">
        <h1>Menu Admin Chip</h1>
        <div class="menu-grid">
            <a href="<?= $this->BASE_URL ?>Admin/create" class="menu-item">
                Create
                <div class="menu-desc">Buat user baru (nama1,nama2,... / chip)</div>
            </a>
            <a href="<?= $this->BASE_URL ?>Admin/delete" class="menu-item">
                Delete
                <div class="menu-desc">Hapus user berdasarkan nama</div>
            </a>
            <a href="<?= $this->BASE_URL ?>Admin/list" class="menu-item">
                List
                <div class="menu-desc">Lihat semua user</div>
            </a>
            <a href="<?= $this->BASE_URL ?>Admin/reset_coin" class="menu-item danger">
                Reset Coin
                <div class="menu-desc">Reset saldo coin ke default (hapus mutasi)</div>
            </a>
            <a href="<?= $this->BASE_URL ?>Admin/reset" class="menu-item danger">
                Reset
                <div class="menu-desc">Hapus semua user dan mutasi (clear database)</div>
            </a>
        </div>
        <div class="logout">
            <a href="<?= $this->BASE_URL ?>Admin/logout">Logout Admin</a>
        </div>
    </div>
</body>
