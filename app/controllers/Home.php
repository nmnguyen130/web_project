<?php

namespace Controller;

defined('ROOTPATH') or exit('Access Denied!');

class Home
{
    use MainController;

    public function index()
    {
        $data['title'] = 'Home';

        $this->view('home', $data);
    }
}
