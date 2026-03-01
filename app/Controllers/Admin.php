<?php

class Admin extends Controller
{
    private const ADMIN_PASSWORD = '123654';

    private function requireAuth()
    {
        if (empty($_SESSION['admin_auth'])) {
            header("Location: " . $this->BASE_URL . "Admin?msg=Silakan masukkan password");
            exit;
        }
    }

    public function index()
    {
        $msg = $_GET['msg'] ?? '';
        if (!empty($_SESSION['admin_auth'])) {
            header("Location: " . $this->BASE_URL . "Admin/menu");
            exit;
        }
        if (isset($_POST['password'])) {
            if ($_POST['password'] === self::ADMIN_PASSWORD) {
                $_SESSION['admin_auth'] = true;
                header("Location: " . $this->BASE_URL . "Admin/menu");
                exit;
            }
            $msg = 'Password salah';
        }
        $this->view("Admin/login", $msg);
    }

    public function logout()
    {
        unset($_SESSION['admin_auth']);
        header("Location: " . $this->BASE_URL . "Admin");
        exit;
    }

    public function menu()
    {
        $this->requireAuth();
        $this->view("Admin/menu");
    }

    public function create()
    {
        $this->requireAuth();
        $result = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['user']) && isset($_POST['chip'])) {
            $user = trim($_POST['user']);
            $chip = (int) $_POST['chip'];
            $player = array_map('trim', explode(",", $user));
            $player = array_filter($player, fn($p) => strlen($p) > 1);
            foreach ($player as $p) {
                $cols = "user, chip";
                $vals = "'" . addslashes($p) . "'," . $chip;
                $ex = $this->model("M_DB_1")->insertCols("user", $cols, $vals);
                $result = $result ?? [];
                $result[] = ['user' => $p, 'chip' => $chip, 'result' => $ex];
            }
            if (empty($result)) {
                $result = ['error' => 'Tidak ada user valid'];
            }
        }
        $this->view("Admin/create", $result);
    }

    public function delete()
    {
        $this->requireAuth();
        $result = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['user'])) {
            $user = trim($_POST['user']);
            $where = "user = '" . addslashes($user) . "'";
            $ex = $this->model("M_DB_1")->delete_where("user", $where);
            $result = ['user' => $user, 'result' => $ex];
        }
        $this->view("Admin/delete", $result);
    }

    public function reset()
    {
        $this->requireAuth();
        $result = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm']) && $_POST['confirm'] === 'yes') {
            $ex1 = $this->model("M_DB_1")->delete("user");
            $ex2 = $this->model("M_DB_1")->delete("mutasi");
            $result = ['user' => $ex1, 'mutasi' => $ex2];
        }
        $this->view("Admin/reset", $result);
    }

    public function reset_coin()
    {
        $this->requireAuth();
        $result = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm']) && $_POST['confirm'] === 'yes') {
            $ex = $this->model("M_DB_1")->delete("mutasi");
            $result = ['mutasi' => $ex];
        }
        $this->view("Admin/reset_coin", $result);
    }

    public function list()
    {
        $this->requireAuth();
        $users = $this->model("M_DB_1")->get("user");
        $this->view("Admin/list", $users ?? []);
    }
}
