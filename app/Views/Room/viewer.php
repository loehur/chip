<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Chip</title>
    <link rel="icon" type="image/x-icon" href="<?= $this->ASSETS_URL ?>img/favicon.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700&display=swap" rel="stylesheet">
    <style>
        :root {
            --chip-bg: #0a0a0b; --chip-card: #111113; --chip-input: #1c1c1f;
            --chip-border: rgba(255,255,255,0.06); --chip-text: #fafafa;
            --chip-muted: #71717a; --chip-success: #22c55e; --chip-danger: #dc2626;
            --chip-primary: #3b82f6; --chip-warning: #eab308;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { height: 100%; }
        body {
            max-width: 560px;
            margin: 0 auto;
            padding: 0 1.25rem;
            font-family: 'DM Sans', -apple-system, sans-serif;
            background: var(--chip-bg);
            color: var(--chip-text);
            -webkit-font-smoothing: antialiased;
        }
        .header-row { display: flex; justify-content: space-between; align-items: center; margin-top: 0.75rem; }
        .btn-logout {
            font-size: 0.8125rem;
            color: var(--chip-muted);
            background: none;
            border: none;
            cursor: pointer;
            text-decoration: none;
            font-family: inherit;
        }
        .btn-logout:hover { color: var(--chip-text); }
        .server-status { font-size: 0.8125rem; color: var(--chip-muted); }
        .server-status.connected { color: var(--chip-success); }
        #content { margin-top: 1.5rem; }
        #mutasi { margin-top: 1rem; }
        .offcanvas-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
        }
        .offcanvas-backdrop.show { display: block; }
        .offcanvas-panel {
            position: fixed;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%) translateY(100%);
            width: 100%;
            max-width: 560px;
            height: 450px;
            background: var(--chip-card);
            border: 1px solid var(--chip-border);
            border-bottom: none;
            border-radius: 16px 16px 0 0;
            z-index: 1001;
            transition: transform 0.3s ease;
            overflow: hidden;
        }
        .offcanvas-panel.show { transform: translateX(-50%) translateY(0); }
        .offcanvas-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--chip-border);
        }
        .offcanvas-title { font-size: 1rem; font-weight: 500; color: var(--chip-text); }
        .offcanvas-title b { color: var(--chip-danger); }
        .btn-close {
            width: 32px;
            height: 32px;
            background: transparent;
            border: none;
            color: var(--chip-muted);
            font-size: 1.5rem;
            line-height: 1;
            cursor: pointer;
        }
        .btn-close:hover { color: var(--chip-text); }
        .offcanvas-body { padding: 1rem 1.25rem; }
        .transfer-input {
            width: 100%;
            height: 100px;
            padding: 0 1rem;
            font-size: 2.5rem;
            text-align: center;
            background: var(--chip-input);
            border: 1px solid var(--chip-border);
            border-radius: 10px;
            color: var(--chip-text);
        }
        .transfer-input:focus { outline: none; border-color: rgba(255,255,255,0.15); }
        .transfer-input::-webkit-outer-spin-button,
        .transfer-input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
        .fast-chip-row { display: flex; gap: 0.5rem; margin-top: 1rem; }
        .fast-chip-btn {
            flex: 1;
            padding: 1rem;
            font-size: 1.25rem;
            font-weight: 600;
            background: var(--chip-input);
            border: 1px solid var(--chip-border);
            border-radius: 10px;
            color: var(--chip-text);
            cursor: pointer;
        }
        .fast-chip-btn:hover { border-color: rgba(255,255,255,0.12); }
        .btn-transfer {
            width: 100%;
            margin-top: 1rem;
            padding: 1rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            background: var(--chip-danger);
            border: none;
            border-radius: 10px;
            color: white;
            cursor: pointer;
        }
        .btn-transfer:hover { opacity: 0.9; }
    </style>
</head>

