<!-- Main page content-->

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
            max-width: 500px;
            margin: auto;
            font-family: "Times New Roman", Times, serif;
        }
    </style>
</head>
<div class="row p-2 mt-4 mx-auto" style="max-width: 500px;">
    <div class="col">
        <div class="mb-3">
            <label class="form-label text-primary"><b>Chip Username</b></label>
            <input type="text" style="height: 100px;font-size:50px" class="form-control text-center" id="user">
        </div>
        <button type="submit" class="btn btn-lg btn-outline-primary w-100 login">Login</button>
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

    var myOffcanvas = document.getElementById('offkanvas')
    myOffcanvas.addEventListener('show.bs.offcanvas',
        function() {
            console.log('show')
        })
</script>