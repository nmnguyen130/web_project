<?php

namespace Controller;

defined('ROOTPATH') or exit('Access Denied!');

class Admin
{
    use MainController;

    public function index()
    {
        $data['title'] = 'Admin';

        $data['form'] = new \Model\Form;
        $data['animal'] = new \Model\Animal;
        $data['plant'] = new \Model\Plant;

        $this->view('admin', $data);
    }
}
