<?php

class Room extends Controller
{
   public $page = __CLASS__;

   public function __construct()
   {
      $this->v_content = $this->page . "/content";
      $this->v_viewer = $this->page . "/viewer";
   }

   public function index()
   {
      $data = $_GET['msg'] ?? "";
      $this->view("Login/login", $data);
   }

   public function i($user = "")
   {
      if (strlen($user) == 0) {
         header("Location: " . $this->BASE_URL . "?msg=Invalid User");
      }

      $cek = $this->model("M_DB_1")->count_where("user", "user = '" . $user . "'");
      if ($cek > 0) {
         $_SESSION['user'] = strtolower($user);
         $this->viewer();
      } else {
         header("Location: " . $this->BASE_URL . "?msg=Invalid Username");
      }
   }

   public function content()
   {
      $data = [];
      $cek = $this->model("M_DB_1")->count_where("user", "user = '" . $_SESSION['user'] . "'");
      if ($cek <> 0) {
         $data['chip'] = $this->saldo();
         $data['friend'] = $this->model("M_DB_1")->get_where("user", "user <> '" . $_SESSION['user'] . "'");
         foreach ($data['friend'] as $k => $df) {
            $data['friend'][$k]['chip'] = $this->saldo_f($df['user']);
         }
      }
      $this->view($this->v_content, $data);
   }

   public function viewer()
   {
      $this->view($this->v_viewer, ["page" => $this->page]);
   }

   public function saldo()
   {
      if (strlen($_SESSION['user']) == 0) {
         exit();
      }
      $where = "user = '" . $_SESSION['user'] . "'";

      $cek =  $this->model("M_DB_1")->count_where("user", $where, 0);

      if ($cek == 0) {
         exit();
      }

      $awal =  $this->model("M_DB_1")->get_cols_where("user", "chip", $where, 0)['chip'];
      $cols = "SUM(chip) AS chip";
      $where = "f = '" . $_SESSION['user'] . "' GROUP BY f";
      $m =  $this->model("M_DB_1")->get_cols_where("mutasi", $cols, $where, 0);
      if (isset($m['chip'])) {
         $mutasi = $m['chip'];
      } else {
         $mutasi = 0;
      }

      $cols = "SUM(chip) AS chip";
      $where = "t = '" . $_SESSION['user'] . "' GROUP BY t";
      $m =  $this->model("M_DB_1")->get_cols_where("mutasi", $cols, $where, 0);
      if (isset($m['chip'])) {
         $mutasi -= $m['chip'];
      }

      return ($awal - $mutasi);
   }

   public function saldo_f($user)
   {
      $where = "user = '" . $user . "'";
      $awal =  $this->model("M_DB_1")->get_cols_where("user", "chip", $where, 0)['chip'];

      $cols = "SUM(chip) AS chip";
      $where = "f = '" . $user . "' GROUP BY f";
      $m =  $this->model("M_DB_1")->get_cols_where("mutasi", $cols, $where, 0);
      if (isset($m['chip'])) {
         $mutasi = $m['chip'];
      } else {
         $mutasi = 0;
      }

      $cols = "SUM(chip) AS chip";
      $where = "t = '" .  $user . "' GROUP BY t";
      $m =  $this->model("M_DB_1")->get_cols_where("mutasi", $cols, $where, 0);
      if (isset($m['chip'])) {
         $mutasi -= $m['chip'];
      }

      return ($awal - $mutasi);
   }

   public function transfer()
   {
      $c = $_POST['c'];
      $t = $_POST['t'];
      $f = $_SESSION['user'];
      $cols = "f, t, chip";
      $vals = "'" . $f . "','" . $t . "'," . $c;
      $ex = $this->model("M_DB_1")->insertCols("mutasi", $cols, $vals);
      echo $ex['errno'];
   }

   function cek()
   {
      $data['chip'] = $this->saldo();
      $limit = ($this->model("M_DB_1")->count("user") - 1) * 2;
      $data['mutasi'] = $this->model("M_DB_1")->get_where("mutasi", "f = '" . $_SESSION['user'] . "' OR T = '" . $_SESSION['user'] . "' ORDER by id DESC LIMIT " . $limit);
      $this->view("Room/cek", $data);
   }
}
