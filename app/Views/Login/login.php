<!-- Main page content-->
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Chip</title>
    <link rel="icon" type="image/x-icon" href="<?= $this->ASSETS_URL ?>img/favicon.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --bg: #0a0a0b;
            --card: #111113;
            --input: #1c1c1f;
            --border: rgba(255,255,255,0.04);
            --text: #fafafa;
            --muted: #71717a;
            --subtle: #52525b;
            --accent: #a1a1aa;
            --danger: #dc2626;
            --danger-soft: rgba(220,38,38,0.12);
            --radius: 10px;
            --radius-lg: 16px;
        }
        html { height: 100%; }
        body {
            min-height: 100%;
            font-family: 'DM Sans', -apple-system, sans-serif;
            background: var(--bg);
            color: var(--text);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 3rem 1.5rem 4rem;
            -webkit-font-smoothing: antialiased;
        }
        .login-container { width: 100%; max-width: 400px; }
        .logo-title { text-align: center; margin-bottom: 2.5rem; }
        .logo-title h1 {
            font-size: 2.25rem;
            font-weight: 600;
            letter-spacing: -0.03em;
            color: var(--text);
        }
        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 2rem;
            margin-bottom: 1.25rem;
        }
        .alert {
            padding: 1rem 1.25rem;
            border-radius: var(--radius);
            margin-bottom: 1.25rem;
            text-align: center;
            font-size: 0.875rem;
            background: var(--danger-soft);
            color: var(--danger);
            border: 1px solid rgba(220,38,38,0.25);
        }
        .form-group { margin-bottom: 1.5rem; }
        .form-label {
            display: block;
            font-size: 0.8125rem;
            font-weight: 500;
            color: var(--muted);
            margin-bottom: 0.5rem;
        }
        .form-input {
            width: 100%;
            height: 56px;
            padding: 0 1.25rem;
            font-size: 1.125rem;
            font-family: inherit;
            text-align: center;
            background: var(--input);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            color: var(--text);
            transition: border-color 0.2s, background 0.2s;
        }
        .form-input::placeholder { color: var(--subtle); }
        .form-input:focus {
            outline: none;
            border-color: rgba(255,255,255,0.12);
            background: #18181b;
        }
        .btn-login {
            width: 100%;
            height: 52px;
            font-size: 0.9375rem;
            font-weight: 500;
            font-family: inherit;
            color: var(--bg);
            background: var(--text);
            border: 1px solid var(--text);
            border-radius: var(--radius);
            cursor: pointer;
            transition: background 0.2s, color 0.2s, border-color 0.2s;
        }
        .btn-login:hover {
            background: var(--accent);
            border-color: var(--accent);
            color: var(--bg);
        }
        .admin-link {
            display: block;
            text-align: center;
            margin-top: 1.25rem;
            font-size: 0.8125rem;
            color: var(--muted);
            text-decoration: none;
            transition: color 0.2s;
        }
        .admin-link:hover { color: var(--accent); }
        .info-box {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.25rem;
            font-size: 0.75rem;
            color: var(--muted);
            line-height: 1.7;
        }
        .info-box pre {
            font-family: 'SF Mono', Consolas, monospace;
            white-space: pre-wrap;
            word-break: break-all;
            margin: 0;
        }
    </style>
</head>

<div class="login-container">
    <div class="logo-title">
        <h1>Chip</h1>
    </div>

    <?php if (strlen($data) > 0) { ?>
        <div class="alert"><?= htmlspecialchars($data) ?></div>
    <?php } ?>

    <div class="card">
        <form id="loginForm">
            <div class="form-group">
                <label class="form-label" for="user">Chip Username</label>
                <input type="text" class="form-input" id="user" name="user" placeholder="Enter username" autocomplete="username">
            </div>
            <button type="submit" class="btn-login">Login</button>
        </form>
        <a href="<?= $this->BASE_URL ?>Admin" class="admin-link">Admin Menu</a>
    </div>

    <div class="info-box">
        <small>
            <?php
            $info = [
                "create" => [
                    "message" => "create user",
                    "params" => "[name1],[nama2],dst/chip",
                ],
                "delete" => [
                    "message" => "delete user",
                    "params" => "[name]"
                ],
                "reset" => [
                    "message" => "clear database",
                    "params" => "",
                ],
                "reset_coin" => [
                    "message" => "reset user coin to default",
                    "params" => "",
                ],
                "list" => [
                    "message" => "view all user",
                    "params" => "",
                ]
            ];
            echo "<pre>";
            print_r($info);
            echo "</pre>";
            ?>
        </small>
    </div>
</div>

<script>
    (function() {
        var baseUrl = "<?= $this->BASE_URL ?>";
        var form = document.getElementById("loginForm");
        var input = document.getElementById("user");

        function doLogin() {
            var user = input.value.trim();
            if (user) {
                window.location.href = baseUrl + "Room/i/" + user;
            }
        }

        form.addEventListener("submit", function(e) {
            e.preventDefault();
            doLogin();
        });

        input.addEventListener("keypress", function(e) {
            if (e.key === "Enter") {
                e.preventDefault();
                doLogin();
            }
        });
    })();
</script>
