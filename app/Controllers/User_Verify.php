<?php

class User_Verify extends Controller
{
   public $page = __CLASS__;

   public function __construct()
   {
      $this->session_cek();
      $this->data();
      $this->v_load = $this->page . "/load";
      $this->v_content = $this->page . "/content";
      $this->v_viewer = $this->page . "/viewer";
   }

   public function index()
   {
      $this->view("Layouts/layout_main", [
         "content" => $this->v_content,
         "title" => "Admin - User Verify"
      ]);

      $this->viewer();
   }

   public function viewer()
   {
      $this->view($this->v_viewer, ["page" => $this->page]);
   }

   public function content()
   {
      $data['_c'] = __CLASS__;
      $data['user'] = $this->model("M_DB_1")->get_where("user", "v_profil = 1");
      $this->view($this->v_content, $data);
   }

   function cek($id)
   {
      $data = $this->model("M_DB_1")->get_where("user", "user = '" . $id . "'");
      $this->view($this->page . "/cek", $data);
   }

   public function reject()
   {
      $id = $_POST['user_reject'];
      $alasan = $_POST['alasan'];
      $set = "v_profil = 3, v_note_profil = '" . $alasan . "'";
      $where = "user = '" . $id . "'";
      $update = $this->model('M_DB_1')->update("user", $set, $where);
      echo $update['errno'];
      $this->dataSynchrone();
   }

   public function verify()
   {
      $user = $_POST['user'];
      $set = "v_profil = 2, v_note_profil = 'VERIFIED'";
      $where = "user = '" . $user . "'";
      $update = $this->model('M_DB_1')->update("user", $set, $where);
      echo $update['errno'];
      $this->dataSynchrone();
   }
}
