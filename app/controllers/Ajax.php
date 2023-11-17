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

            if ($post_data['type'] == "getCreatureOfProvince") {
                $animalInfo = $province->randomAnimal($post_data['provinceName']);

                $info['animal_info'] = $animalInfo[0];
                $info['animal_province'] = $animal->getAllProvince($info['animal_info']->scientific_name);
                $info['animal_list'] = $province->getAnimalsExcept($post_data['provinceName'], $info['animal_info']->scientific_name);
            } else if ($post_data['type'] == "getDetailCreature") {
                $animalDetail = $animal->getAnimalByName($post_data['scientificName']);

                $info['animal_detail'] = $animalDetail[0];
            }
        }

        header('Content-Type: application/json');
        echo json_encode($info);
    }
}
