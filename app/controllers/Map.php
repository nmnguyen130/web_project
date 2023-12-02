<?php

namespace Controller;

defined('ROOTPATH') or exit('Access Denied!');

class Map
{
    use MainController;

    public function index()
    {
        $data['title'] = 'Map';
        $data['province'] = new \Model\Province;

        $this->view('map', $data);
    }
}
