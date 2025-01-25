<!-- Main page content-->

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Chip</title>
    <link rel="stylesheet" href="<?= $this->ASSETS_URL ?>plugins/bootstrap-5.1/bootstrap.min.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="<?= $this->ASSETS_URL ?>img/favicon.png" />

    <style>
        html {
            height: 100%;
        }

        body {
            max-width: 500px;
            margin: auto;
        }
    </style>
</head>
<div class="row mx-0 mt-3 mb-0">
    <div class="col px-3">
        <?php if (strlen($data) > 0) { ?>
            <div class="alert alert-danger text-center mb-0"><?= $data ?></div>
        <?php } ?>
    </div>
</div>
<div class="row mx-0 p-2 mb-2 mx-auto" style="max-width: 500px;">
    <div class="col">
        <div class="mb-3">
            <label class="form-label text-primary"><b>Chip Username</b></label>
            <input type="text" style="height: 100px;font-size:50px" class="form-control text-center rounded-3 shadow-none" id="user">
        </div>
        <button type="submit" class="btn btn-lg rounded-3 btn-primary bg-gradient w-100 login">Login</button>
    </div>
</div>
<div class="row mx-0 pb-5">
    <div class="col px-3">
        <div class="bg-warning bg-opacity-10 rounded p-3">
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
</div>

<script src="<?= $this->ASSETS_URL ?>js/jquery-3.7.0.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap-5.1/bootstrap.bundle.min.js"></script>

<script>
    $(".login").on("click", function(e) {
        var user = $("input#user").val();
        window.location.href = "<?= $this->BASE_URL ?>Room/i/" + user;
    });

    $('input#user').keypress(function(event) {
        if (event.keyCode == 13) {
            var user = $(this).val();
            window.location.href = "<?= $this->BASE_URL ?>Room/i/" + user;
        }
    });
</script>