<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Chip Viewer</title>
    <?php $this->headIcons(); ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=JetBrains+Mono:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --chip-bg: #070708;
            --chip-surface: #111113;
            --chip-surface-2: #18181b;
            --chip-input: #1c1c1f;
            --chip-border: rgba(255,255,255,0.06);
            --chip-border-hover: rgba(255,255,255,0.12);
            --chip-text: #fafafa;
            --chip-muted: #71717a;
            --chip-success: #22c55e;
            --chip-danger: #ef4444;
            --chip-primary: #6366f1;
            --chip-warning: #f59e0b;
            --chip-glow: rgba(99,102,241,0.35);
            --chip-radius: 12px;
            --chip-radius-lg: 20px;
            --chip-font: 'DM Sans', -apple-system, sans-serif;
            --chip-mono: 'JetBrains Mono', monospace;
            --viewer-max: 560px;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { height: 100%; scroll-behavior: smooth; }
        body {
            font-family: var(--chip-font);
            background: var(--chip-bg);
            color: var(--chip-text);
            -webkit-font-smoothing: antialiased;
            min-height: 100vh;
            overflow-x: hidden;
        }
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse 90% 60% at 50% -10%, rgba(99,102,241,0.18), transparent 55%),
                radial-gradient(ellipse 60% 40% at 100% 20%, rgba(139,92,246,0.1), transparent 50%),
                radial-gradient(ellipse 50% 40% at 0% 90%, rgba(59,130,246,0.08), transparent 50%);
            pointer-events: none;
            z-index: 0;
        }
        .viewer-app {
            position: relative;
            z-index: 1;
            max-width: var(--viewer-max);
            margin: 0 auto;
            padding: 0 1rem 6rem;
            min-height: 100vh;
        }
        @media (min-width: 768px) {
            :root { --viewer-max: 720px; }
            .viewer-app { padding: 0 1.5rem 6rem; }
        }
        @media (min-width: 1024px) {
            :root { --viewer-max: 900px; }
        }

        /* Header */
        .viewer-header {
            position: sticky;
            top: 0;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            padding: 0.875rem 0;
            margin-bottom: 0.5rem;
            background: linear-gradient(180deg, var(--chip-bg) 70%, transparent);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .viewer-brand {
            display: flex;
            align-items: center;
            gap: 0.625rem;
        }
        .viewer-logo {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.125rem;
            font-weight: 700;
            box-shadow: 0 4px 16px rgba(99,102,241,0.35);
        }
        .viewer-brand-text h1 {
            font-size: 1.125rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            line-height: 1.2;
        }
        .viewer-brand-text span {
            font-size: 0.6875rem;
            color: var(--chip-muted);
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }
        .viewer-header-actions {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .live-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.375rem 0.625rem;
            border-radius: 999px;
            font-size: 0.6875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            background: rgba(239,68,68,0.12);
            color: #f87171;
            border: 1px solid rgba(239,68,68,0.2);
            transition: all 0.3s ease;
        }
        .live-badge.connected {
            background: rgba(34,197,94,0.12);
            color: var(--chip-success);
            border-color: rgba(34,197,94,0.25);
        }
        .live-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }
        .live-badge.connected .live-dot {
            animation: pulse-dot 2s ease-in-out infinite;
        }
        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(1.3); }
        }
        .btn-logout {
            padding: 0.375rem 0.75rem;
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--chip-muted);
            background: var(--chip-surface);
            border: 1px solid var(--chip-border);
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            font-family: inherit;
            transition: all 0.2s ease;
        }
        .btn-logout:hover {
            color: var(--chip-text);
            border-color: var(--chip-border-hover);
            background: var(--chip-surface-2);
        }

        /* Tab navigation */
        .viewer-tabs {
            display: flex;
            gap: 0.375rem;
            padding: 0.25rem;
            background: var(--chip-surface);
            border: 1px solid var(--chip-border);
            border-radius: var(--chip-radius);
            margin-bottom: 1.25rem;
        }
        .viewer-tab {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.375rem;
            padding: 0.625rem 0.75rem;
            font-size: 0.8125rem;
            font-weight: 600;
            font-family: inherit;
            color: var(--chip-muted);
            background: transparent;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.25s ease;
        }
        .viewer-tab svg { opacity: 0.6; transition: opacity 0.2s; }
        .viewer-tab:hover { color: var(--chip-text); }
        .viewer-tab.active {
            color: var(--chip-text);
            background: linear-gradient(135deg, rgba(99,102,241,0.2) 0%, rgba(139,92,246,0.12) 100%);
            box-shadow: 0 2px 8px rgba(99,102,241,0.15);
        }
        .viewer-tab.active svg { opacity: 1; }

        /* Panels */
        .viewer-panel { display: none; }
        .viewer-panel.active { display: block; }

        /* Section title */
        .section-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--chip-muted);
            margin-bottom: 0.75rem;
        }
        .section-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--chip-border);
        }

        /* Offcanvas */
        .offcanvas-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.6);
            backdrop-filter: blur(4px);
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .offcanvas-backdrop.show {
            display: block;
            opacity: 1;
        }
        .offcanvas-panel {
            position: fixed;
            top: 0;
            left: 50%;
            transform: translateX(-50%) translateY(-100%);
            width: 100%;
            max-width: var(--viewer-max);
            background: linear-gradient(180deg, #111113 0%, #1a1a1e 100%);
            border: 1px solid var(--chip-border);
            border-top: none;
            border-radius: 0 0 var(--chip-radius-lg) var(--chip-radius-lg);
            box-shadow: 0 8px 40px rgba(0,0,0,0.5), 0 0 60px rgba(99,102,241,0.08);
            z-index: 1001;
            transition: transform 0.35s cubic-bezier(0.32, 0.72, 0, 1);
            overflow: hidden;
        }
        .offcanvas-panel.show { transform: translateX(-50%) translateY(0); }
        .offcanvas-handle {
            width: 36px;
            height: 4px;
            background: rgba(255,255,255,0.15);
            border-radius: 2px;
            margin: 0 auto 0.75rem;
        }
        .offcanvas-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 1rem 1.25rem 0.75rem;
        }
        .offcanvas-title {
            font-size: 0.9375rem;
            font-weight: 500;
            color: var(--chip-muted);
            line-height: 1.5;
        }
        .offcanvas-title b {
            display: block;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--chip-danger);
            margin-top: 0.125rem;
        }
        .btn-close {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--chip-surface);
            border: 1px solid var(--chip-border);
            border-radius: 10px;
            color: var(--chip-muted);
            font-size: 1.25rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .btn-close:hover {
            color: var(--chip-text);
            border-color: var(--chip-border-hover);
        }
        .offcanvas-body { padding: 0.75rem 1.25rem 0.5rem; }
        .transfer-input {
            width: 100%;
            height: 96px;
            padding: 0 1rem;
            font-family: var(--chip-mono);
            font-size: 2.5rem;
            font-weight: 600;
            text-align: center;
            background: var(--chip-input);
            border: 1px solid var(--chip-border);
            border-radius: var(--chip-radius);
            color: var(--chip-text);
            transition: all 0.2s ease;
        }
        .transfer-input:focus {
            outline: none;
            border-color: rgba(99,102,241,0.5);
            box-shadow: 0 0 0 3px rgba(99,102,241,0.15);
        }
        .transfer-input::-webkit-outer-spin-button,
        .transfer-input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
        .fast-chip-row { display: flex; gap: 0.5rem; margin-top: 0.875rem; }
        .fast-chip-btn {
            flex: 1;
            padding: 0.875rem;
            font-family: var(--chip-mono);
            font-size: 1.125rem;
            font-weight: 600;
            background: var(--chip-surface);
            border: 1px solid var(--chip-border);
            border-radius: var(--chip-radius);
            color: var(--chip-text);
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .fast-chip-btn:hover {
            background: linear-gradient(135deg, rgba(99,102,241,0.15) 0%, rgba(139,92,246,0.1) 100%);
            border-color: rgba(99,102,241,0.35);
            transform: translateY(-1px);
        }
        .btn-transfer {
            width: 100%;
            margin-top: 0.875rem;
            padding: 1rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            font-family: inherit;
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            border: none;
            border-radius: var(--chip-radius);
            color: white;
            cursor: pointer;
            box-shadow: 0 4px 20px rgba(239,68,68,0.35);
            transition: all 0.2s ease;
        }
        .btn-transfer:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 24px rgba(239,68,68,0.45);
        }
        .btn-transfer:active { transform: translateY(0); }

        /* Toast */
        .viewer-toast {
            position: fixed;
            bottom: 1.5rem;
            left: 50%;
            transform: translateX(-50%) translateY(120%);
            padding: 0.75rem 1.25rem;
            background: var(--chip-surface-2);
            border: 1px solid var(--chip-border);
            border-radius: 999px;
            font-size: 0.8125rem;
            font-weight: 500;
            color: var(--chip-text);
            box-shadow: 0 8px 32px rgba(0,0,0,0.4);
            z-index: 2000;
            transition: transform 0.35s cubic-bezier(0.32, 0.72, 0, 1);
            white-space: nowrap;
        }
        .viewer-toast.show { transform: translateX(-50%) translateY(0); }
    </style>
