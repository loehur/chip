<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Chip — Live Penonton</title>
    <link rel="icon" type="image/x-icon" href="<?= $this->ASSETS_URL ?>img/favicon.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700&family=JetBrains+Mono:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --w-bg: #f4f6fb;
            --w-surface: #ffffff;
            --w-surface-2: #f8fafc;
            --w-border: rgba(15,23,42,0.08);
            --w-text: #0f172a;
            --w-muted: #64748b;
            --w-accent: #4f46e5;
            --w-success: #16a34a;
            --w-danger: #dc2626;
            --w-warning: #d97706;
            --w-radius: 14px;
            --w-max: 1100px;
            --w-font: 'DM Sans', -apple-system, sans-serif;
            --w-mono: 'JetBrains Mono', monospace;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: var(--w-font);
            background: var(--w-bg);
            color: var(--w-text);
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 50% at 20% -10%, rgba(99,102,241,0.1), transparent 55%),
                radial-gradient(ellipse 60% 40% at 90% 10%, rgba(168,85,247,0.07), transparent 50%),
                radial-gradient(ellipse 50% 30% at 50% 100%, rgba(34,197,94,0.05), transparent 50%);
            pointer-events: none;
            z-index: 0;
        }
        .watch-app {
            position: relative;
            z-index: 1;
            max-width: var(--w-max);
            margin: 0 auto;
            padding: 0 1rem 2rem;
            min-height: 100vh;
        }
        @media (min-width: 768px) {
            .watch-app { padding: 0 1.5rem 2.5rem; }
        }

        /* Header */
        .watch-header {
            position: sticky;
            top: 0;
            z-index: 50;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            padding: 1rem 0;
            background: linear-gradient(180deg, rgba(244,246,251,0.95) 65%, transparent);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }
        .watch-brand { display: flex; align-items: center; gap: 0.75rem; }
        .watch-logo {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: linear-gradient(135deg, #6366f1, #a855f7);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1.25rem;
            color: #fff;
            box-shadow: 0 4px 16px rgba(99,102,241,0.3);
        }
        .watch-title h1 {
            font-size: 1.25rem;
            font-weight: 700;
            letter-spacing: -0.02em;
        }
        .watch-title span {
            display: block;
            font-size: 0.6875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--w-accent);
            margin-top: 0.125rem;
        }
        .watch-actions {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .live-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.375rem 0.75rem;
            border-radius: 999px;
            font-size: 0.6875rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            background: rgba(220,38,38,0.08);
            color: var(--w-danger);
            border: 1px solid rgba(220,38,38,0.18);
            transition: all 0.3s ease;
        }
        .live-pill.on {
            background: rgba(22,163,74,0.1);
            color: var(--w-success);
            border-color: rgba(22,163,74,0.25);
        }
        .live-pill .dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: currentColor;
        }
        .live-pill.on .dot { animation: pulse 2s ease infinite; }
        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(1.4); }
        }
        .btn-login-link {
            padding: 0.4375rem 0.875rem;
            font-size: 0.75rem;
            font-weight: 600;
            font-family: inherit;
            color: var(--w-text);
            background: var(--w-surface-2);
            border: 1px solid var(--w-border);
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .btn-login-link:hover {
            border-color: rgba(79,70,229,0.35);
            background: rgba(99,102,241,0.06);
        }

        /* Stats bar */
        .watch-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.625rem;
            margin-bottom: 1.25rem;
        }
        @media (min-width: 640px) {
            .watch-stats { gap: 0.875rem; }
        }
        .stat-card {
            background: var(--w-surface);
            border: 1px solid var(--w-border);
            border-radius: var(--w-radius);
            padding: 0.875rem 0.75rem;
            text-align: center;
            transition: border-color 0.2s;
            box-shadow: 0 1px 3px rgba(15,23,42,0.04);
        }
        @media (min-width: 640px) {
            .stat-card { padding: 1rem; }
        }
        .stat-card .label {
            font-size: 0.625rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--w-muted);
            margin-bottom: 0.375rem;
        }
        @media (min-width: 640px) {
            .stat-card .label { font-size: 0.6875rem; }
        }
        .stat-card .value {
            font-family: var(--w-mono);
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: -0.02em;
        }
        @media (min-width: 640px) {
            .stat-card .value { font-size: 1.25rem; }
        }
        .stat-card .value.accent { color: var(--w-accent); }
        .stat-card .value.warn { color: var(--w-warning); }

        /* Layout */
        .watch-grid {
            display: grid;
            gap: 1.25rem;
        }
        @media (min-width: 900px) {
            .watch-grid {
                grid-template-columns: 1fr 1fr;
                align-items: start;
            }
        }
        .watch-panel {
            background: var(--w-surface);
            border: 1px solid var(--w-border);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(15,23,42,0.04);
        }
        .panel-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 1.125rem;
            border-bottom: 1px solid var(--w-border);
            background: var(--w-surface-2);
        }
        .panel-head h2 {
            font-size: 0.875rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .panel-head h2 svg { opacity: 0.7; }
        .panel-body { padding: 0.875rem; }
        @media (min-width: 640px) {
            .panel-body { padding: 1rem; }
        }

        /* Mobile tabs */
        .watch-tabs {
            display: flex;
            gap: 0.375rem;
            padding: 0.25rem;
            background: var(--w-surface);
            border: 1px solid var(--w-border);
            border-radius: var(--w-radius);
            margin-bottom: 1rem;
        }
        @media (min-width: 900px) {
            .watch-tabs { display: none; }
        }
        .watch-tab {
            flex: 1;
            padding: 0.625rem;
            font-size: 0.8125rem;
            font-weight: 600;
            font-family: inherit;
            color: var(--w-muted);
            background: transparent;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .watch-tab.active {
            color: var(--w-accent);
            background: rgba(99,102,241,0.1);
            box-shadow: 0 1px 2px rgba(15,23,42,0.04);
        }
        .watch-mobile-panel { display: none; }
        .watch-mobile-panel.active { display: block; }
        @media (min-width: 900px) {
            .watch-mobile-panel { display: block !important; }
            .watch-desktop-only { display: grid !important; }
        }
        .watch-desktop-only { display: none; }

        /* Skeleton */
        .skel {
            background: linear-gradient(90deg, #e2e8f0 25%, #f1f5f9 50%, #e2e8f0 75%);
            background-size: 200% 100%;
            animation: shimmer 1.4s infinite;
            border-radius: 10px;
        }
        @keyframes shimmer {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
        .loading .skel-wrap { display: block; }
        .loading > :not(.skel-wrap) { display: none !important; }
        .skel-wrap { display: none; }
        .skel-row { height: 64px; margin-bottom: 0.5rem; }

        .watch-footer {
            text-align: center;
            padding: 1.5rem 0 0.5rem;
            font-size: 0.75rem;
            color: #94a3b8;
        }
    </style>
</head>

<body>
    <div class="watch-app">
        <header class="watch-header">
            <div class="watch-brand">
                <div class="watch-logo">C</div>
                <div class="watch-title">
                    <h1>Chip Live</h1>
                    <span>Mode Penonton</span>
                </div>
            </div>
            <div class="watch-actions">
                <span class="live-pill" id="liveStatus">
                    <span class="dot"></span>
                    Offline
                </span>
                <a href="<?= $this->BASE_URL ?>" class="btn-login-link">Login</a>
            </div>
        </header>

        <div class="watch-stats" id="watchStats">
            <div class="stat-card">
                <div class="label">Total Chip</div>
                <div class="value accent" id="statTotal">—</div>
            </div>
            <div class="stat-card">
                <div class="label">Pemain</div>
                <div class="value" id="statPlayers">—</div>
            </div>
            <div class="stat-card">
                <div class="label">Kritis</div>
                <div class="value warn" id="statLow">—</div>
            </div>
        </div>

        <nav class="watch-tabs">
            <button class="watch-tab active" data-tab="leaderboard">Klasemen</button>
            <button class="watch-tab" data-tab="feed">Aktivitas</button>
        </nav>

        <div class="watch-mobile-panel active" id="tab-leaderboard">
            <div class="watch-panel">
                <div class="panel-head">
                    <h2>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9H4.5a2.5 2.5 0 010-5H6M18 9h1.5a2.5 2.5 0 000-5H18"/><path d="M4 22h16"/><path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20 7 22"/><path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20 17 22"/><path d="M18 2H6v7a6 6 0 1012 0V2z"/></svg>
                        Klasemen Saldo
                    </h2>
                </div>
                <div class="panel-body">
                    <div id="watchContent" class="loading">
                        <div class="skel-wrap">
                            <div class="skel skel-row"></div>
                            <div class="skel skel-row"></div>
                            <div class="skel skel-row"></div>
                            <div class="skel skel-row"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="watch-mobile-panel" id="tab-feed">
            <div class="watch-panel">
                <div class="panel-head">
                    <h2>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                        Feed Transfer
                    </h2>
                </div>
                <div class="panel-body">
                    <div id="watchHistory" class="loading">
                        <div class="skel-wrap">
                            <div class="skel skel-row"></div>
                            <div class="skel skel-row"></div>
                            <div class="skel skel-row"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="watch-grid watch-desktop-only">
            <div class="watch-panel">
                <div class="panel-head">
                    <h2>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9H4.5a2.5 2.5 0 010-5H6M18 9h1.5a2.5 2.5 0 000-5H18"/><path d="M4 22h16"/><path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20 7 22"/><path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20 17 22"/><path d="M18 2H6v7a6 6 0 1012 0V2z"/></svg>
                        Klasemen Saldo
                    </h2>
                </div>
                <div class="panel-body" id="watchContentDesktop"></div>
            </div>
            <div class="watch-panel">
                <div class="panel-head">
                    <h2>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                        Feed Transfer
                    </h2>
                </div>
                <div class="panel-body" id="watchHistoryDesktop"></div>
            </div>
        </div>

        <footer class="watch-footer">Chip Live Viewer — hanya menonton, tanpa login</footer>
    </div>
</body>

<script src="<?= $this->ASSETS_URL ?>jquery-3.7.0.min.js"></script>
<script>
    var connect_stat = false;
    var pollTimeout;
    var contentBusy = false;

    function schedulePoll() {
        clearTimeout(pollTimeout);
        pollTimeout = setTimeout(function() {
            refreshAll();
            if (connect_stat) schedulePoll();
        }, 10000);
    }

    $(".watch-tab").on("click", function() {
        var tab = $(this).data("tab");
        $(".watch-tab").removeClass("active");
        $(this).addClass("active");
        $(".watch-mobile-panel").removeClass("active");
        $("#tab-" + tab).addClass("active");
    });

    function isDesktop() {
        return window.matchMedia("(min-width: 900px)").matches;
    }

    function updateStats() {
        var total = $("#watchContent").find("[data-total]").data("total");
        var players = $("#watchContent").find("[data-players]").data("players");
        var low = $("#watchContent").find("[data-low]").data("low");
        if (total !== undefined) {
            $("#statTotal").text(Number(total).toLocaleString());
            $("#statPlayers").text(players);
            $("#statLow").text(low);
        }
    }

    function loadContent($target, callback) {
        $target.load("<?= $this->BASE_URL ?>Watch/content", function() {
            $target.removeClass("loading");
            if (callback) callback();
        });
    }

    function loadHistory($target) {
        $target.load("<?= $this->BASE_URL ?>Watch/history", function() {
            $target.removeClass("loading");
        });
    }

    function refreshAll() {
        if (contentBusy) return;
        contentBusy = true;

        loadContent($("#watchContent"), function() {
            updateStats();
            if (isDesktop()) {
                $("#watchContentDesktop").html($("#watchContent").html());
            }
            contentBusy = false;
        });

        loadHistory($("#watchHistory"));
        if (isDesktop()) {
            loadHistory($("#watchHistoryDesktop"));
        }
    }

    $(document).ready(function() {
        refreshAll();
    });

    var sock = new WebSocket('<?= $this->WS_SERV ?>');
    sock.onopen = function() {
        connect_stat = true;
        $("#liveStatus").addClass("on").html('<span class="dot"></span> Live');
        schedulePoll();
    };
    sock.onmessage = function() {
        refreshAll();
        schedulePoll();
    };
    sock.onclose = function() {
        connect_stat = false;
        clearTimeout(pollTimeout);
        setInterval(refreshAll, 5000);
        $("#liveStatus").removeClass("on").html('<span class="dot"></span> Offline');
    };

    $(window).on("resize", function() {
        if (isDesktop() && $("#watchContent").html()) {
            $("#watchContentDesktop").html($("#watchContent").html());
            if (!$("#watchHistoryDesktop").children().length) {
                loadHistory($("#watchHistoryDesktop"));
            }
        }
    });
</script>
