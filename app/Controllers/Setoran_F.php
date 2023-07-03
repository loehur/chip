<?php

class Setoran_F extends Controller
{
   public $page = __CLASS__;

   public function __construct()
   {
      $this->session_cek();
      $this->data();
      if (!in_array($this->userData['user_tipe'], $this->pFinance)) {
         $this->model('Log')->write($this->userData['user'] . " Force Logout. Hacker!");
         $this->logout();
      }

      $this->v_content = $this->page . "/content";
      $this->v_viewer = $this->page . "/viewer";
   }

   public function index()
   {

      $this->view("Layouts/layout_main", [
         "content" => $this->v_content,
         "title" => "Finance - Setoran"
      ]);
      $this->viewer();
   }

   public function viewer($parse = "")
   {
      $this->view($this->v_viewer, ["page" => $this->page, "parse" => $parse]);
   }

   public function content($parse = "")
   {
      $cols = "ref_setoran, sum(jumlah) as jumlah, count(jumlah) as count";
      $where = "metode_mutasi = 1 AND id_client <> 0 AND ref_setoran <> '' AND status_setoran = 0 GROUP BY ref_setoran, status_setoran";
      $data['setor'] = $this->model('M_DB_1')->get_cols_where('kas', $cols, $where, 1);

      $cols = "ref_setoran, status_setoran, sum(jumlah) as jumlah, count(jumlah) as count";
      $where = "metode_mutasi = 1 AND id_client <> 0 AND ref_setoran <> '' AND status_setoran <> 0 GROUP BY ref_setoran, status_setoran LIMIT 20";
      $data['setor_done'] = $this->model('M_DB_1')->get_cols_where('kas', $cols, $where, 1);

      $this->view($this->v_content, $data);
   }

   function setor()
   {
      $ref = $_POST['ref'];
      $set = "status_setoran = 1, id_finance_setoran = " . $this->userData['id_user'];
      $where = "ref_setoran = '" . $ref . "'";
      $update = $this->model('M_DB_1')->update("kas", $set, $where);
      echo $update['errno'];
   }
}
