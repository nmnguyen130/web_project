<?php

namespace Controller;

defined('ROOTPATH') or exit('Access Denied!');

class Admin
{
    use MainController;

    public function index()
    {
        $data['title'] = 'Admin';

        $animal = new \Model\Animal;
        $plant = new \Model\Plant;

        $data['totalAnimal'] = $animal->getTotalAnimal();
        $data['totalPlant'] = $plant->getTotalPlant();

        $this->view('admin', $data);
    }
}
