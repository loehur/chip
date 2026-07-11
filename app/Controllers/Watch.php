<?php

class Watch extends Controller
{
    public $page = __CLASS__;

    public function index()
    {
        $this->view($this->page . "/index", ["page" => $this->page]);
    }

    public function content()
    {
        $users = $this->model("M_DB_1")->get("user");
        $data = ['players' => [], 'total' => 0, 'low_count' => 0];

        foreach ($users as $u) {
            $chip = $this->saldo($u['user']);
            $data['players'][] = [
                'user' => $u['user'],
                'chip' => $chip,
            ];
            $data['total'] += $chip;
            if ($chip <= 300) {
                $data['low_count']++;
            }
        }

        usort($data['players'], function ($a, $b) {
            return $b['chip'] - $a['chip'];
        });

        $this->view($this->page . "/content", $data);
    }

    public function history()
    {
        $data['mutasi'] = $this->model("M_DB_1")->get_order("mutasi", "id DESC LIMIT 60");
        $this->view($this->page . "/history", $data);
    }

    private function saldo($user)
    {
        $where = "user = '" . $user . "'";
        $awal = $this->model("M_DB_1")->get_cols_where("user", "chip", $where, 0)['chip'];

        $cols = "SUM(chip) AS chip";
        $where = "f = '" . $user . "' GROUP BY f";
        $m = $this->model("M_DB_1")->get_cols_where("mutasi", $cols, $where, 0);
        $mutasi = isset($m['chip']) ? $m['chip'] : 0;

        $cols = "SUM(chip) AS chip";
        $where = "t = '" . $user . "' GROUP BY t";
        $m = $this->model("M_DB_1")->get_cols_where("mutasi", $cols, $where, 0);
        if (isset($m['chip'])) {
            $mutasi -= $m['chip'];
        }

        return ($awal - $mutasi);
    }
}
