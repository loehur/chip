<?php

require 'app/Config/Public_Variables.php';

class Controller extends Public_Variables
{

    public $v_viewer, $v_content, $v_load;

    public function view($file, $data = [])
    {
        require_once "app/Views/" . $file . ".php";
    }

    public function model($file)
    {
        require_once "app/Models/" . $file . ".php";
        return new $file();
    }

    public function headIcons()
    {
        $u = rtrim($this->ASSETS_URL, '/') . '/img/';
        echo '<link rel="icon" href="' . $u . 'favicon.svg" type="image/svg+xml">' . "\n";
        echo '    <link rel="icon" href="' . $u . 'favicon.png" type="image/png" sizes="32x32">' . "\n";
        echo '    <link rel="apple-touch-icon" href="' . $u . 'apple-touch-icon.png">';
    }
}
