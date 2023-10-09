<!-- Main page content-->
<div class="row mx-2 mt-2">
    <div class="col">
        <table class="w-100">
            <?php
            $c = $data['chip'];
            $s = "";
            $w = "";
            foreach ($data['mutasi'] as $d) {
                if ($d['t'] == $_SESSION['user']) {
                    $s = "+";
                    $w = "success";
                    $b = $c - $d['chip'];
                } else {
                    $s = "-";
                    $w = "danger";
                    $b = $c + $d['chip'];
                }
            ?>
                <tr class="border-bottom">
                    <td><small class="text-secondary"><?= $d['insertTime'] ?></small><br><?= ucwords($d['f']) ?> to <?= ucwords($d['t']) ?></td>
                    <td class="text-end"><span class="text-<?= $w ?>"><b><?= $s ?><?= number_format($d['chip']) ?></b></span><br><small><?= number_format($b) ?> to </small><?= number_format($c) ?></td>
                </tr>
            <?php
                if ($d['t'] == $_SESSION['user']) {
                    $c -= $d['chip'];
                } else {
                    $c += $d['chip'];
                }
            }
            ?>
        </table>
    </div>
</div>