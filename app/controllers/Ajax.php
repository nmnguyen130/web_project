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
                $info = $this->handleAnimalRequest($post_data, $province, $animal);
            } elseif ($post_data['creatureType'] == "plant") {
                $info = $this->handlePlantRequest($post_data, $province, $plant);
            }
        }

        header('Content-Type: application/json');
        echo json_encode($info);
    }

    private function handleAnimalRequest($postData, $province, $animal)
    {
        $info = [];

        if ($postData['functionType'] == "getCreatureOfProvince") {
            $animalInfo = $province->randomAnimal($postData['provinceName']);
            $info['creature_info'] = $animalInfo[0];
            $info['creature_province'] = $animal->getAllProvinceHasAnimal($info['creature_info']->scientific_name);
            $info['creature_list'] = $province->getAnimalsExcept($postData['provinceName'], $info['creature_info']->scientific_name);
        } elseif ($postData['functionType'] == "getDetailCreature") {
            $animalDetail = $animal->getAnimalByName($postData['scientificName']);
            $info['creature_detail'] = $animalDetail[0];
        }

        return $info;
    }

    private function handlePlantRequest($postData, $province, $plant)
    {
        $info = [];

        if ($postData['functionType'] == "getCreatureOfProvince") {
            $plantInfo = $province->randomPlant($postData['provinceName']);
            $info['creature_info'] = $plantInfo[0];
            $info['creature_province'] = $plant->getAllProvinceHasPlant($info['creature_info']->scientific_name);
            $info['creature_list'] = $province->getPlantsExcept($postData['provinceName'], $info['creature_info']->scientific_name);
        } elseif ($postData['functionType'] == "getDetailCreature") {
            $plantDetail = $plant->getPlantByName($postData['scientificName']);
            $info['creature_detail'] = $plantDetail[0];
        }

        return $info;
    }
}
