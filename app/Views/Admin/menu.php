<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Menu - Chip</title>
    <link rel="icon" type="image/x-icon" href="<?= $this->ASSETS_URL ?>img/favicon.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --bg: #0a0a0b; --card: #111113;
            --border: rgba(255,255,255,0.04); --border-hover: rgba(255,255,255,0.08);
            --text: #fafafa; --muted: #71717a; --accent: #a1a1aa;
            --danger: #dc2626; --danger-soft: rgba(220,38,38,0.1);
            --radius: 10px; --radius-lg: 16px;
        }
        body {
            min-height: 100vh;
            font-family: 'DM Sans', -apple-system, sans-serif;
            background: var(--bg); color: var(--text);
            padding: 2.5rem 1.5rem; -webkit-font-smoothing: antialiased;
        }
        .container { max-width: 520px; margin: 0 auto; }
        h1 { font-size: 1.5rem; font-weight: 600; letter-spacing: -0.02em; margin-bottom: 1.75rem; color: var(--text); }
        .menu-grid { display: grid; gap: 0.5rem; }
        .menu-item {
            display: block;
            padding: 1rem 1.25rem;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            color: var(--text);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9375rem;
            transition: border-color 0.2s, background 0.2s;
        }
        .menu-item:hover {
            border-color: var(--border-hover);
            background: #18181b;
        }
        .menu-item.danger:hover {
            border-color: rgba(220,38,38,0.3);
            background: var(--danger-soft);
        }
        .menu-desc { font-size: 0.75rem; color: var(--muted); margin-top: 0.25rem; font-weight: 400; }
        .logout { margin-top: 2rem; text-align: center; }
        .logout a { font-size: 0.8125rem; color: var(--muted); text-decoration: none; }
        .logout a:hover { color: var(--accent); }
    </style>
</head>
<body>
    <div class="container">
        <h1>Menu Admin</h1>
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
