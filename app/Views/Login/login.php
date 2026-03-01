<!-- Main page content-->
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Chip</title>
    <link rel="icon" type="image/x-icon" href="<?= $this->ASSETS_URL ?>img/favicon.png" />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

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
            --warning-bg: rgba(245, 158, 11, 0.12);
            --radius: 12px;
            --radius-lg: 20px;
        }

        html {
            height: 100%;
        }

        body {
            min-height: 100%;
            font-family: "Segoe UI", system-ui, -apple-system, sans-serif;
            background: var(--bg-dark);
            color: var(--text);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2rem 1rem 3rem;
            background-image:
                radial-gradient(ellipse 80% 50% at 50% -20%, rgba(245, 158, 11, 0.15), transparent),
                radial-gradient(ellipse 60% 40% at 100% 0%, rgba(245, 158, 11, 0.08), transparent);
        }

        .login-container {
            width: 100%;
            max-width: 420px;
        }

        .logo-title {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo-title h1 {
            font-size: 2.5rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            background: linear-gradient(135deg, var(--text) 0%, var(--accent) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .card {
            background: var(--bg-card);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: var(--radius-lg);
            padding: 2rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.4);
        }

        .alert {
            padding: 1rem 1.25rem;
            border-radius: var(--radius);
            margin-bottom: 1.5rem;
            text-align: center;
            font-size: 0.9rem;
        }

        .alert-danger {
            background: var(--danger-bg);
            color: var(--danger);
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--accent);
            margin-bottom: 0.5rem;
            letter-spacing: 0.02em;
        }

        .form-input {
            width: 100%;
            height: 72px;
            padding: 0 1.25rem;
            font-size: 1.75rem;
            font-weight: 600;
            text-align: center;
            letter-spacing: 0.05em;
            background: var(--bg-input);
            border: 2px solid rgba(255, 255, 255, 0.08);
            border-radius: var(--radius);
            color: var(--text);
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-input::placeholder {
            color: var(--text-muted);
            opacity: 0.6;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.2);
        }

        .btn-login {
            width: 100%;
            height: 56px;
            font-size: 1.1rem;
            font-weight: 600;
            letter-spacing: 0.03em;
            color: var(--bg-dark);
            background: linear-gradient(135deg, var(--accent) 0%, #d97706 100%);
            border: none;
            border-radius: var(--radius);
            cursor: pointer;
            transition: transform 0.15s, box-shadow 0.2s;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, var(--accent-hover) 0%, var(--accent) 100%);
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(245, 158, 11, 0.35);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .info-box {
            background: var(--warning-bg);
            border: 1px solid rgba(245, 158, 11, 0.2);
            border-radius: var(--radius);
            padding: 1.25rem;
            font-size: 0.8rem;
            color: var(--text-muted);
            line-height: 1.6;
        }

        .info-box pre {
            font-family: "Consolas", "Monaco", monospace;
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
        <div class="alert alert-danger"><?= $data ?></div>
    <?php } ?>

    <div class="card">
        <form id="loginForm">
            <div class="form-group">
                <label class="form-label" for="user">Chip Username</label>
                <input type="text" class="form-input" id="user" name="user" placeholder="Enter username" autocomplete="username">
            </div>
            <button type="submit" class="btn-login">Login</button>
        </form>
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
