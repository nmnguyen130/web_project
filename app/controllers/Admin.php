<?php

namespace Controller;

defined('ROOTPATH') or exit('Access Denied!');

class Admin
{
    use MainController;

    public function index()
    {
        $data['title'] = 'Admin';

        $this->view('admin', $data);
    }
}
