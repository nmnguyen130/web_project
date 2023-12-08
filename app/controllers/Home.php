<?php

namespace Controller;

defined('ROOTPATH') or exit('Access Denied!');

class Home
{
    use MainController;

    public function index()
    {
        $data['title'] = 'Home';
        $data['province'] = new \Model\Province;

        $this->view('home', $data);
    }
}
