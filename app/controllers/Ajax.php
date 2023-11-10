<?php

namespace Controller;

defined('ROOTPATH') or exit('Access Denied!');

class Ajax
{
    use MainController;

    public function index()
    {
        $req = new \Core\Request;
        $province = new \Model\Province;
        $animal = new \Model\Animal;

        $info = null;

        if ($req->posted()) {
            $post_data = $req->post();

            $animalInfo = $province->randomAnimal($post_data['provinceName']);

            $info['animal_info'] = $animalInfo[0];
            $info['animal_province'] = $animal->getAllProvince($info['animal_info']->scientific_name);
        }

        header('Content-Type: application/json');
        echo json_encode($info);
    }
}
