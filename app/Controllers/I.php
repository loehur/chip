<?php

class I extends Controller
{
   public function __construct()
   {
      $_SESSION['secure']['encryption'] = "j499uL0v3ly&N3lyL0vEly_F0r3ver";
      if (strlen($this->db_pass) == 0) {
         $_SESSION['secure']['db_pass'] = "";
      } else {
         $_SESSION['secure']['db_pass'] = $this->model("Enc")->dec_2($this->db_pass);
      }
   }

   public function create($user, $chip)
   {
      $cols = "user, chip";
      $vals = "'" . $user . "'," . $chip;
      $ex = $this->model("M_DB_1")->insertCols("user", $cols, $vals);
      echo "<pre>";
      print_r($ex);
      echo "</pre>";
   }

   public function delete($user)
   {
      $where = "user = '" . $user . "'";
      $ex = $this->model("M_DB_1")->delete_where("user", $where);
      echo "<pre>";
      print_r($ex);
      echo "</pre>";
   }

   public function reset()
   {
      $ex = $this->model("M_DB_1")->delete("user");
      $ex2 = $this->model("M_DB_1")->delete("mutasi");
      echo "<pre>";
      print_r($ex);
      echo "</pre>";
      echo "<pre>";
      print_r($ex2);
      echo "</pre>";
   }


   public function list()
   {
      $ex = $this->model("M_DB_1")->get("user");
      echo "<pre>";
      print_r($ex);
      echo "</pre>";
   }

   public function info()
   {
      $info = [
         "create" => "nama, chip",
         "delete" => "nama",
         "list" => "-"
      ];
      echo "<pre>";
      print_r($info);
      echo "</pre>";
   }
}
