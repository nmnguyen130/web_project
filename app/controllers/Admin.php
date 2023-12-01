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
        $animal = new \Model\Animal;
        $plant = new \Model\Plant;

        $data['totalPost'] = $data['form']->getTotalForms();
        $data['totalAnimal'] = $animal->getTotalAnimal();
        $data['totalPlant'] = $plant->getTotalPlant();

        $this->view('admin', $data);
    }
}