</head>

<body>
    <script>
        (function() {
            var base = "<?= rtrim($this->ASSETS_URL, '/') ?>/audio/";
            var origin = window.location.origin || (window.location.protocol + "//" + window.location.host);
            if (base.indexOf("http") !== 0) base = origin + (base.charAt(0) === "/" ? base : "/" + base);
            window.AUDIO_URL = {
                coinout: base + "coinout.wav",
                coinin: base + "coinin.wav",
                kritis: base + "kritis.wav"
            };
        })();
    </script>

    <div class="viewer-app">
        <header class="viewer-header">
            <div class="viewer-brand">
                <div class="viewer-logo">C</div>
                <div class="viewer-brand-text">
                    <h1>Chip</h1>
                    <span>Live Viewer</span>
                </div>
            </div>
            <div class="viewer-header-actions">
                <span class="live-badge" id="server_status">
                    <span class="live-dot"></span>
                    Offline
                </span>
                <a href="<?= $this->BASE_URL ?>Room/logout" class="btn-logout">Logout</a>
            </div>
        </header>

        <nav class="viewer-tabs" role="tablist">
            <button class="viewer-tab active" data-panel="saldo" role="tab" aria-selected="true">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v12M8 10h8M8 14h5"/></svg>
                Saldo
            </button>
            <button class="viewer-tab" data-panel="riwayat" role="tab" aria-selected="false">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 8v4l3 3"/><circle cx="12" cy="12" r="10"/></svg>
                Riwayat
            </button>
        </nav>

        <div class="viewer-panel active" id="panel-saldo" role="tabpanel">
            <div id="content"></div>
        </div>

        <div class="viewer-panel" id="panel-riwayat" role="tabpanel">
            <div class="section-label">Transaksi Terakhir</div>
            <div id="mutasi"></div>
        </div>
    </div>

    <div class="offcanvas-backdrop" id="offcanvasBackdrop"></div>
    <div class="offcanvas-panel" id="offcanvasTop">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Transfer ke<b id="target">—</b></h5>
            <button type="button" class="btn-close" id="offcanvasClose">&times;</button>
        </div>
        <div class="offcanvas-body">
            <form action="<?= $this->BASE_URL ?>Room/transfer" method="POST" id="transferForm">
                <input name="c" type="number" class="transfer-input" placeholder="0" inputmode="numeric">
                <input name="t" type="hidden">
                <div class="fast-chip-row">
                    <?php
                    $all = $this->model("M_DB_1")->get_order("mutasi", "id DESC LIMIT 200");
                    $counts = [];
                    foreach ($all as $row) {
                        $c = $row['chip'];
                        $counts[$c] = ($counts[$c] ?? 0) + 1;
                    }
                    arsort($counts);
                    $top2 = array_slice(array_keys($counts), 0, 2);
                    foreach ($top2 as $chip) { ?>
                        <button type="button" class="fast-chip-btn fastChip" data-chip="<?= $chip ?>"><?= number_format($chip) ?></button>
                    <?php } ?>
                </div>
                <button type="submit" id="submit" class="btn-transfer">Kirim Chip</button>
            </form>
        </div>
        <div class="offcanvas-handle"></div>
    </div>

    <div class="viewer-toast" id="viewerToast"></div>
