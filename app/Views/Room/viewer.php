<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Chip</title>
    <link rel="stylesheet" href="<?= $this->ASSETS_URL ?>plugins/bootstrap-5.1/bootstrap.min.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="<?= $this->ASSETS_URL ?>assets/img/favicon.png" />

    <style>
        html {
            height: 100%;
        }

        body {
            min-height: 100%;
            max-width: 600px;
            margin: auto;
        }

        .modal-backdrop {
            opacity: 0.1 !important;
        }
    </style>
</head>

<div id="content"></div>
<div id="mutasi"></div>

<!-- Modal -->
<div class="modal" id="exampleModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= $this->BASE_URL ?>Room/transfer" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Transfer Chip to<br><b class="text-dark" id="target"></b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input name="c" type="number" style="height: 100px;font-size:50px" class="form-control text-center">
                    <input name="t" type="hidden">
                    <div class="row mt-3">
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
                            <div class="col">
                                <span class="btn btn-lg btn-outline-secondary w-100 fastChip"><?= $fa['chip'] ?></span>
                            </div>
                        <?php }
                        ?>
                    </div>
                    <button type="submit" class="mt-3 py-4 btn btn-lg btn-outline-dark w-100" data-bs-dismiss="modal">Transfer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= $this->ASSETS_URL ?>js/jquery-3.7.0.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap-5.1/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        content();
    });

    function content() {
        $("div#content").load('<?= $this->BASE_URL ?><?= $data['page'] ?>/content');
        setTimeout(mutasi, 1000);
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
                }
            }
        });
    });

    $(".fastChip").click(function() {
        $("input[name=c]").val($(this).html());
    })

    const interval = setInterval(function() {
        content();
    }, 3000);
</script>