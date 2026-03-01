<!-- Main page content-->
<div style="margin-top: 0;">
    <div style="background: #111113; border: 1px solid rgba(255,255,255,0.06); border-radius: 12px; padding: 0.75rem; overflow: hidden;">
        <table style="width: 100%; color: #fafafa; border-collapse: separate; border-spacing: 0 1rem; font-size: 0.875rem;">
            <?php
            $c = $data['chip'];
            $s = "";
            $w = "";
            foreach ($data['mutasi'] as $d) {
                if (strtoupper($d['t']) == strtoupper($_SESSION['user'])) {
                    $s = "+";
                    $w = "#22c55e";
                    $b = $c - $d['chip'];
                } else {
                    $s = "-";
                    $w = "#dc2626";
                    $b = $c + $d['chip'];
                }
            ?>
                <tr style="border-bottom: 1px solid rgba(255,255,255,0.06);">
                    <td style="padding: 0.6rem 0.75rem;">
                        <?= ucwords($d['f']) ?> <span style="color: #3b82f6; font-weight: 600;">&#10151;</span> <?= ucwords($d['t']) ?><br>
                        <small style="color: #71717a; font-size: 0.75rem;"><?= $d['insertTime'] ?></small>
                    </td>
                    <td style="padding: 0.6rem 0.75rem; text-align: right;">
                        <span style="color: <?= $w ?>; font-weight: 600;"><b><?= $s ?><?= number_format($d['chip']) ?></b></span><br>
                        <small style="color: #71717a; font-size: 0.75rem;"><?= number_format($b) ?> &#10151; <?= number_format($c) ?></small>
                    </td>
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