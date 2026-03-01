<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Chip</title>
    <link rel="stylesheet" href="<?= $this->ASSETS_URL ?>plugins/bootstrap-5.1/bootstrap.min.css" rel="stylesheet" />
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
        html { height: 100%; }
        body {
            max-width: 500px;
            margin: auto;
            font-family: 'DM Sans', -apple-system, sans-serif;
            background: var(--chip-bg) !important;
            color: var(--chip-text) !important;
            -webkit-font-smoothing: antialiased;
        }
        .modal-backdrop { opacity: 0.4 !important; background: #000 !important; }
        .offcanvas { background: var(--chip-card) !important; border: 1px solid var(--chip-border) !important; }
        .offcanvas-header { border-bottom: 1px solid var(--chip-border) !important; }
        .offcanvas-title { color: var(--chip-text) !important; }
        .btn-close { filter: invert(1); opacity: 0.6; }
        .form-control {
            background: var(--chip-input) !important;
            border: 1px solid var(--chip-border) !important;
            color: var(--chip-text) !important;
        }
        .form-control:focus { border-color: rgba(255,255,255,0.15) !important; box-shadow: none !important; }
        .btn-danger { background: var(--chip-danger) !important; border-color: var(--chip-danger) !important; }
        .btn-danger:hover { opacity: 0.9; }
        .border { border-color: var(--chip-border) !important; }
        .bg-white { background: var(--chip-input) !important; }
        .fastChip { color: var(--chip-text) !important; }
        input::-webkit-outer-spin-button, input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
        #server_status.text-success { color: var(--chip-success) !important; }
    </style>
</head>

<body class="mx-2">
    <audio id="myAudio">
        <source src="<?= $this->ASSETS_URL ?>audio/coinout.mp3" type="audio/mpeg">
    </audio>

    <div class="row mx-0 mt-3">
        <div class="col text-end" style="color: var(--chip-muted); font-size: 0.8125rem;">
            Server <span id="server_status" style="color: var(--chip-danger);">&#8718;</span>
        </div>
    </div>
    <div id="content" class=""></div>
    <div id="mutasi" class="px-1"></div>

    <!-- Modal -->
    <div class="offcanvas offcanvas-bottom m-auto rounded-3" tabindex="-1000" id="offcanvasBottom" style="height: 450px;max-width:500px">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Transfer Chip to<br><b id="target" style="color: var(--chip-danger);"></b></h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <form action="<?= $this->BASE_URL ?>Room/transfer" method="POST">
                <div class="row mt-2 mx-1">
                    <div class="col px-1">
                        <input name="c" type="number" style="height: 100px;font-size:50px;" class="form-control text-center shadow-none">
                        <input name="t" type="hidden">
                    </div>
                </div>
                <div class="row mt-2 mx-1">
                    <?php $fast = $this->model("M_DB_1")->get_order("mutasi", "id DESC LIMIT 10");
                    $no = 0;
                    $val = [];
                    foreach ($fast as $fa) {
                        if ($no >= 2) {
                            break;
                        }
                        if (!isset($val[$fa['chip']])) {
                            $val[$fa['chip']] = true;
                            $no += 1;
                        } else {
                            continue;
                        }
                    ?>
                        <div class="col px-1">
                            <h1><span class="btn btn-lg border bg-white shadow-none w-100 fw-bold fastChip py-3" data-bs-dismiss="offcanvas"><?= $fa['chip'] ?></span></h1>
                        </div>
                    <?php }
                    ?>
                </div>
                <div class="row mt-2 mx-1">
                    <div class="col px-1">
                        <button type="submit" id="submit" data-bs-dismiss="offcanvas" onclick="playAudio()" class="mt-1 py-4 btn btn-lg btn-danger bg-gradient shadow-sm w-100" data-bs-dismiss="modal">Transfer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

<script src="<?= $this->ASSETS_URL ?>js/jquery-3.7.0.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap-5.1/bootstrap.bundle.min.js"></script>

<script>
    var connect_stat = false;
    $(document).ready(function() {
        content();
    });

    var sock = new WebSocket('<?= $this->WS_SERV ?>');

    sock.onopen = function(data) {
        connect_stat = true;
        $("#server_status").removeClass("text-danger");
        $("#server_status").addClass("text-success");
        console.log(data);
    };

    sock.onmessage = function(event) {
        content();
    };

    sock.onclose = function(event) {
        connect_stat = false;
        setInterval(auto_load, 3000);
        $("#server_status").removeClass("text-success");
        $("#server_status").addClass("text-danger");
    };


    function playAudio() {
        var x = document.getElementById("myAudio");
        x.play();
    }

    function content() {
        $("div#content").load('<?= $this->BASE_URL ?><?= $data['page'] ?>/content');
        mutasi();
    }

    function mutasi() {
        $("#mutasi").load("<?= $this->BASE_URL ?>Room/cek");
    }

    $("form").on("submit", function(e) {
        e.preventDefault();
        var val = $("input[name=c]").val();
        if (val == "") {

            return;
        }
        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            type: $(this).attr("method"),
            success: function(res) {
                if (res == 0) {
                    $("input").val("");
                    content();
                    var obj = {
                        text: 0
                    };
                    if (connect_stat === true) {
                        sock.send(JSON.stringify(obj));
                    }
                }
            }
        });
    });

    $(".fastChip").click(function() {
        $("input[name=c]").val($(this).html());
        $("button#submit").click();
    })
</script>