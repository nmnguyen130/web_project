<?php

namespace Controller;

defined('ROOTPATH') or exit('Access Denied!');

class Map
{
    use MainController;

    public function index()
    {
        $data['title'] = 'Map';

        $this->view('map', $data);
    }
}
