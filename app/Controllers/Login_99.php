<?php
class Login_99 extends Controller
{
   public function index($hp = "NULL")
   {
      if ($hp == "") {
         $hp = "NULL";
      }
      if (isset($_SESSION['pre_log'])) {
         if ($_SESSION['pre_log'] == true && isset($hp)) {
            if (isset($_SESSION['login_orins'])) {
               if ($_SESSION['login_orins'] == TRUE) {
                  header('Location: ' . $this->BASE_URL . "Home");
               } else {
                  $this->view('Login/login', ['user' => $hp]);
               }
            } else {
               $this->view('Login/login', ['user' => $hp]);
            }
         } else {
            $this->view('Pre_login/login');
         }
      } else {
         $this->view('Pre_login/login');
      }
   }

   public function cek_login()
   {
      $hp = $_POST["HP"];
      $c = $_POST['c_'];
      if ($c <> $_SESSION['captcha']) {
         $this->model('Log')->write($hp . " Login Failed, Invalid Captcha");
         $this->view('Login/login', ['user' => $hp, "failed" => "INVALID CAPTCHA"]);
         exit();
      }

      if (strlen($this->db_pass) == 0) {
         $_SESSION['secure']['db_pass'] = "";
      } else {
         $_SESSION['secure']['db_pass'] = $this->model("Enc")->dec_2($this->db_pass);
      }

      if (isset($_SESSION['login_orins'])) {
         if ($_SESSION['login_orins'] == TRUE) {
            header('Location: ' . $this->BASE_URL . "Home");
         }
      }

      $pass = $this->model('Enc')->enc($_POST["PASS"]);
      if (strlen($hp) < 5 || strlen($pass) < 6) {
         $this->model('Log')->write($hp . " Login Failed, Validate");
         $this->view('Login/login',  ['user' => $hp, "failed" => 'Authentication Error']);
         exit();
      }

      $where = "user = '" . $hp . "' AND password = '" . $pass . "'";
      $userData = $this->model('M_DB_1')->get_where_row('user', $where);

      if (empty($userData)) {
         $this->view('Login/login',  ['user' => $hp, "failed" => 'Authentication Error']);
         $this->model('Log')->write($hp . " Login Failed, Auth");
         exit();
      } else {
         $this->model('Log')->write($hp . " Login Success");
         $this->set_login($userData);
      }
   }


   function set_login($userData = [])
   {
      //LOGIN
      $where = "id_user = " . $userData['id_user'];
      $userData = $this->model('M_DB_1')->get_where_row('user', $where);

      $_SESSION['login_orins'] = TRUE;
      $_SESSION['user_data'] = $userData;
      $this->userData = $_SESSION['user_data'];
      $this->dataSynchrone();

      $this->index($userData['user']);
   }

   public function logout()
   {
      if (isset($_SESSION['user_data']['user'])) {
         if (strlen($_SESSION['user_data']['user']) > 0) {
            $this->model('Log')->write($_SESSION['user_data']['user'] . " LOGOUT");
         } else {
            $this->model('Log')->write("FORCE LOGOUT");
         }
      } else {
         $this->model('Log')->write("FORCE LOGOUT");
      }
      session_unset();
      session_destroy();
      header('Location: ' . $this->BASE_URL . "Home");
   }
}
