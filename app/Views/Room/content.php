<!-- Main page content-->
<?php if (count($data) <> 0) { ?>
    <div class="row mt-3 mx-2 py-3 cek">
        <div class="col">
            <div class="row">
                <div class="col text-center">
                    <h2>
                        <b><?= ucwords($_SESSION['user']) ?></b><br>
                        <div class="text-success"><b><?= number_format($data['chip']) ?></b></div>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <?php foreach ($data['friend'] as $df) { ?>
        <div style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#exampleModal" class="row mx-3 my-2 mt-0 py-2 border rounded bayar bg-light" data-user="<?= $df['user'] ?>">
            <div class="col text-center">
                <h3>
                    <b><?= ucwords($df['user']) ?></b><br>
                    <div class="text-primary"><b><?= number_format($df['chip']) ?></b></div>
                </h3>
            </div>
        </div>
    <?php } ?>
<?php } else { ?>
    <div class="row p-5 m-auto" style="max-width: 600px;">
        <div class="col text-center">
            <h3>User not Found</h3>
        </div>
    </div>
<?php } ?>

<script>
    $(".bayar").on("click", function(e) {
        var t = $(this).attr('data-user');
        $("input[name=c]").focus();
        $("input[name=t]").val(t);
        $("b#target").html(t.toUpperCase());
    });
</script>