</body>

<script src="<?= $this->ASSETS_URL ?>jquery-3.7.0.min.js"></script>

<script>
    var connect_stat = false;
    var pollTimeout;
    var offlinePollInterval;
    var wsDebounceTimer;
    var contentLoading = false;
    var lastManualRefresh = 0;
    var POLL_MS = 30000;
    var OFFLINE_POLL_MS = 20000;
    var WS_DEBOUNCE_MS = 2000;

    function schedulePoll() {
        clearTimeout(pollTimeout);
        pollTimeout = setTimeout(function() {
            content();
            if (connect_stat) schedulePoll();
        }, POLL_MS);
    }

    function startOfflinePoll() {
        clearInterval(offlinePollInterval);
        offlinePollInterval = setInterval(content, OFFLINE_POLL_MS);
    }

    function refreshFromWs() {
        if (Date.now() - lastManualRefresh < WS_DEBOUNCE_MS) return;
        clearTimeout(wsDebounceTimer);
        wsDebounceTimer = setTimeout(function() {
            content();
            schedulePoll();
        }, WS_DEBOUNCE_MS);
    }

    function showToast(msg) {
        var $t = $("#viewerToast");
        $t.text(msg).addClass("show");
        setTimeout(function() { $t.removeClass("show"); }, 2500);
    }

    function openOffcanvas() {
        $("#offcanvasBackdrop").addClass("show");
        $("#offcanvasTop").addClass("show");
        document.body.style.overflow = "hidden";
    }
    function closeOffcanvas() {
        $("#offcanvasBackdrop").removeClass("show");
        $("#offcanvasTop").removeClass("show");
        document.body.style.overflow = "";
    }

    $(".viewer-tab").on("click", function() {
        var panel = $(this).data("panel");
        $(".viewer-tab").removeClass("active").attr("aria-selected", "false");
        $(this).addClass("active").attr("aria-selected", "true");
        $(".viewer-panel").removeClass("active");
        $("#panel-" + panel).addClass("active");
    });

    $(document).ready(function() {
        content();
        $(document).one("click touchstart", function() { unlockAudio(); });

        $("#offcanvasClose, #offcanvasBackdrop").on("click", closeOffcanvas);

        $(document).on("click", ".bayar", function() {
            var t = $(this).data("user");
            $("input[name=t]").val(t);
            $("#target").text(t.toUpperCase());
            $("input[name=c]").val("");
            openOffcanvas();
            setTimeout(function() { $("input[name=c]").focus(); }, 350);
        });

        $(".fastChip").on("click", function() {
            $("input[name=c]").val($(this).data("chip"));
            $("#submit").click();
        });
    });

    var sock = new WebSocket('<?= $this->WS_SERV ?>');
    sock.onopen = function() {
        connect_stat = true;
        clearInterval(offlinePollInterval);
        $("#server_status").addClass("connected").html('<span class="live-dot"></span> Live');
        schedulePoll();
    };
    sock.onmessage = function() {
        refreshFromWs();
    };
    sock.onclose = function() {
        connect_stat = false;
        clearTimeout(pollTimeout);
        clearTimeout(wsDebounceTimer);
        startOfflinePoll();
        $("#server_status").removeClass("connected").html('<span class="live-dot"></span> Offline');
    };

    var audioUnlocked = false;
    function unlockAudio() {
        if (audioUnlocked) return;
        try {
            var a = new Audio(AUDIO_URL.coinout);
            a.volume = 0;
            a.play().then(function() { a.pause(); }).catch(function(){});
        } catch(e) {}
        audioUnlocked = true;
    }

    function playCoinout() {
        try { new Audio(AUDIO_URL.coinout).play().catch(function(){}); } catch(e) {}
    }
    function playCoinin() {
        unlockAudio();
        try { new Audio(AUDIO_URL.coinin).play().catch(function(){}); } catch(e) {}
    }
    var kritisAudio = null, kritisPlaying = false;
    function startKritisLoop() {
        if (kritisPlaying) return;
        unlockAudio();
        try {
            kritisAudio = kritisAudio || new Audio(AUDIO_URL.kritis);
            kritisAudio.loop = true;
            kritisAudio.play().then(function() { kritisPlaying = true; }).catch(function(){});
        } catch(e) {}
    }
    function stopKritisLoop() {
        if (!kritisPlaying || !kritisAudio) return;
        try {
            kritisAudio.pause();
            kritisAudio.currentTime = 0;
            kritisPlaying = false;
        } catch(e) {}
    }

    function content() {
        if (contentLoading) return;
        contentLoading = true;
        var oldChip = parseInt($(".chip-hero-value").first().text().replace(/,/g, '')) || 0;
        $("#content").load('<?= $this->BASE_URL ?><?= $data['page'] ?>/content', function() {
            contentLoading = false;
            var newChip = parseInt($(".chip-hero-value").first().text().replace(/,/g, '')) || 0;
            if (newChip <= 300) startKritisLoop(); else stopKritisLoop();
            if (oldChip > 0 && newChip > oldChip) playCoinin();
        });
        mutasi();
    }

    function mutasi() {
        $("#mutasi").load("<?= $this->BASE_URL ?>Room/cek");
    }

    $("#transferForm").on("submit", function(e) {
        e.preventDefault();
        var val = $("input[name=c]").val();
        if (val == "" || parseInt(val) <= 0) {
            showToast("Masukkan jumlah chip");
            return;
        }
        playCoinout();
        var $btn = $("#submit");
        $btn.prop("disabled", true).text("Mengirim...");
        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            type: $(this).attr("method"),
            success: function(res) {
                $btn.prop("disabled", false).text("Kirim Chip");
                if (res == 0) {
                    $("input[name=c]").val("");
                    closeOffcanvas();
                    lastManualRefresh = Date.now();
                    content();
                    showToast("Transfer berhasil!");
                    if (connect_stat === true) sock.send(JSON.stringify({ text: 0 }));
                } else {
                    showToast("Transfer gagal");
                }
            },
            error: function() {
                $btn.prop("disabled", false).text("Kirim Chip");
                showToast("Koneksi error");
            }
        });
    });
</script>