<body>
    <audio id="myAudio">
        <source src="<?= $this->ASSETS_URL ?>audio/coinout.mp3" type="audio/mpeg">
    </audio>

    <div class="header-row">
        <a href="<?= $this->BASE_URL ?>Room/logout" class="btn-logout">Logout</a>
        <span class="server-status" id="server_status">Server &#10007;</span>
    </div>
    <div id="content"></div>
    <div id="mutasi"></div>

    <div class="offcanvas-backdrop" id="offcanvasBackdrop"></div>
    <div class="offcanvas-panel" id="offcanvasBottom">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Transfer Chip to<br><b id="target"></b></h5>
            <button type="button" class="btn-close" id="offcanvasClose">&times;</button>
        </div>
        <div class="offcanvas-body">
            <form action="<?= $this->BASE_URL ?>Room/transfer" method="POST" id="transferForm">
                <input name="c" type="number" class="transfer-input" placeholder="0">
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
                        <button type="button" class="fast-chip-btn fastChip" data-chip="<?= $chip ?>"><?= $chip ?></button>
                    <?php } ?>
                </div>
                <button type="submit" id="submit" class="btn-transfer" onclick="playAudio()">Transfer</button>
            </form>
        </div>
    </div>
</body>

<script src="<?= $this->ASSETS_URL ?>jquery-3.7.0.min.js"></script>

<script>
    var connect_stat = false;
    var pollTimeout;

    function schedulePoll() {
        clearTimeout(pollTimeout);
        pollTimeout = setTimeout(function() {
            content();
            if (connect_stat) schedulePoll();
        }, 10000);
    }

    function openOffcanvas() {
        $("#offcanvasBackdrop").addClass("show");
        $("#offcanvasBottom").addClass("show");
    }
    function closeOffcanvas() {
        $("#offcanvasBackdrop").removeClass("show");
        $("#offcanvasBottom").removeClass("show");
    }

    $(document).ready(function() {
        content();

        $("#offcanvasClose, #offcanvasBackdrop").on("click", closeOffcanvas);

        $(document).on("click", ".bayar", function() {
            var t = $(this).data("user");
            $("input[name=t]").val(t);
            $("#target").text(t.toUpperCase());
            openOffcanvas();
        });

        $(".fastChip").on("click", function() {
            $("input[name=c]").val($(this).data("chip"));
            $("#submit").click();
        });
    });

    var sock = new WebSocket('<?= $this->WS_SERV ?>');
    sock.onopen = function(data) {
        connect_stat = true;
        $("#server_status").addClass("connected").text("Server \u2714");
        schedulePoll();
    };
    sock.onmessage = function(event) {
        content();
        schedulePoll();
    };
    sock.onclose = function(event) {
        connect_stat = false;
        clearTimeout(pollTimeout);
        setInterval(function() { content(); }, 3000);
        $("#server_status").removeClass("connected").text("Server \u2718");
    };

    function playAudio() {
        document.getElementById("myAudio").play();
    }

    function content() {
        var oldChip = parseInt($(".chip-box.me .value").text().replace(/,/g, '')) || 0;
        $("#content").load('<?= $this->BASE_URL ?><?= $data['page'] ?>/content', function() {
            var newChip = parseInt($(".chip-box.me .value").text().replace(/,/g, '')) || 0;
            if (oldChip > 0 && newChip > oldChip) playAudio();
        });
        mutasi();
    }

    function mutasi() {
        $("#mutasi").load("<?= $this->BASE_URL ?>Room/cek");
    }

    $("#transferForm").on("submit", function(e) {
        e.preventDefault();
        var val = $("input[name=c]").val();
        if (val == "") return;
        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            type: $(this).attr("method"),
            success: function(res) {
                if (res == 0) {
                    $("input[name=c]").val("");
                    closeOffcanvas();
                    content();
                    if (connect_stat === true) sock.send(JSON.stringify({ text: 0 }));
                }
            }
        });
    });
</script>