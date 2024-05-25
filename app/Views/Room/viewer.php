<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Chip</title>
    <link rel="stylesheet" href="<?= $this->ASSETS_URL ?>plugins/bootstrap-5.1/bootstrap.min.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="<?= $this->ASSETS_URL ?>assets/img/favicon.png" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <style>
        html {
            height: 100%;
        }

        body {
            max-width: 500px;
            margin: auto;
            font-family: "Poppins", sans-serif;
        }

        .modal-backdrop {
            opacity: 0.1 !important;
        }

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</head>

<body class="bg-light">
    <audio id="myAudio">
        <source src="<?= $this->ASSETS_URL ?>audio/coinout.mp3" type="audio/mpeg">
    </audio>

    <div class="row mt-3">
        <div class="col text-end pe-4">
            Server <span id="server_status" class="text-danger">&#8718;</span>
        </div>
    </div>
    <div id="content" class=""></div>
    <div id="mutasi" class="px-1"></div>

    <!-- Modal -->
    <div class="offcanvas offcanvas-bottom m-auto rounded-3 bg-light" tabindex="-1000" id="offcanvasBottom" style="height: 450px;max-width:500px">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Transfer Chip to<br><b class="text-danger" id="target"></b></h5>
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

    var sock = new WebSocket(<?= $this->WS_SERV ?>);

    sock.onopen = function(data) {
        connect_stat = true;
        clearInterval(auto_load);
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

    $(document).ready(function() {
        content();
    });

    function auto_load() {
        content();
    };
    setInterval(auto_load, 3000);

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