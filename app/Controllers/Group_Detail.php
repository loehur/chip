<?php

class Group_Detail extends Controller
{
   public $page = __CLASS__;

   public function __construct()
   {
      $this->session_cek();

      $this->data();

      if ($this->userData['user_tipe'] > 1) {
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
         "title" => "Set Produksi - Group Detail"
      ]);

      $this->viewer();
   }

   public function viewer()
   {
      $this->view($this->v_viewer, ["page" => $this->page]);
   }

   public function content()
   {

      $where = "id_toko = " . $this->userData['id_toko'] . " ORDER BY detail_group ASC";
      $data = $this->model('M_DB_1')->get_where('detail_group', $where);

      foreach ($data as $key => $d) {
         $where = "id_detail_group = " . $d['id_detail_group'] . " ORDER BY detail_item ASC";
         $data_item = $this->model('M_DB_1')->get_where('detail_item', $where);
         $data[$key]['item'] = $data_item;
      }

      $this->view($this->v_content, $data);
   }

   function add($link = 0)
   {
      $group = $_POST['group'];
      $cols = 'id_toko, id_detail_group, detail_group';

      if ($link == 0) {
         $whereCountIndex = "id_toko = " . $this->userData['id_toko'];
         $dataCount = $this->model('M_DB_1')->count_where('detail_group', $whereCountIndex);
         $id_detail_group = $dataCount + 1;
      } else {
         $id_detail_group = $_POST['id_detail_group'];
      }

      $vals = $this->userData['id_toko'] . "," . $id_detail_group . ",'" . $group . "'";

      $whereCount = "id_toko = '" . $this->userData['id_toko'] . "' AND detail_group = '" . $group . "'";
      $dataCount = $this->model('M_DB_1')->count_where('detail_group', $whereCount);
      if ($dataCount <> 1) {
         $do = $this->model('M_DB_1')->insertCols('detail_group', $cols, $vals);
         if ($do['errno'] == 0) {
            $this->model('Log')->write($this->userData['user'] . " Add Detail Group Success!");
            echo $do['errno'];
         } else {
            print_r($do['error']);
         }
      } else {
         $this->model('Log')->write($this->userData['user'] . " Add Detail Group Failed, Double Forbidden!");
         echo "Double Entry!";
      }
   }

   function add_item($id_detail_group)
   {
      $item_post = $_POST['item'];
      $varian = $_POST['varian'];
      $cols = 'id_toko, id_detail_group, detail_item';

      if (strlen($varian) > 0) {
         $varian = explode(",", $varian);
         foreach ($varian as $v) {
            $item = $item_post . "-" . $v;
            $vals = "'" . $this->userData['id_toko'] . "','" . $id_detail_group . "','" . $item . "'";
            $whereCount = "id_toko = '" . $this->userData['id_toko'] . "' AND id_detail_group = '" . $id_detail_group . "' AND detail_item = '" . $item . "'";
            $dataCount = $this->model('M_DB_1')->count_where('detail_item', $whereCount);
            if ($dataCount == 0) {
               $do = $this->model('M_DB_1')->insertCols('detail_item', $cols, $vals);
               if ($do['errno'] == 0) {
                  $this->model('Log')->write($this->userData['user'] . " Add Detail Item Success!");
                  echo $do['errno'];
               } else {
                  print_r($do['error']);
               }
            } else {
               $this->model('Log')->write($this->userData['user'] . " Add Detail Item Failed, Double Forbidden!");
               echo "Double Entry!";
            }
         }
      } else {
         $item = $item_post;
         $vals = "'" . $this->userData['id_toko'] . "','" . $id_detail_group . "','" . $item . "'";
         $whereCount = "id_toko = '" . $this->userData['id_toko'] . "' AND id_detail_group = '" . $id_detail_group . "' AND detail_item = '" . $item . "'";
         $dataCount = $this->model('M_DB_1')->count_where('detail_item', $whereCount);
         if ($dataCount == 0) {
            $do = $this->model('M_DB_1')->insertCols('detail_item', $cols, $vals);
            if ($do['errno'] == 0) {
               $this->model('Log')->write($this->userData['user'] . " Add Detail Item Success!");
               echo $do['errno'];
            } else {
               print_r($do['error']);
            }
         } else {
            $this->model('Log')->write($this->userData['user'] . " Add Detail Item Failed, Double Forbidden!");
            echo "Double Entry!";
         }
      }
   }

   function add_item_multi($id_detail_group)
   {
      $item_post = $_POST['item'];
      $cols = 'id_toko, id_detail_group, detail_item';

      if (strlen($item_post) > 0) {
         $item = explode(",", $item_post);
         foreach ($item as $i) {
            $vals = "'" . $this->userData['id_toko'] . "','" . $id_detail_group . "','" . $i . "'";
            $whereCount = "id_toko = '" . $this->userData['id_toko'] . "' AND id_detail_group = '" . $id_detail_group . "' AND detail_item = '" . $i . "'";
            $dataCount = $this->model('M_DB_1')->count_where('detail_item', $whereCount);
            if ($dataCount == 0) {
               $do = $this->model('M_DB_1')->insertCols('detail_item', $cols, $vals);
               if ($do['errno'] == 0) {
                  $this->model('Log')->write($this->userData['user'] . " Add Detail Item Success!");
                  echo $do['errno'];
               } else {
                  print_r($do['error']);
               }
            } else {
               $this->model('Log')->write($this->userData['user'] . " Add Detail Item Failed, Double Forbidden!");
               echo "Double Entry!";
            }
         }
      } else {
         $item = $item_post;
         $vals = "'" . $this->userData['id_toko'] . "','" . $id_detail_group . "','" . $item . "'";
         $whereCount = "id_toko = '" . $this->userData['id_toko'] . "' AND id_detail_group = '" . $id_detail_group . "' AND detail_item = '" . $item . "'";
         $dataCount = $this->model('M_DB_1')->count_where('detail_item', $whereCount);
         if ($dataCount == 0) {
            $do = $this->model('M_DB_1')->insertCols('detail_item', $cols, $vals);
            if ($do['errno'] == 0) {
               $this->model('Log')->write($this->userData['user'] . " Add Detail Item Success!");
               echo $do['errno'];
            } else {
               print_r($do['error']);
            }
         } else {
            $this->model('Log')->write($this->userData['user'] . " Add Detail Item Failed, Double Forbidden!");
            echo "Double Entry!";
         }
      }
   }
}
