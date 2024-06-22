<!-- Main page content-->
<div class="row mt-1 mx-0">
    <div class="col rounded border bg-white py-2">
        <table class="table table-sm mb-0 mx-0">
            <?php
            $c = $data['chip'];
            $s = "";
            $w = "";
            foreach ($data['mutasi'] as $d) {
                if (strtoupper($d['t']) == strtoupper($_SESSION['user'])) {
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
                    <td><?= ucwords($d['f']) ?> <span class="text-primary fw-bold">&#10151;</span> <?= ucwords($d['t']) ?><br><small class="text-secondary"><?= $d['insertTime'] ?></small></td>
                    <td class="text-end"><span class="text-<?= $w ?>"><b><?= $s ?><?= number_format($d['chip']) ?></b></span><br><small class="text-secondary"><?= number_format($b) ?> &#10151; <?= number_format($c) ?></small></td>
                </tr>
            <?php
                if (strtoupper($d['t']) == strtoupper($_SESSION['user'])) {
                    $c -= $d['chip'];
                } else {
                    $c += $d['chip'];
                }
            }
            ?>
        </table>
    </div>
</div>