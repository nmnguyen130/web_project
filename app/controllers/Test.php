<?php

namespace Controller;

defined('ROOTPATH') or exit('Access Denied!');

class Test
{
    use MainController;

    public function index()
    {
        $province = new \Province();
        $name = "Đà Nẵng";

        $result = $province->getAnimalOfProvince($name);

        show($result);

        $this->view('test');
    }
}
