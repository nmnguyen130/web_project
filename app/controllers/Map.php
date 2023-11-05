<?php

namespace Controller;

defined('ROOTPATH') or exit('Access Denied!');

class Map
{
    use MainController;

    public function index()
    {
        $this->view('map');
    }
}
