<?php

namespace Controller;

defined('ROOTPATH') or exit('Access Denied!');

class AjaxMap
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

            if (isset($post_data['selectedItem'])) {
                $selectedItem = $post_data['selectedItem'];

                if ($selectedItem === "animal") {
                    $info['result'] = $animal->getAllAnimal();
                } else if ($selectedItem === "plant") {
                    $info['result'] = $plant->getAllPlant();
                } else {
                    $info['result'] = array_merge(
                        $animal->getAllAnimal(),
                        $plant->getAllPlant()
                    );
                }
            }

            if (isset($post_data['searchText'])) {
                $scientificName = $post_data['searchText'];
                $info['provinces'] = $province->getAllProvinceHas($scientificName);

                $type = $post_data['type'];
                if ($type === "animal") {
                    $info['creature_detail'] = $animal->getAnimalByName($scientificName)[0];
                } else if ($type === "plant") {
                    $info['creature_detail'] = $plant->getPlantByName($scientificName)[0];
                }
            }

            if (isset($post_data['creatureType'])) {
                $creatureType = $post_data['creatureType'];

                if ($creatureType == "animal") {
                    $info = $this->handleAnimalRequest($post_data, $province, $animal);
                } elseif ($creatureType == "plant") {
                    $info = $this->handlePlantRequest($post_data, $province, $plant);
                }
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
