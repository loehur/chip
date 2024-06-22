<?php

class I extends Controller
{

   function tes()
   {
      echo "jalan";
   }

   public function create($user, $chip)
   {
      $player = explode(",", $user);

      foreach ($player as $p) {
         if (strlen($p) > 1) {
            $cols = "user, chip";
            $vals = "'" . $p . "'," . $chip;
            $ex = $this->model("M_DB_1")->insertCols("user", $cols, $vals);
            echo "<pre>";
            print_r($ex);
            echo "</pre>";
         }
      }
   }

   public function delete($user)
   {
      $where = "user = '" . $user . "'";
      $ex = $this->model("M_DB_1")->delete_where("user", $where);
      echo "<pre>";
      print_r($ex);
      echo "</pre>";
   }

   public function reset_coin()
   {
      $ex2 = $this->model("M_DB_1")->delete("mutasi");
      echo "<pre>";
      print_r($ex2);
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
         "reset" => "",
         "reset_coin" => "",
         "list" => ""
      ];
      echo "<pre>";
      print_r($info);
      echo "</pre>";
   }
}
