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
        $plant = new \Model\Plant;

        $info = null;

        if ($req->posted()) {
            $post_data = $req->post();

            if ($post_data['creatureType'] == "animal") {
                if ($post_data['functionType'] == "getCreatureOfProvince") {
                    $animalInfo = $province->randomAnimal($post_data['provinceName']);

                    $info['creature_info'] = $animalInfo[0];
                    $info['creature_province'] = $animal->getAllProvinceHasAnimal($info['creature_info']->scientific_name);
                    $info['creature_list'] = $province->getAnimalsExcept($post_data['provinceName'], $info['creature_info']->scientific_name);
                } else if ($post_data['functionType'] == "getDetailCreature") {
                    $animalDetail = $animal->getAnimalByName($post_data['scientificName']);

                    $info['creature_detail'] = $animalDetail[0];
                }
            } else if ($post_data['creatureType'] == "plant") {
                if ($post_data['functionType'] == "getCreatureOfProvince") {
                    $plantInfo = $province->randomPlant($post_data['provinceName']);

                    $info['creature_info'] = $plantInfo[0];
                    $info['creature_province'] = $plant->getAllProvinceHasPlant($info['creature_info']->scientific_name);
                    $info['creature_list'] = $province->getPlantsExcept($post_data['provinceName'], $info['creature_info']->scientific_name);
                } else if ($post_data['functionType'] == "getDetailCreature") {
                    $animalDetail = $plant->getPlantByName($post_data['scientificName']);

                    $info['creature_detail'] = $animalDetail[0];
                }
            }
        }

        header('Content-Type: application/json');
        echo json_encode($info);
    }
}
